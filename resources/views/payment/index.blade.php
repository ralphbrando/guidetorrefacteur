@extends('layouts.app')

@section('title', 'Offres Partenaires')

@section('content')
<section class="tm-section row">
    <div class="col-lg-12 tm-section-header-container">
        <h2 class="tm-section-header gold-text tm-handwriting-font">
            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo"> Offres Partenaires
        </h2>
        <div class="tm-hr-container"><hr class="tm-hr"></div>
    </div>
    <div class="col-12">
        <div class="tm-special-item" style="background-color: white; padding: 3rem;">
                <div class="alert mb-5" style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.15), rgba(255, 193, 7, 0.05)); border: 2px solid rgba(255, 193, 7, 0.4); border-left: 5px solid #ffc107; border-radius: 16px; color: #333; padding: 1.5rem; box-shadow: 0 4px 12px rgba(255, 193, 7, 0.1); margin-bottom: 2.5rem !important;">
                    <div class="d-flex align-items-start gap-3">
                        <div style="width: 48px; height: 48px; border-radius: 50%; background: rgba(255, 193, 7, 0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="bi bi-exclamation-triangle fs-4" style="color: #ff9800;"></i>
                        </div>
                        <div style="flex: 1;">
                            <h6 class="mb-2" style="font-weight: 700; color: #856404; font-size: 1.1rem;">Chers Partenaires,</h6>
                            <p class="mb-0" style="line-height: 1.7; font-size: 0.95rem;">
                                Nous attirons votre attention que le nombre d'espaces publicitaires est limité. 
                                En conséquence les espaces disponibles seront servis en fonction du « premier commandé, premier servi » 
                                et nous nous excusons d'ores et déjà dans le cas où vous ne pourriez être tous servis, très cordialement.
                            </p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('payment.process') }}">
                    @csrf

                    <div class="mb-5" style="margin-bottom: 2.5rem !important;">
                        <label for="nom_societe" class="form-label gold-text" style="font-weight: 600; font-size: 1.1rem; margin-bottom: 1rem; display: block;">
                            <i class="bi bi-building me-2"></i>Nom de la société <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control form-control-lg @error('nom_societe') is-invalid @enderror" 
                               id="nom_societe" name="nom_societe" 
                               value="{{ old('nom_societe', $torrefacteur->nom_brulerie ?? '') }}" 
                               placeholder="Nom de votre société" required
                               style="padding: 1rem 1.5rem; border-radius: 12px; border: 2px solid #ddd; font-size: 1rem;">
                        @error('nom_societe')
                            <div class="invalid-feedback" style="margin-top: 0.75rem; display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-5 pb-4" style="border-bottom: 2px solid #c79c60; white-space: nowrap; margin-bottom: 2.5rem !important; padding-bottom: 1.5rem !important;">
                        <i class="bi bi-star-fill gold-text" style="font-size: 1.75rem;"></i>
                        <h4 class="mb-0 gold-text" style="font-weight: 700; font-size: 1.5rem;">Choisissez votre offre :</h4>
                    </div>

                    <div class="row g-4" style="margin-bottom: 2rem;">
                        @foreach($offres as $offre)
                            <div class="col-md-6" style="margin-top: 1.5rem;">
                                <div class="offer-card card h-100 position-relative {{ old('offre_partenaire_id', $torrefacteur->offre_partenaire_id ?? '') == $offre->id ? 'selected' : '' }}" 
                                     style="cursor: pointer; border: 2px solid #e0e0e0; border-radius: 16px; overflow: hidden; transition: all 0.3s ease; background: #fff; min-height: 320px; display: flex; flex-direction: column;"
                                     onclick="document.getElementById('offre_{{ $offre->id }}').checked = true; document.getElementById('offre_{{ $offre->id }}').dispatchEvent(new Event('change'));">
                                    @if($offre->code === 'G')
                                        <div class="position-absolute top-0 end-0 m-3" style="z-index: 10;">
                                            <span class="badge" style="background: linear-gradient(135deg, #ffd700, #ffed4e); color: #333; padding: 0.5rem 1rem; font-weight: 700; font-size: 0.75rem; box-shadow: 0 4px 12px rgba(255, 215, 0, 0.4);">
                                                <i class="bi bi-star-fill me-1"></i>Populaire
                                            </span>
                                        </div>
                                    @endif
                                    <div class="card-body p-4" style="display: flex; flex-direction: column; flex: 1;">
                                        <div class="form-check m-0">
                                            <input class="form-check-input" type="radio" 
                                                   name="offre_partenaire_id" 
                                                   id="offre_{{ $offre->id }}" 
                                                   value="{{ $offre->id }}"
                                                   {{ old('offre_partenaire_id', $torrefacteur->offre_partenaire_id ?? '') == $offre->id ? 'checked' : '' }}
                                                   required
                                                   onchange="document.querySelectorAll('.offer-card').forEach(c => c.classList.remove('selected')); this.closest('.offer-card').classList.add('selected');"
                                                   style="width: 1.25rem; height: 1.25rem; margin-top: 0.25rem;">
                                            <label class="form-check-label w-100" for="offre_{{ $offre->id }}" style="cursor: pointer;">
                                                <h5 class="mb-3 gold-text" style="font-weight: 700; font-size: 1.25rem; line-height: 1.4;">
                                                    {{ $offre->nom }}
                                                </h5>
                                                <p class="mb-4 text-muted" style="font-size: 0.95rem; line-height: 1.6; min-height: 3rem;">{{ $offre->description }}</p>
                                                <div class="d-flex align-items-baseline gap-3 mb-3">
                                                    <span class="fs-2 fw-bold gold-text" style="font-size: 2rem !important; line-height: 1;">
                                                        @php
                                                            $prixValue = 0.00;
                                                            if (isset($offre->prix) && $offre->prix !== null) {
                                                                $prixValue = is_numeric($offre->prix) ? (float)$offre->prix : 0.00;
                                                            }
                                                            $prixFormatted = number_format((float)$prixValue, 2, ',', ' ');
                                                        @endphp
                                                        {{ $prixFormatted }} €
                                                    </span>
                                                    @if(isset($offre->nombre_guides) && $offre->nombre_guides > 0)
                                                        <span class="badge" style="background: linear-gradient(135deg, rgba(199, 156, 96, 0.2), rgba(199, 156, 96, 0.1)); color: #c79c60; padding: 0.5rem 1rem; font-weight: 600; font-size: 0.9rem; border: 1px solid rgba(199, 156, 96, 0.3);">
                                                            <i class="bi bi-book me-1"></i>{{ $offre->nombre_guides }} Guides
                                                        </span>
                                                    @endif
                                                </div>
                                                @if(isset($offre->limite) && $offre->limite !== null && $offre->limite > 0)
                                                    <div class="mb-3" style="padding: 0.75rem; background: rgba(199, 156, 96, 0.05); border-radius: 8px; border-left: 3px solid #c79c60;">
                                                        <small class="text-muted d-flex align-items-center" style="font-weight: 500;">
                                                            <i class="bi bi-people me-2 gold-text"></i>
                                                            @php
                                                                $limiteValue = isset($offre->limite) && is_numeric($offre->limite) ? (int)$offre->limite : 0;
                                                                $reserveValue = isset($offre->reserve) && is_numeric($offre->reserve) ? (int)$offre->reserve : 0;
                                                                $disponiblesValue = max(0, $limiteValue - $reserveValue);
                                                            @endphp
                                                            <span><strong class="gold-text">{{ $disponiblesValue }}</strong> places disponibles sur <strong>{{ $limiteValue }}</strong></span>
                                                        </small>
                                                    </div>
                                                @endif
                                                @php
                                                    try {
                                                        $isDisponible = method_exists($offre, 'isDisponible') ? $offre->isDisponible() : true;
                                                    } catch (\Exception $e) {
                                                        $isDisponible = true;
                                                    }
                                                @endphp
                                                @if(!$isDisponible)
                                                    <div class="alert alert-danger mt-2 mb-0" style="border-radius: 8px; padding: 0.75rem;">
                                                        <small class="d-flex align-items-center"><i class="bi bi-x-circle me-2"></i>Plus de places disponibles</small>
                                                    </div>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="alert mt-5 mb-5" style="background: linear-gradient(135deg, rgba(199, 156, 96, 0.1), rgba(199, 156, 96, 0.05)); border: 2px solid rgba(199, 156, 96, 0.3); border-radius: 16px; color: #333; padding: 1.5rem; margin-top: 3rem !important; margin-bottom: 2.5rem !important;">
                        <div class="d-flex align-items-start gap-3">
                            <div style="width: 48px; height: 48px; border-radius: 50%; background: rgba(199, 156, 96, 0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-info-circle fs-4 gold-text"></i>
                            </div>
                            <div style="flex: 1;">
                                <h6 class="gold-text mb-3" style="font-weight: 700; font-size: 1.1rem;">Modes de paiement disponibles :</h6>
                                <ul class="mb-0" style="list-style: none; padding: 0;">
                                    <li class="mb-2" style="padding: 0.5rem 0; border-bottom: 1px solid rgba(199, 156, 96, 0.1);">
                                        <i class="bi bi-credit-card me-2 gold-text"></i><strong>Carte de crédit</strong> (Stripe)
                                    </li>
                                    <li class="mb-2" style="padding: 0.5rem 0; border-bottom: 1px solid rgba(199, 156, 96, 0.1);">
                                        <i class="bi bi-paypal me-2 gold-text"></i><strong>PayPal</strong>
                                    </li>
                                    <li style="padding: 0.5rem 0;">
                                        <i class="bi bi-bank me-2 gold-text"></i><strong>Virement bancaire</strong> (IBAN sera fourni après validation)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-3 d-md-flex justify-content-md-end mt-5 pt-5" style="border-top: 2px solid #c79c60; margin-top: 3rem !important; padding-top: 2rem !important;">
                        <a href="{{ route('torrefacteur.form') }}" class="tm-more-button btn" style="background: #f5f5f5; color: #333; border: 2px solid #ddd; padding: 0.875rem 2rem; font-weight: 600; min-width: 150px; text-align: center; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; margin-right: 1rem;">
                            <i class="bi bi-arrow-left me-2"></i>Retour
                        </a>
                        <button type="submit" class="tm-more-button btn" style="padding: 0.875rem 2rem; font-weight: 600; min-width: 250px; border: none; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="bi bi-credit-card me-2"></i>Continuer vers le paiement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


