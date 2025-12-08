@extends('layouts.app')

@section('title', 'Formulaire Torréfacteur')

@section('content')
<section class="tm-section row">
    <div class="col-lg-12 tm-section-header-container">
        <h2 class="tm-section-header gold-text tm-handwriting-font" style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: nowrap; white-space: nowrap;">
            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo" style="flex-shrink: 0;"> 
            <span>Formulaire Torréfacteur</span>
        </h2>
        <div class="tm-hr-container"><hr class="tm-hr"></div>
    </div>
    <div class="col-12">
        <div class="alert alert-warning mb-4" style="background: rgba(199, 156, 96, 0.2); border: 1px solid #c79c60; color: #333;">
            <strong>⚠️ Informations à remplir AVANT le 21 Décembre 2025</strong>
        </div>
        <div class="tm-special-item" style="background-color: white; padding: 40px;">
                <form method="POST" action="{{ route('torrefacteur.save') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="d-flex align-items-center gap-2 mb-5 pb-3" style="border-bottom: 2px solid #c79c60; white-space: nowrap;">
                        <i class="bi bi-info-circle gold-text" style="font-size: 1.5rem;"></i>
                        <h5 class="mb-0 gold-text" style="white-space: nowrap;">Informations générales</h5>
                    </div>
                    
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label for="nom_brulerie" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                                Nom de la Brulerie <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('nom_brulerie') is-invalid @enderror" 
                                   id="nom_brulerie" name="nom_brulerie" 
                                   value="{{ old('nom_brulerie', $torrefacteur->nom_brulerie ?? '') }}" 
                                   required
                                   style="padding: 0.875rem 1.25rem;">
                            @error('nom_brulerie')
                                <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="region_id" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                                Région <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-lg custom-select @error('region_id') is-invalid @enderror" 
                                    id="region_id" name="region_id" required
                                    style="padding: 0.875rem 1.25rem;">
                                <option value="">Sélectionner une région</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" 
                                            {{ old('region_id', $torrefacteur->region_id ?? '') == $region->id ? 'selected' : '' }}>
                                        {{ $region->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('region_id')
                                <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="departement_id" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                                Département <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-lg custom-select @error('departement_id') is-invalid @enderror" 
                                    id="departement_id" name="departement_id" required
                                    style="padding: 0.875rem 1.25rem;">
                                <option value="">Sélectionner un département</option>
                                @if($torrefacteur && $torrefacteur->region)
                                    @foreach($torrefacteur->region->departements as $dept)
                                        <option value="{{ $dept->id }}" 
                                                {{ old('departement_id', $torrefacteur->departement_id ?? '') == $dept->id ? 'selected' : '' }}>
                                            {{ $dept->nom }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('departement_id')
                                <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="logo" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                                Logo
                            </label>
                            <input type="file" class="form-control form-control-lg custom-file-input @error('logo') is-invalid @enderror" 
                                   id="logo" name="logo" accept="image/*">
                            @error('logo')
                                <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                            @enderror
                            @if($torrefacteur && $torrefacteur->logo)
                                <small class="text-muted d-block mt-2">
                                    <i class="bi bi-check-circle me-1"></i>Logo actuel: 
                                    <a href="{{ asset('storage/' . $torrefacteur->logo) }}" target="_blank" class="gold-text">Voir</a>
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="texte_descriptif" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                            Texte descriptif
                        </label>
                        <textarea class="form-control form-control-lg @error('texte_descriptif') is-invalid @enderror" 
                                  id="texte_descriptif" name="texte_descriptif" rows="4"
                                  style="padding: 0.875rem 1.25rem;">{{ old('texte_descriptif', $torrefacteur->texte_descriptif ?? '') }}</textarea>
                        @error('texte_descriptif')
                            <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-5 mt-5 pb-3" style="border-bottom: 2px solid #c79c60; white-space: nowrap;">
                        <i class="bi bi-telephone gold-text" style="font-size: 1.5rem;"></i>
                        <h5 class="mb-0 gold-text" style="white-space: nowrap;">Informations de contact</h5>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-3">
                            <label for="prenom_nom_representant" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                                Prénom NOM représentant <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('prenom_nom_representant') is-invalid @enderror" 
                                   id="prenom_nom_representant" name="prenom_nom_representant" 
                                   value="{{ old('prenom_nom_representant', $torrefacteur->prenom_nom_representant ?? '') }}" 
                                   required
                                   style="padding: 0.875rem 1.25rem;">
                            @error('prenom_nom_representant')
                                <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="telephone" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                                Téléphone <span class="text-danger">*</span>
                            </label>
                            <input type="tel" class="form-control form-control-lg @error('telephone') is-invalid @enderror" 
                                   id="telephone" name="telephone" 
                                   value="{{ old('telephone', $torrefacteur->telephone ?? '') }}" 
                                   required
                                   style="padding: 0.875rem 1.25rem;">
                            @error('telephone')
                                <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   id="email" name="email" 
                                   value="{{ old('email', $torrefacteur->email ?? '') }}" 
                                   required
                                   style="padding: 0.875rem 1.25rem;">
                            @error('email')
                                <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="site_internet" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                                Site Internet
                            </label>
                            <input type="url" class="form-control form-control-lg @error('site_internet') is-invalid @enderror" 
                                   id="site_internet" name="site_internet" 
                                   value="{{ old('site_internet', $torrefacteur->site_internet ?? '') }}"
                                   style="padding: 0.875rem 1.25rem;">
                            @error('site_internet')
                                <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="adresse" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                            Adresse <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control form-control-lg @error('adresse') is-invalid @enderror" 
                                  id="adresse" name="adresse" rows="3" required
                                  style="padding: 0.875rem 1.25rem;">{{ old('adresse', $torrefacteur->adresse ?? '') }}</textarea>
                        @error('adresse')
                            <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="photo" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                            Photo (dimensions fixes)
                        </label>
                        <input type="file" class="form-control form-control-lg custom-file-input @error('photo') is-invalid @enderror" 
                               id="photo" name="photo" accept="image/*">
                        @error('photo')
                            <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                        @enderror
                        @if($torrefacteur && $torrefacteur->photo)
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-check-circle me-1"></i>Photo actuelle: 
                                <a href="{{ asset('storage/' . $torrefacteur->photo) }}" target="_blank" class="gold-text">Voir</a>
                            </small>
                        @endif
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-4 mt-5 pb-3" style="border-bottom: 2px solid #c79c60; white-space: nowrap;">
                        <i class="bi bi-gear gold-text" style="font-size: 1.5rem;"></i>
                        <h5 class="mb-0 gold-text" style="white-space: nowrap;">Équipements</h5>
                    </div>
                    <div class="row mb-4">
                        @foreach($equipements as $equipement)
                            <div class="col-md-4 mb-3">
                                <div class="form-check custom-checkbox" style="display: flex; align-items: flex-start; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease;">
                                    <input class="form-check-input" type="checkbox" 
                                           id="equipement_{{ $equipement->id }}" 
                                           name="equipements[]" 
                                           value="{{ $equipement->id }}"
                                           style="margin-top: 0.25rem; margin-right: 0.75rem; flex-shrink: 0;"
                                           {{ $torrefacteur && $torrefacteur->equipements->contains($equipement->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="equipement_{{ $equipement->id }}" style="flex: 1; margin: 0; cursor: pointer; line-height: 1.5; word-wrap: break-word;">
                                        {{ $equipement->nom }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-4 mt-5 pb-3" style="border-bottom: 2px solid #c79c60; white-space: nowrap;">
                        <i class="bi bi-info-circle gold-text" style="font-size: 1.5rem;"></i>
                        <h5 class="mb-0 gold-text" style="white-space: nowrap;">Informations supplémentaires</h5>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="machine_torrefier" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                                Machine à torréfier
                            </label>
                            <input type="text" class="form-control form-control-lg" 
                                   id="machine_torrefier" name="machine_torrefier" 
                                   value="{{ old('machine_torrefier', $torrefacteur->machine_torrefier ?? '') }}"
                                   style="padding: 0.875rem 1.25rem;">
                        </div>
                        <div class="col-md-6">
                            <label for="capacite_machine" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                                Capacité de la machine
                            </label>
                            <input type="text" class="form-control form-control-lg" 
                                   id="capacite_machine" name="capacite_machine" 
                                   value="{{ old('capacite_machine', $torrefacteur->capacite_machine ?? '') }}"
                                   style="padding: 0.875rem 1.25rem;">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-check custom-checkbox" style="display: flex; align-items: flex-start; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease;">
                                <input class="form-check-input" type="checkbox" 
                                       id="ateliers_decouvertes" name="ateliers_decouvertes" value="1"
                                       style="margin-top: 0.25rem; margin-right: 0.75rem; flex-shrink: 0;"
                                       {{ old('ateliers_decouvertes', $torrefacteur->ateliers_decouvertes ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="ateliers_decouvertes" style="flex: 1; margin: 0; cursor: pointer; line-height: 1.5;">
                                    Organisation d'ateliers découvertes
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check custom-checkbox" style="display: flex; align-items: flex-start; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease;">
                                <input class="form-check-input" type="checkbox" 
                                       id="degustations" name="degustations" value="1"
                                       style="margin-top: 0.25rem; margin-right: 0.75rem; flex-shrink: 0;"
                                       {{ old('degustations', $torrefacteur->degustations ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="degustations" style="flex: 1; margin: 0; cursor: pointer; line-height: 1.5;">
                                    Dégustations
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="labels" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                            Labels
                        </label>
                        <input type="text" class="form-control form-control-lg" 
                               id="labels" name="labels" 
                               value="{{ old('labels', $torrefacteur->labels ?? '') }}"
                               style="padding: 0.875rem 1.25rem;">
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="form-check custom-checkbox" style="display: flex; align-items: center; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease; height: 100%;">
                                <input class="form-check-input" type="checkbox" 
                                       id="arabica" name="arabica" value="1"
                                       style="margin-top: 0; margin-right: 0.75rem; flex-shrink: 0;"
                                       {{ old('arabica', $torrefacteur->arabica ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="arabica" style="flex: 1; margin: 0; cursor: pointer; white-space: nowrap;">Arabica</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check custom-checkbox" style="display: flex; align-items: center; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease; height: 100%;">
                                <input class="form-check-input" type="checkbox" 
                                       id="robusta" name="robusta" value="1"
                                       style="margin-top: 0; margin-right: 0.75rem; flex-shrink: 0;"
                                       {{ old('robusta', $torrefacteur->robusta ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="robusta" style="flex: 1; margin: 0; cursor: pointer; white-space: nowrap;">Robusta</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check custom-checkbox" style="display: flex; align-items: center; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease; height: 100%;">
                                <input class="form-check-input" type="checkbox" 
                                       id="geisha" name="geisha" value="1"
                                       style="margin-top: 0; margin-right: 0.75rem; flex-shrink: 0;"
                                       {{ old('geisha', $torrefacteur->geisha ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="geisha" style="flex: 1; margin: 0; cursor: pointer; white-space: nowrap;">Geisha</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check custom-checkbox" style="display: flex; align-items: center; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease; height: 100%;">
                                <input class="form-check-input" type="checkbox" 
                                       id="thes" name="thes" value="1"
                                       style="margin-top: 0; margin-right: 0.75rem; flex-shrink: 0;"
                                       {{ old('thes', $torrefacteur->thes ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="thes" style="flex: 1; margin: 0; cursor: pointer; white-space: nowrap;">Thés</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="form-check custom-checkbox" style="display: flex; align-items: flex-start; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease; height: 100%;">
                                <input class="form-check-input" type="checkbox" 
                                       id="cacao" name="cacao" value="1"
                                       style="margin-top: 0.25rem; margin-right: 0.75rem; flex-shrink: 0;"
                                       {{ old('cacao', $torrefacteur->cacao ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="cacao" style="flex: 1; margin: 0; cursor: pointer; line-height: 1.5;">Cacao</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check custom-checkbox" style="display: flex; align-items: flex-start; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease; height: 100%;">
                                <input class="form-check-input" type="checkbox" 
                                       id="accessoires_cafe_domestique" name="accessoires_cafe_domestique" value="1"
                                       style="margin-top: 0.25rem; margin-right: 0.75rem; flex-shrink: 0;"
                                       {{ old('accessoires_cafe_domestique', $torrefacteur->accessoires_cafe_domestique ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="accessoires_cafe_domestique" style="flex: 1; margin: 0; cursor: pointer; line-height: 1.5; word-wrap: break-word;">Accessoires café domestique</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check custom-checkbox" style="display: flex; align-items: flex-start; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease; height: 100%;">
                                <input class="form-check-input" type="checkbox" 
                                       id="machines_domestiques" name="machines_domestiques" value="1"
                                       style="margin-top: 0.25rem; margin-right: 0.75rem; flex-shrink: 0;"
                                       {{ old('machines_domestiques', $torrefacteur->machines_domestiques ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="machines_domestiques" style="flex: 1; margin: 0; cursor: pointer; line-height: 1.5;">Machines domestiques</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check custom-checkbox" style="display: flex; align-items: flex-start; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease; height: 100%;">
                                <input class="form-check-input" type="checkbox" 
                                       id="accessoires_thes" name="accessoires_thes" value="1"
                                       style="margin-top: 0.25rem; margin-right: 0.75rem; flex-shrink: 0;"
                                       {{ old('accessoires_thes', $torrefacteur->accessoires_thes ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="accessoires_thes" style="flex: 1; margin: 0; cursor: pointer; line-height: 1.5;">Accessoires thés</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="form-check custom-checkbox" style="display: flex; align-items: flex-start; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease; height: 100%;">
                                <input class="form-check-input" type="checkbox" 
                                       id="espace_professionnels" name="espace_professionnels" value="1"
                                       style="margin-top: 0.25rem; margin-right: 0.75rem; flex-shrink: 0;"
                                       {{ old('espace_professionnels', $torrefacteur->espace_professionnels ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="espace_professionnels" style="flex: 1; margin: 0; cursor: pointer; line-height: 1.5;">Espace professionnels</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check custom-checkbox" style="display: flex; align-items: center; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease; height: 100%;">
                                <input class="form-check-input" type="checkbox" 
                                       id="cascara" name="cascara" value="1"
                                       style="margin-top: 0; margin-right: 0.75rem; flex-shrink: 0;"
                                       {{ old('cascara', $torrefacteur->cascara ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="cascara" style="flex: 1; margin: 0; cursor: pointer; white-space: nowrap;">Cascara</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check custom-checkbox" style="display: flex; align-items: flex-start; padding: 0.75rem; background: #f8f8f8; border-radius: 8px; transition: all 0.3s ease; height: 100%;">
                                <input class="form-check-input" type="checkbox" 
                                       id="formations_sca" name="formations_sca" value="1"
                                       style="margin-top: 0.25rem; margin-right: 0.75rem; flex-shrink: 0;"
                                       {{ old('formations_sca', $torrefacteur->formations_sca ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="formations_sca" style="flex: 1; margin: 0; cursor: pointer; line-height: 1.5;">Formations SCA</label>
                            </div>
                        </div>
                    </div>

                    @if($champsSupplementaires->count() > 0)
                        <div class="d-flex align-items-center gap-2 mb-4 mt-5 pb-3" style="border-bottom: 2px solid #c79c60; white-space: nowrap;">
                            <i class="bi bi-list-ul gold-text" style="font-size: 1.5rem;"></i>
                            <h5 class="mb-0 gold-text" style="white-space: nowrap;">Champs supplémentaires</h5>
                        </div>
                        @foreach($champsSupplementaires as $champ)
                            <div class="mb-4">
                                <label for="champ_{{ $champ->id }}" class="form-label gold-text" style="font-weight: 600; margin-bottom: 0.75rem; display: block;">
                                    {{ $champ->nom }}
                                    @if($champ->obligatoire)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                @if($champ->type === 'textarea')
                                    <textarea class="form-control form-control-lg" 
                                              id="champ_{{ $champ->id }}" 
                                              name="champ_{{ $champ->id }}"
                                              rows="4"
                                              {{ $champ->obligatoire ? 'required' : '' }}
                                              style="padding: 0.875rem 1.25rem;">{{ old('champ_' . $champ->id, $torrefacteur && $torrefacteur->champsSupplementaires->contains($champ->id) ? $torrefacteur->champsSupplementaires->find($champ->id)->pivot->valeur : '') }}</textarea>
                                @else
                                    <input type="{{ $champ->type }}" 
                                           class="form-control form-control-lg" 
                                           id="champ_{{ $champ->id }}" 
                                           name="champ_{{ $champ->id }}"
                                           value="{{ old('champ_' . $champ->id, $torrefacteur && $torrefacteur->champsSupplementaires->contains($champ->id) ? $torrefacteur->champsSupplementaires->find($champ->id)->pivot->valeur : '') }}"
                                           {{ $champ->obligatoire ? 'required' : '' }}
                                           style="padding: 0.875rem 1.25rem;">
                                @endif
                            </div>
                        @endforeach
                    @endif

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 pt-4" style="border-top: 2px solid #c79c60;">
                        <a href="{{ route('torrefacteur.preview') }}" class="tm-more-button" style="background: #e4e4e4; color: #333; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="bi bi-eye me-2"></i>Prévisualiser
                        </a>
                        <button type="submit" class="tm-more-button" style="border: none; cursor: pointer;">
                            <i class="bi bi-check-circle me-2"></i>Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.getElementById('region_id').addEventListener('change', function() {
    const regionId = this.value;
    const departementSelect = document.getElementById('departement_id');
    
    departementSelect.innerHTML = '<option value="">Chargement...</option>';
    
    if (regionId) {
        fetch(`/api/departements/${regionId}`)
            .then(response => response.json())
            .then(data => {
                departementSelect.innerHTML = '<option value="">Sélectionner un département</option>';
                data.forEach(dept => {
                    const option = document.createElement('option');
                    option.value = dept.id;
                    option.textContent = dept.nom;
                    departementSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                departementSelect.innerHTML = '<option value="">Erreur de chargement</option>';
            });
    } else {
        departementSelect.innerHTML = '<option value="">Sélectionner un département</option>';
    }
});

</script>
@endpush
@endsection

