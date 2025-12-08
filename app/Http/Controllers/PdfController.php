<?php

namespace App\Http\Controllers;

use App\Models\Torrefacteur;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    public function preview()
    {
        $torrefacteurs = Torrefacteur::where('valide', true)
            ->with(['region', 'departement', 'offrePartenaire', 'equipements'])
            ->orderBy('region_id')
            ->orderBy('nom_brulerie')
            ->get();

        $regions = Region::with(['torrefacteurs' => function($query) {
            $query->where('valide', true)->orderBy('nom_brulerie');
        }])->orderBy('ordre')->get();

        return view('pdf.preview', compact('torrefacteurs', 'regions'));
    }

    public function generate(Request $request)
    {
        $type = $request->get('type', 'preview'); // preview or print

        $torrefacteurs = Torrefacteur::where('valide', true)
            ->with(['region', 'departement', 'offrePartenaire', 'equipements'])
            ->orderBy('region_id')
            ->orderBy('nom_brulerie')
            ->get();

        $regions = Region::with(['torrefacteurs' => function($query) {
            $query->where('valide', true)->orderBy('nom_brulerie');
        }])->orderBy('ordre')->get();

        $pdf = \PDF::loadView('pdf.guide', compact('torrefacteurs', 'regions'));
        
        if ($type === 'print') {
            // High resolution for printing
            $pdf->setPaper('a5', 'portrait');
            return $pdf->download('guide-2026-torrefacteurs.pdf');
        }

        return $pdf->stream('guide-2026-torrefacteurs.pdf');
    }

    public function generateIllustrator()
    {
        // This would generate a format compatible with Illustrator
        // For now, we'll generate a high-res PDF that can be edited
        $torrefacteurs = Torrefacteur::where('valide', true)
            ->with(['region', 'departement', 'offrePartenaire', 'equipements'])
            ->orderBy('region_id')
            ->orderBy('nom_brulerie')
            ->get();

        $regions = Region::with(['torrefacteurs' => function($query) {
            $query->where('valide', true)->orderBy('nom_brulerie');
        }])->orderBy('ordre')->get();

        $pdf = \PDF::loadView('pdf.guide', compact('torrefacteurs', 'regions'));
        $pdf->setPaper('a5', 'portrait');
        $pdf->setOption('dpi', 300);
        
        return $pdf->download('guide-2026-torrefacteurs-illustrator.pdf');
    }
}


