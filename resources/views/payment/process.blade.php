@extends('layouts.app')

@section('title', 'Paiement')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Paiement - {{ $offre->nom }}</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h5>Récapitulatif de votre commande</h5>
                    <p class="mb-1"><strong>Offre :</strong> {{ $offre->nom }}</p>
                    <p class="mb-1"><strong>Description :</strong> {{ $offre->description }}</p>
                    <p class="mb-1"><strong>Montant :</strong> {{ number_format($paiement->montant, 2, ',', ' ') }} €</p>
                    <p class="mb-0"><strong>Numéro de facture :</strong> {{ $paiement->numero_facture }}</p>
                </div>

                @if($paiement->montant > 0)
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5>Carte de crédit</h5>
                                    <form method="POST" action="{{ route('payment.stripe') }}">
                                        @csrf
                                        <input type="hidden" name="paiement_id" value="{{ $paiement->id }}">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-credit-card"></i> Payer par carte
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5>PayPal</h5>
                                    <form method="POST" action="{{ route('payment.paypal') }}">
                                        @csrf
                                        <input type="hidden" name="paiement_id" value="{{ $paiement->id }}">
                                        <button type="submit" class="btn btn-primary" style="background-color: #0070ba;">
                                            <i class="bi bi-paypal"></i> Payer avec PayPal
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <h5>Virement bancaire</h5>
                            <p>Pour payer par virement, veuillez utiliser les coordonnées suivantes :</p>
                            <p class="mb-0">
                                <strong>IBAN :</strong> FR76 XXXX XXXX XXXX XXXX XXXX XXX<br>
                                <strong>BIC :</strong> XXXXXXXX<br>
                                <strong>Référence :</strong> {{ $paiement->numero_facture }}
                            </p>
                            <p class="text-muted mt-2">
                                <small>Votre paiement sera validé dès réception du virement.</small>
                            </p>
                        </div>
                    </div>
                @else
                    <div class="alert alert-success">
                        <h5>Offre gratuite</h5>
                        <p>Votre inscription est gratuite. Aucun paiement n'est requis.</p>
                        <form method="POST" action="{{ route('payment.success') }}">
                            @csrf
                            <button type="submit" class="btn btn-success">Valider mon inscription</button>
                        </form>
                    </div>
                @endif

                <div class="alert alert-warning mt-4">
                    <strong>Attention :</strong> Cette action est définitive. En validant, vous confirmez votre inscription.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


