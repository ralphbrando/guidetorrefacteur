@extends('layouts.app')

@section('title', 'Paiement réussi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-check-circle"></i> Paiement réussi</h4>
            </div>
            <div class="card-body text-center">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                </div>
                <h5>Merci pour votre paiement !</h5>
                <p>Votre inscription a été confirmée avec succès.</p>
                
                @if($paiement)
                    <div class="alert alert-info text-start">
                        <h6>Détails de votre commande :</h6>
                        <p class="mb-1"><strong>Numéro de facture :</strong> {{ $paiement->numero_facture }}</p>
                        <p class="mb-1"><strong>Montant :</strong> {{ number_format($paiement->montant, 2, ',', ' ') }} €</p>
                        <p class="mb-0"><strong>Date :</strong> {{ $paiement->date_paiement->format('d/m/Y H:i') }}</p>
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('torrefacteur.form') }}" class="btn btn-primary">Retour à mon profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


