@extends('layouts.app')

@section('title', 'Offres Partenaires')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-10">
        <div class="card shadow-lg fade-in-up">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-credit-card"></i>
                    Offres Partenaires
                </h4>
            </div>
            <div class="card-body">
                <div class="alert alert-warning mb-4">
                    <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-exclamation-triangle fs-4" style="color: var(--coffee-gold);"></i>
                        <div>
                            <strong>Chers Partenaires,</strong> nous attirons votre attention que le nombre d'espaces publicitaires est limité. 
                            En conséquence les espaces disponibles seront servis en fonction du « premier commandé, premier servi » 
                            et nous nous excusons d'ores et déjà dans le cas où vous ne pourriez être tous servis, très cordialement.
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('payment.process') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="nom_societe" class="form-label">
                            <i class="bi bi-building me-2"></i>Nom de la société <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('nom_societe') is-invalid @enderror" 
                               id="nom_societe" name="nom_societe" 
                               value="{{ old('nom_societe', $torrefacteur->nom_brulerie ?? '') }}" 
                               placeholder="Nom de votre société" required>
                        @error('nom_societe')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom" style="border-color: var(--border-color) !important;">
                        <i class="bi bi-star" style="color: var(--coffee-accent); font-size: 1.5rem;"></i>
                        <h5 class="mb-0" style="color: var(--coffee-accent);">Choisissez votre offre :</h5>
                    </div>

                    <div class="row g-4">
                        @foreach($offres as $offre)
                            <div class="col-md-6">
                                <div class="card h-100 position-relative {{ $offre->code === 'G' ? 'border-warning' : '' }}" 
                                     style="cursor: pointer; transition: all var(--transition-base);"
                                     onclick="document.getElementById('offre_{{ $offre->id }}').checked = true; document.getElementById('offre_{{ $offre->id }}').dispatchEvent(new Event('change'));">
                                    @if($offre->code === 'G')
                                        <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-3" style="font-size: 0.75rem;">
                                            <i class="bi bi-star-fill me-1"></i>Populaire
                                        </span>
                                    @endif
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                                   name="offre_partenaire_id" 
                                                   id="offre_{{ $offre->id }}" 
                                                   value="{{ $offre->id }}"
                                                   {{ old('offre_partenaire_id', $torrefacteur->offre_partenaire_id ?? '') == $offre->id ? 'checked' : '' }}
                                                   required
                                                   onchange="document.querySelectorAll('.offer-card').forEach(c => c.classList.remove('selected')); this.closest('.card').classList.add('selected');">
                                            <label class="form-check-label w-100" for="offre_{{ $offre->id }}" style="cursor: pointer;">
                                                <h6 class="mb-3" style="color: var(--coffee-accent); font-weight: 700;">
                                                    {{ $offre->nom }}
                                                </h6>
                                                <p class="mb-3 text-muted">{{ $offre->description }}</p>
                                                <div class="d-flex align-items-baseline gap-2 mb-2">
                                                    <span class="fs-3 fw-bold" style="color: var(--coffee-accent);">
                                                        {{ number_format($offre->prix, 2, ',', ' ') }} €
                                                    </span>
                                                    @if($offre->nombre_guides > 0)
                                                        <span class="badge" style="background: var(--bg-glass-light); color: var(--text-secondary);">
                                                            <i class="bi bi-book me-1"></i>{{ $offre->nombre_guides }} Guides
                                                        </span>
                                                    @endif
                                                </div>
                                                @if($offre->limite)
                                                    <small class="text-muted d-block mb-2">
                                                        <i class="bi bi-people me-1"></i>
                                                        {{ $offre->limite - $offre->reserve }} places disponibles sur {{ $offre->limite }}
                                                    </small>
                                                @endif
                                                @if(!$offre->isDisponible())
                                                    <div class="alert alert-danger mt-2 mb-0">
                                                        <small><i class="bi bi-x-circle me-1"></i>Plus de places disponibles</small>
                                                    </div>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="alert alert-info mt-5">
                        <div class="d-flex align-items-start gap-3">
                            <i class="bi bi-info-circle fs-4" style="color: var(--coffee-accent);"></i>
                            <div>
                                <strong>Modes de paiement disponibles :</strong>
                                <ul class="mb-0 mt-2">
                                    <li><i class="bi bi-credit-card me-2"></i>Carte de crédit (Stripe)</li>
                                    <li><i class="bi bi-paypal me-2"></i>PayPal</li>
                                    <li><i class="bi bi-bank me-2"></i>Virement bancaire (IBAN sera fourni après validation)</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 pt-4 border-top" style="border-color: var(--border-color) !important;">
                        <a href="{{ route('torrefacteur.form') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Retour
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-arrow-right me-2"></i>Continuer vers le paiement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


