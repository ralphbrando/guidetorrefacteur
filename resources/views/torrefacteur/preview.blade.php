@extends('layouts.app')

@section('title', 'Prévisualisation')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Prévisualisation de votre fiche</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($torrefacteur->logo)
                            <img src="{{ asset('storage/' . $torrefacteur->logo) }}" alt="Logo" class="img-fluid mb-3">
                        @endif
                        @if($torrefacteur->photo)
                            <img src="{{ asset('storage/' . $torrefacteur->photo) }}" alt="Photo" class="img-fluid">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h3>{{ $torrefacteur->nom_brulerie }}</h3>
                        <p><strong>Région :</strong> {{ $torrefacteur->region->nom }}</p>
                        <p><strong>Département :</strong> {{ $torrefacteur->departement->nom }}</p>
                        <p><strong>Représentant :</strong> {{ $torrefacteur->prenom_nom_representant }}</p>
                        <p><strong>Adresse :</strong> {{ $torrefacteur->adresse }}</p>
                        <p><strong>Téléphone :</strong> {{ $torrefacteur->telephone }}</p>
                        <p><strong>Email :</strong> {{ $torrefacteur->email }}</p>
                        @if($torrefacteur->site_internet)
                            <p><strong>Site Internet :</strong> <a href="{{ $torrefacteur->site_internet }}" target="_blank">{{ $torrefacteur->site_internet }}</a></p>
                        @endif
                        @if($torrefacteur->texte_descriptif)
                            <div class="mt-3">
                                <strong>Description :</strong>
                                <p>{{ $torrefacteur->texte_descriptif }}</p>
                            </div>
                        @endif
                        @if($torrefacteur->equipements->count() > 0)
                            <div class="mt-3">
                                <strong>Équipements :</strong>
                                <ul>
                                    @foreach($torrefacteur->equipements as $equipement)
                                        <li>{{ $equipement->nom }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('torrefacteur.form') }}" class="btn btn-primary">Modifier</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


