<?php

namespace App\Http\Controllers;

use App\Models\Torrefacteur;
use App\Models\EmailCampagne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendReminder(Request $request)
    {
        $request->validate([
            'sujet' => 'required|string|max:255',
            'contenu' => 'required|string',
        ]);

        $torrefacteurs = Torrefacteur::where('valide', false)
            ->with('user')
            ->get();

        $campagne = EmailCampagne::create([
            'sujet' => $request->sujet,
            'contenu' => $request->contenu,
            'total' => $torrefacteurs->count(),
            'statut' => 'en_cours',
            'date_envoi' => now(),
        ]);

        $envoyes = 0;
        foreach ($torrefacteurs as $torrefacteur) {
            try {
                Mail::raw($request->contenu, function ($message) use ($torrefacteur, $request) {
                    $message->to($torrefacteur->user->email, $torrefacteur->user->name)
                        ->subject($request->sujet);
                });
                $envoyes++;
            } catch (\Exception $e) {
                \Log::error('Erreur envoi email: ' . $e->getMessage());
            }
        }

        $campagne->update([
            'envoyes' => $envoyes,
            'statut' => 'termine',
        ]);

        return back()->with('success', "Emails envoyés: {$envoyes}/{$torrefacteurs->count()}");
    }
}


