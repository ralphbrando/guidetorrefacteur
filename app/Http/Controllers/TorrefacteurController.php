<?php

namespace App\Http\Controllers;

use App\Models\Torrefacteur;
use App\Models\Region;
use App\Models\Equipement;
use App\Models\ChampSupplementaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TorrefacteurController extends Controller
{
    public function showForm()
    {
        $user = Auth::user();
        $torrefacteur = $user->torrefacteur;
        
        $regions = Region::orderBy('ordre')->get();
        $equipements = Equipement::where('actif', true)->orderBy('ordre')->get();
        $champsSupplementaires = ChampSupplementaire::where('actif', true)->orderBy('ordre')->get();
        
        return view('torrefacteur.form', compact('torrefacteur', 'regions', 'equipements', 'champsSupplementaires'));
    }

    public function save(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'nom_brulerie' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'departement_id' => 'required|exists:departements,id',
            'prenom_nom_representant' => 'required|string|max:255',
            'adresse' => 'required|string',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'logo' => 'nullable|image|max:2048',
            'texte_descriptif' => 'nullable|string',
            'site_internet' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:5120',
            'equipements' => 'nullable|array',
            'equipements.*' => 'exists:equipements,id',
        ]);

        $torrefacteur = $user->torrefacteur ?? new Torrefacteur();
        $torrefacteur->user_id = $user->id;
        $torrefacteur->fill($validated);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($torrefacteur->logo) {
                Storage::disk('public')->delete($torrefacteur->logo);
            }
            $torrefacteur->logo = $request->file('logo')->store('logos', 'public');
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            if ($torrefacteur->photo) {
                Storage::disk('public')->delete($torrefacteur->photo);
            }
            $torrefacteur->photo = $request->file('photo')->store('photos', 'public');
        }

        // Handle additional fields
        $additionalFields = [
            'machine_torrefier', 'capacite_machine', 'ateliers_decouvertes',
            'degustations', 'labels', 'arabica', 'robusta', 'geisha', 'thes',
            'cacao', 'accessoires_cafe_domestique', 'machines_domestiques',
            'accessoires_thes', 'espace_professionnels', 'cascara', 'formations_sca'
        ];

        foreach ($additionalFields as $field) {
            if ($request->has($field)) {
                $torrefacteur->$field = $request->input($field);
            }
        }

        $torrefacteur->save();

        // Sync equipements
        if ($request->has('equipements')) {
            $torrefacteur->equipements()->sync($request->equipements);
        }

        // Handle champs supplementaires
        $champsSupplementaires = ChampSupplementaire::where('actif', true)->get();
        foreach ($champsSupplementaires as $champ) {
            if ($request->has('champ_' . $champ->id)) {
                $torrefacteur->champsSupplementaires()->syncWithoutDetaching([
                    $champ->id => ['valeur' => $request->input('champ_' . $champ->id)]
                ]);
            }
        }

        return redirect()->route('torrefacteur.form')->with('success', 'Vos informations ont été enregistrées avec succès.');
    }

    public function preview()
    {
        $torrefacteur = Auth::user()->torrefacteur;
        
        if (!$torrefacteur) {
            return redirect()->route('torrefacteur.form')->with('error', 'Veuillez d\'abord remplir vos informations.');
        }

        return view('torrefacteur.preview', compact('torrefacteur'));
    }
}


