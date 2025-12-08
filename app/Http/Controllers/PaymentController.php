<?php

namespace App\Http\Controllers;

use App\Models\Torrefacteur;
use App\Models\OffrePartenaire;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe as StripeClient;
use Stripe\PaymentIntent;
use Stripe\Webhook;

class PaymentController extends Controller
{
    public function index()
    {
        $torrefacteur = Auth::user()->torrefacteur;
        
        if (!$torrefacteur) {
            return redirect()->route('torrefacteur.form')->with('error', 'Veuillez d\'abord remplir vos informations.');
        }

        $offres = OffrePartenaire::where('actif', true)->orderBy('ordre')->get();
        
        return view('payment.index', compact('torrefacteur', 'offres'));
    }

    public function showProcess(Request $request)
    {
        $torrefacteur = Auth::user()->torrefacteur;
        
        if (!$torrefacteur) {
            return redirect()->route('torrefacteur.form')->with('error', 'Veuillez d\'abord remplir vos informations.');
        }

        // Récupérer le dernier paiement en attente
        $paiement = Paiement::where('torrefacteur_id', $torrefacteur->id)
            ->where('statut', 'en_attente')
            ->latest()
            ->first();

        if (!$paiement) {
            return redirect()->route('payment.index')->with('error', 'Aucun paiement en attente.');
        }

        $offre = $paiement->offrePartenaire;

        return view('payment.process', compact('paiement', 'offre'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'offre_partenaire_id' => 'required|exists:offre_partenaires,id',
            'nom_societe' => 'required|string|max:255',
        ]);

        $torrefacteur = Auth::user()->torrefacteur;
        $offre = OffrePartenaire::findOrFail($request->offre_partenaire_id);

        if (!$offre->isDisponible()) {
            return back()->with('error', 'Cette offre n\'est plus disponible.');
        }

        // Create payment record
        $paiement = Paiement::create([
            'torrefacteur_id' => $torrefacteur->id,
            'offre_partenaire_id' => $offre->id,
            'numero_facture' => Paiement::generateNumeroFacture(),
            'nom_societe' => $request->nom_societe,
            'montant' => $offre->prix,
            'statut' => 'en_attente',
        ]);

        // Update torrefacteur
        $torrefacteur->offre_partenaire_id = $offre->id;
        $torrefacteur->save();

        // Reserve the offer
        $offre->increment('reserve');

        return redirect()->route('payment.process')->with('paiement_id', $paiement->id);
    }

    public function stripe(Request $request)
    {
        $request->validate([
            'paiement_id' => 'required|exists:paiements,id',
        ]);

        $paiement = Paiement::findOrFail($request->paiement_id);
        
        if ($paiement->torrefacteur->user_id !== Auth::id()) {
            abort(403);
        }

        if ($paiement->montant == 0) {
            return redirect()->route('payment.success');
        }

        StripeClient::setApiKey(config('stripe.secret'));

        try {
            $intent = PaymentIntent::create([
                'amount' => (int)($paiement->montant * 100),
                'currency' => 'eur',
                'metadata' => [
                    'paiement_id' => $paiement->id,
                ],
            ]);

            return view('payment.stripe', [
                'clientSecret' => $intent->client_secret,
                'paiement' => $paiement,
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la création du paiement: ' . $e->getMessage());
        }
    }

    public function paypal(Request $request)
    {
        $request->validate([
            'paiement_id' => 'required|exists:paiements,id',
        ]);

        $paiement = Paiement::findOrFail($request->paiement_id);
        
        if ($paiement->torrefacteur->user_id !== Auth::id()) {
            abort(403);
        }

        // Redirect to PayPal payment page
        return view('payment.paypal', compact('paiement'));
    }

    public function paypalCallback(Request $request)
    {
        $request->validate([
            'paiement_id' => 'required|exists:paiements,id',
            'paymentId' => 'required|string',
            'PayerID' => 'required|string',
        ]);

        $paiement = Paiement::findOrFail($request->paiement_id);
        
        if ($paiement->torrefacteur->user_id !== Auth::id()) {
            abort(403);
        }

        // Vérifier le paiement PayPal avec l'API PayPal
        try {
            $clientId = config('paypal.client_id');
            $clientSecret = config('paypal.client_secret');
            $mode = config('paypal.mode', 'live');
            
            $baseUrl = $mode === 'live' 
                ? 'https://api-m.paypal.com' 
                : 'https://api-m.sandbox.paypal.com';
            
            // Obtenir un token d'accès
            $tokenResponse = \Illuminate\Support\Facades\Http::asForm()
                ->withBasicAuth($clientId, $clientSecret)
                ->post($baseUrl . '/v1/oauth2/token', [
                    'grant_type' => 'client_credentials',
                ]);
            
            if (!$tokenResponse->successful()) {
                throw new \Exception('Erreur lors de l\'authentification PayPal');
            }
            
            $accessToken = $tokenResponse->json()['access_token'];
            
            // Vérifier l'ordre PayPal
            $orderResponse = \Illuminate\Support\Facades\Http::withToken($accessToken)
                ->get($baseUrl . '/v2/checkout/orders/' . $request->paymentId);
            
            if (!$orderResponse->successful()) {
                throw new \Exception('Erreur lors de la vérification de la commande PayPal');
            }
            
            $order = $orderResponse->json();
            
            // Vérifier que le statut est COMPLETED et que le montant correspond
            if ($order['status'] === 'COMPLETED') {
                $amount = $order['purchase_units'][0]['amount']['value'];
                
                if ((float)$amount === (float)$paiement->montant) {
                    $paiement->update([
                        'statut' => 'paye',
                        'methode' => 'paypal',
                        'transaction_id' => $request->paymentId,
                        'date_paiement' => now(),
                    ]);

                    return redirect()->route('payment.success')->with('success', 'Paiement PayPal effectué avec succès.');
                } else {
                    Log::error('PayPal payment amount mismatch', [
                        'expected' => $paiement->montant,
                        'received' => $amount,
                        'order_id' => $request->paymentId,
                    ]);
                    return redirect()->route('payment.process')->with('error', 'Erreur : le montant du paiement ne correspond pas.');
                }
            } else {
                return redirect()->route('payment.process')->with('error', 'Le paiement PayPal n\'a pas été complété.');
            }
        } catch (\Exception $e) {
            Log::error('PayPal payment verification error: ' . $e->getMessage(), [
                'paiement_id' => $paiement->id,
                'paymentId' => $request->paymentId,
            ]);
            
            return redirect()->route('payment.process')->with('error', 'Erreur lors de la vérification du paiement PayPal : ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        $paiement = Paiement::where('torrefacteur_id', Auth::user()->torrefacteur->id)
            ->where('statut', 'en_attente')
            ->latest()
            ->first();

        if ($paiement && $request->has('payment_intent')) {
            // Vérifier le paiement Stripe côté serveur
            StripeClient::setApiKey(config('stripe.secret'));
            
            try {
                $paymentIntent = PaymentIntent::retrieve($request->payment_intent);
                
                if ($paymentIntent->status === 'succeeded') {
                    $paiement->update([
                        'statut' => 'paye',
                        'methode' => 'carte',
                        'transaction_id' => $paymentIntent->id,
                        'date_paiement' => now(),
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('Stripe payment verification error: ' . $e->getMessage());
            }
        }

        return view('payment.success', compact('paiement'));
    }

    public function stripeWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $paiementId = $paymentIntent->metadata->paiement_id ?? null;
                
                if ($paiementId) {
                    $paiement = Paiement::find($paiementId);
                    if ($paiement && $paiement->statut === 'en_attente') {
                        $paiement->update([
                            'statut' => 'paye',
                            'methode' => 'carte',
                            'transaction_id' => $paymentIntent->id,
                            'date_paiement' => now(),
                        ]);
                    }
                }
                break;
        }

        return response()->json(['received' => true]);
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}

