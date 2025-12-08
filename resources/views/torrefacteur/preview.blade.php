@extends('layouts.app')

@section('title', 'Prévisualisation')

@section('content')
<section class="tm-section row">
    <div class="col-lg-12 tm-section-header-container">
        <h2 class="tm-section-header gold-text tm-handwriting-font" style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: nowrap;">
            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo" style="flex-shrink: 0;"> 
            <span style="white-space: nowrap;">Prévisualisation de votre fiche</span>
        </h2>
        <div class="tm-hr-container"><hr class="tm-hr"></div>
    </div>
    
    <div class="col-12">
        <div class="tm-special-item" style="background-color: white; padding: 40px;">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="text-center">
                        <div class="mb-4" style="min-height: 200px; display: flex; align-items: center; justify-content: center; background: #f8f8f8; border-radius: 12px; padding: 2rem;">
                            @if($torrefacteur->logo)
                                <img src="{{ asset('storage/' . $torrefacteur->logo) }}" alt="Logo" class="img-fluid" style="max-height: 200px; object-fit: contain;">
                            @else
                                <div class="gold-text" style="font-size: 1.2rem; font-weight: 600;">
                                    <i class="bi bi-image me-2"></i>Sans Logo
                                </div>
                            @endif
                        </div>
                        @if($torrefacteur->photo)
                            <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                <img src="{{ asset('storage/' . $torrefacteur->photo) }}" alt="Photo" class="img-fluid">
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-8">
                    <h3 class="gold-text mb-4" style="font-weight: 700; border-bottom: 2px solid #c79c60; padding-bottom: 1rem;">
                        {{ $torrefacteur->nom_brulerie }}
                    </h3>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <p class="mb-2">
                                <strong class="gold-text"><i class="bi bi-geo-alt me-2"></i>Région :</strong> 
                                <span>{{ $torrefacteur->region->nom ?? 'Non renseigné' }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-2">
                                <strong class="gold-text"><i class="bi bi-map me-2"></i>Département :</strong> 
                                <span>{{ $torrefacteur->departement->nom ?? 'Non renseigné' }}</span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <p class="mb-2">
                                <strong class="gold-text"><i class="bi bi-person me-2"></i>Représentant :</strong> 
                                <span>{{ $torrefacteur->prenom_nom_representant }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-2">
                                <strong class="gold-text"><i class="bi bi-telephone me-2"></i>Téléphone :</strong> 
                                <span>{{ $torrefacteur->telephone }}</span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <p class="mb-2">
                            <strong class="gold-text"><i class="bi bi-geo me-2"></i>Adresse :</strong> 
                            <span>{{ nl2br(e($torrefacteur->adresse)) }}</span>
                        </p>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <p class="mb-2">
                                <strong class="gold-text"><i class="bi bi-envelope me-2"></i>Email :</strong> 
                                <a href="mailto:{{ $torrefacteur->email }}" class="gold-text">{{ $torrefacteur->email }}</a>
                            </p>
                        </div>
                        @if($torrefacteur->site_internet)
                            <div class="col-md-6 mb-3">
                                <p class="mb-2">
                                    <strong class="gold-text"><i class="bi bi-globe me-2"></i>Site Internet :</strong> 
                                    <a href="{{ $torrefacteur->site_internet }}" target="_blank" class="gold-text">{{ $torrefacteur->site_internet }}</a>
                                </p>
                            </div>
                        @endif
                    </div>
                    
                    @if($torrefacteur->texte_descriptif)
                        <div class="mt-4 mb-4" style="border-top: 2px solid #c79c60; padding-top: 1.5rem;">
                            <h5 class="gold-text mb-3">
                                <i class="bi bi-file-text me-2"></i>Description
                            </h5>
                            <p style="line-height: 1.8; color: #555;">{{ nl2br(e($torrefacteur->texte_descriptif)) }}</p>
                        </div>
                    @endif
                    
                    @if($torrefacteur->equipements->count() > 0)
                        <div class="mt-4 mb-4" style="border-top: 2px solid #c79c60; padding-top: 1.5rem;">
                            <h5 class="gold-text mb-3">
                                <i class="bi bi-tools me-2"></i>Équipements
                            </h5>
                            <div class="row">
                                @foreach($torrefacteur->equipements as $equipement)
                                    <div class="col-md-6 mb-2">
                                        <span class="badge" style="background: rgba(199, 156, 96, 0.15); color: #c79c60; padding: 0.5rem 1rem; font-weight: 500;">
                                            <i class="bi bi-check-circle me-1"></i>{{ $equipement->nom }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 pt-4" style="border-top: 2px solid #c79c60;">
                <a href="{{ route('torrefacteur.form') }}" class="tm-more-button">
                    <i class="bi bi-pencil me-2"></i>Modifier
                </a>
            </div>
        </div>
    </div>
</section>
@endsection


