@extends('layouts.app')

@section('title', 'Offres Partenaires')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Offres Partenaires</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <strong>Chers Partenaires,</strong> nous attirons votre attention que le nombre d'espaces publicitaires est limité. 
                    En conséquence les espaces disponibles seront servis en fonction du « premier commandé, premier servi » 
                    et nous nous excusons d'ores et déjà dans le cas où vous ne pourriez être tous servis, très cordialement.
                </div>

                <form method="POST" action="{{ route('payment.process') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="nom_societe" class="form-label">Nom de la société <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nom_societe') is-invalid @enderror" 
                               id="nom_societe" name="nom_societe" 
                               value="{{ old('nom_societe', $torrefacteur->nom_brulerie ?? '') }}" required>
                        @error('nom_societe')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <h5 class="mb-3">Choisissez votre offre :</h5>

                    <div class="row">
                        @foreach($offres as $offre)
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 {{ $offre->code === 'G' ? 'border-warning' : '' }}">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                                   name="offre_partenaire_id" 
                                                   id="offre_{{ $offre->id }}" 
                                                   value="{{ $offre->id }}"
                                                   {{ old('offre_partenaire_id', $torrefacteur->offre_partenaire_id ?? '') == $offre->id ? 'checked' : '' }}
                                                   required>
                                            <label class="form-check-label w-100" for="offre_{{ $offre->id }}">
                                                <strong>{{ $offre->nom }}</strong>
                                                <div class="mt-2">
                                                    <p class="mb-1">{{ $offre->description }}</p>
                                                    <p class="mb-0">
                                                        <strong class="text-primary">{{ number_format($offre->prix, 2, ',', ' ') }} €</strong>
                                                        @if($offre->nombre_guides > 0)
                                                            <span class="text-muted">+ {{ $offre->nombre_guides }} Guides</span>
                                                        @endif
                                                    </p>
                                                    @if($offre->limite)
                                                        <small class="text-muted">
                                                            Limite: {{ $offre->limite }} places 
                                                            ({{ $offre->reserve }} réservées, {{ $offre->limite - $offre->reserve }} disponibles)
                                                        </small>
                                                    @endif
                                                    @if(!$offre->isDisponible())
                                                        <div class="alert alert-danger mt-2 mb-0">
                                                            <small>Plus de places disponibles</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="alert alert-info mt-4">
                        <strong>Modes de paiement disponibles :</strong>
                        <ul class="mb-0">
                            <li>Carte de crédit (Stripe)</li>
                            <li>PayPal</li>
                            <li>Virement bancaire (IBAN sera fourni après validation)</li>
                        </ul>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('torrefacteur.form') }}" class="btn btn-outline-secondary">Retour</a>
                        <button type="submit" class="btn btn-primary">Continuer vers le paiement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


