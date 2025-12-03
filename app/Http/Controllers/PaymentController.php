<?php

namespace App\Http\Controllers;

use App\Models\Torrefacteur;
use App\Models\OffrePartenaire;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe as StripeClient;
use Stripe\PaymentIntent;

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

        return view('payment.process', compact('paiement', 'offre'));
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
        // PayPal integration would go here
        // For now, redirect to success
        $request->validate([
            'paiement_id' => 'required|exists:paiements,id',
        ]);

        $paiement = Paiement::findOrFail($request->paiement_id);
        
        if ($paiement->torrefacteur->user_id !== Auth::id()) {
            abort(403);
        }

        // TODO: Implement PayPal payment processing
        return redirect()->route('payment.success');
    }

    public function success(Request $request)
    {
        $paiement = Paiement::where('torrefacteur_id', Auth::user()->torrefacteur->id)
            ->where('statut', 'en_attente')
            ->latest()
            ->first();

        if ($paiement) {
            $paiement->update([
                'statut' => 'paye',
                'methode' => 'carte',
                'date_paiement' => now(),
            ]);
        }

        return view('payment.success', compact('paiement'));
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}

