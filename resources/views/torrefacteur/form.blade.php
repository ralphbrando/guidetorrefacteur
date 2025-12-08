@extends('layouts.app')

@section('title', 'Formulaire Torréfacteur')

@section('content')
<section class="tm-section row">
    <div class="col-lg-12 tm-section-header-container">
        <h2 class="tm-section-header gold-text tm-handwriting-font">
            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo"> Formulaire Torréfacteur
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

                    <div class="d-flex align-items-center gap-2 mb-4 pb-3" style="border-bottom: 2px solid #c79c60;">
                        <i class="bi bi-info-circle gold-text" style="font-size: 1.5rem;"></i>
                        <h5 class="mb-0 gold-text">Informations générales</h5>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nom_brulerie" class="form-label">Nom de la Brulerie <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nom_brulerie') is-invalid @enderror" 
                                   id="nom_brulerie" name="nom_brulerie" 
                                   value="{{ old('nom_brulerie', $torrefacteur->nom_brulerie ?? '') }}" required>
                            @error('nom_brulerie')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="region_id" class="form-label">Région <span class="text-danger">*</span></label>
                            <select class="form-select @error('region_id') is-invalid @enderror" 
                                    id="region_id" name="region_id" required>
                                <option value="">Sélectionner une région</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" 
                                            {{ old('region_id', $torrefacteur->region_id ?? '') == $region->id ? 'selected' : '' }}>
                                        {{ $region->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('region_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="departement_id" class="form-label">Département <span class="text-danger">*</span></label>
                            <select class="form-select @error('departement_id') is-invalid @enderror" 
                                    id="departement_id" name="departement_id" required>
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
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                   id="logo" name="logo" accept="image/*">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($torrefacteur && $torrefacteur->logo)
                                <small class="text-muted">Logo actuel: <a href="{{ asset('storage/' . $torrefacteur->logo) }}" target="_blank">Voir</a></small>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="texte_descriptif" class="form-label">Texte descriptif</label>
                        <textarea class="form-control @error('texte_descriptif') is-invalid @enderror" 
                                  id="texte_descriptif" name="texte_descriptif" rows="4">{{ old('texte_descriptif', $torrefacteur->texte_descriptif ?? '') }}</textarea>
                        @error('texte_descriptif')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-4 mt-5 pb-3" style="border-bottom: 2px solid #c79c60;">
                        <i class="bi bi-telephone gold-text" style="font-size: 1.5rem;"></i>
                        <h5 class="mb-0 gold-text">Informations de contact</h5>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="prenom_nom_representant" class="form-label">Prénom NOM du représentant légal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('prenom_nom_representant') is-invalid @enderror" 
                                   id="prenom_nom_representant" name="prenom_nom_representant" 
                                   value="{{ old('prenom_nom_representant', $torrefacteur->prenom_nom_representant ?? '') }}" required>
                            @error('prenom_nom_representant')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('telephone') is-invalid @enderror" 
                                   id="telephone" name="telephone" 
                                   value="{{ old('telephone', $torrefacteur->telephone ?? '') }}" required>
                            @error('telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" 
                                   value="{{ old('email', $torrefacteur->email ?? '') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="site_internet" class="form-label">Site Internet</label>
                            <input type="url" class="form-control @error('site_internet') is-invalid @enderror" 
                                   id="site_internet" name="site_internet" 
                                   value="{{ old('site_internet', $torrefacteur->site_internet ?? '') }}">
                            @error('site_internet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('adresse') is-invalid @enderror" 
                                  id="adresse" name="adresse" rows="2" required>{{ old('adresse', $torrefacteur->adresse ?? '') }}</textarea>
                        @error('adresse')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo (dimensions fixes)</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                               id="photo" name="photo" accept="image/*">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($torrefacteur && $torrefacteur->photo)
                            <small class="text-muted">Photo actuelle: <a href="{{ asset('storage/' . $torrefacteur->photo) }}" target="_blank">Voir</a></small>
                        @endif
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-4 mt-5 pb-3" style="border-bottom: 2px solid #c79c60;">
                        <i class="bi bi-gear gold-text" style="font-size: 1.5rem;"></i>
                        <h5 class="mb-0 gold-text">Équipements</h5>
                    </div>
                    <div class="row mb-3">
                        @foreach($equipements as $equipement)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           id="equipement_{{ $equipement->id }}" 
                                           name="equipements[]" 
                                           value="{{ $equipement->id }}"
                                           {{ $torrefacteur && $torrefacteur->equipements->contains($equipement->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="equipement_{{ $equipement->id }}">
                                        {{ $equipement->nom }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-4 mt-5 pb-3" style="border-bottom: 2px solid #c79c60;">
                        <i class="bi bi-plus-circle gold-text" style="font-size: 1.5rem;"></i>
                        <h5 class="mb-0 gold-text">Informations supplémentaires</h5>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="machine_torrefier" class="form-label">Machine à torréfier</label>
                            <input type="text" class="form-control" 
                                   id="machine_torrefier" name="machine_torrefier" 
                                   value="{{ old('machine_torrefier', $torrefacteur->machine_torrefier ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="capacite_machine" class="form-label">Capacité de la machine</label>
                            <input type="text" class="form-control" 
                                   id="capacite_machine" name="capacite_machine" 
                                   value="{{ old('capacite_machine', $torrefacteur->capacite_machine ?? '') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="ateliers_decouvertes" name="ateliers_decouvertes" value="1"
                                       {{ old('ateliers_decouvertes', $torrefacteur->ateliers_decouvertes ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="ateliers_decouvertes">
                                    Organisation d'ateliers découvertes
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="degustations" name="degustations" value="1"
                                       {{ old('degustations', $torrefacteur->degustations ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="degustations">
                                    Dégustations
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="labels" class="form-label">Labels</label>
                        <input type="text" class="form-control" 
                               id="labels" name="labels" 
                               value="{{ old('labels', $torrefacteur->labels ?? '') }}">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="arabica" name="arabica" value="1"
                                       {{ old('arabica', $torrefacteur->arabica ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="arabica">Arabica</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="robusta" name="robusta" value="1"
                                       {{ old('robusta', $torrefacteur->robusta ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="robusta">Robusta</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="geisha" name="geisha" value="1"
                                       {{ old('geisha', $torrefacteur->geisha ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="geisha">Geisha</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="thes" name="thes" value="1"
                                       {{ old('thes', $torrefacteur->thes ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="thes">Thés</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="cacao" name="cacao" value="1"
                                       {{ old('cacao', $torrefacteur->cacao ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="cacao">Cacao</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="accessoires_cafe_domestique" name="accessoires_cafe_domestique" value="1"
                                       {{ old('accessoires_cafe_domestique', $torrefacteur->accessoires_cafe_domestique ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="accessoires_cafe_domestique">Accessoires café domestique</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="machines_domestiques" name="machines_domestiques" value="1"
                                       {{ old('machines_domestiques', $torrefacteur->machines_domestiques ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="machines_domestiques">Machines domestiques</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="accessoires_thes" name="accessoires_thes" value="1"
                                       {{ old('accessoires_thes', $torrefacteur->accessoires_thes ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="accessoires_thes">Accessoires thés</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="espace_professionnels" name="espace_professionnels" value="1"
                                       {{ old('espace_professionnels', $torrefacteur->espace_professionnels ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="espace_professionnels">Espace professionnels</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="cascara" name="cascara" value="1"
                                       {{ old('cascara', $torrefacteur->cascara ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="cascara">Cascara</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="formations_sca" name="formations_sca" value="1"
                                       {{ old('formations_sca', $torrefacteur->formations_sca ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="formations_sca">Formations SCA</label>
                            </div>
                        </div>
                    </div>

                    @if($champsSupplementaires->count() > 0)
                        <div class="d-flex align-items-center gap-2 mb-4 mt-5 pb-3" style="border-bottom: 2px solid #c79c60;">
                            <i class="bi bi-list-ul gold-text" style="font-size: 1.5rem;"></i>
                            <h5 class="mb-0 gold-text">Champs supplémentaires</h5>
                        </div>
                        @foreach($champsSupplementaires as $champ)
                            <div class="mb-3">
                                <label for="champ_{{ $champ->id }}" class="form-label">
                                    {{ $champ->nom }}
                                    @if($champ->obligatoire)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                @if($champ->type === 'textarea')
                                    <textarea class="form-control" 
                                              id="champ_{{ $champ->id }}" 
                                              name="champ_{{ $champ->id }}"
                                              {{ $champ->obligatoire ? 'required' : '' }}>{{ old('champ_' . $champ->id, $torrefacteur && $torrefacteur->champsSupplementaires->contains($champ->id) ? $torrefacteur->champsSupplementaires->find($champ->id)->pivot->valeur : '') }}</textarea>
                                @else
                                    <input type="{{ $champ->type }}" 
                                           class="form-control" 
                                           id="champ_{{ $champ->id }}" 
                                           name="champ_{{ $champ->id }}"
                                           value="{{ old('champ_' . $champ->id, $torrefacteur && $torrefacteur->champsSupplementaires->contains($champ->id) ? $torrefacteur->champsSupplementaires->find($champ->id)->pivot->valeur : '') }}"
                                           {{ $champ->obligatoire ? 'required' : '' }}>
                                @endif
                            </div>
                        @endforeach
                    @endif

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 pt-4" style="border-top: 2px solid #c79c60;">
                        <a href="{{ route('torrefacteur.preview') }}" class="tm-more-button" style="background: #e4e4e4; color: #333;">
                            Prévisualiser
                        </a>
                        <button type="submit" class="tm-more-button">
                            Enregistrer
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

