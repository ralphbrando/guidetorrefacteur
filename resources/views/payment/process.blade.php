@extends('layouts.app')

@section('title', 'Paiement')

@section('content')
<section class="tm-section row">
    <div class="col-lg-12 tm-section-header-container">
        <h2 class="tm-section-header gold-text tm-handwriting-font" style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: nowrap; white-space: nowrap;">
            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo" style="flex-shrink: 0;"> 
            <span>Paiement - {{ $offre->nom }}</span>
        </h2>
        <div class="tm-hr-container"><hr class="tm-hr"></div>
    </div>
    
    <div class="col-12">
        <div class="tm-special-item" style="background-color: white; padding: 3rem;">
            <!-- Récapitulatif -->
            <div class="alert mb-5" style="background: linear-gradient(135deg, rgba(199, 156, 96, 0.1), rgba(199, 156, 96, 0.05)); border: 2px solid rgba(199, 156, 96, 0.3); border-left: 5px solid #c79c60; border-radius: 16px; padding: 2rem;">
                <div class="d-flex align-items-start gap-3 mb-4">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: rgba(199, 156, 96, 0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="bi bi-receipt-cutoff fs-3 gold-text"></i>
                    </div>
                    <div style="flex: 1;">
                        <h4 class="gold-text mb-4" style="font-weight: 700; font-size: 1.5rem;">Récapitulatif de votre commande</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="mb-2" style="font-size: 1rem;">
                                    <strong class="gold-text" style="font-weight: 600;"><i class="bi bi-tag me-2"></i>Offre :</strong> 
                                    <span style="color: #333;">{{ $offre->nom }}</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2" style="font-size: 1rem;">
                                    <strong class="gold-text" style="font-weight: 600;"><i class="bi bi-file-text me-2"></i>Facture :</strong> 
                                    <span style="color: #333; font-family: monospace;">{{ $paiement->numero_facture }}</span>
                                </p>
                            </div>
                            <div class="col-md-12">
                                <p class="mb-2" style="font-size: 1rem;">
                                    <strong class="gold-text" style="font-weight: 600;"><i class="bi bi-info-circle me-2"></i>Description :</strong> 
                                    <span style="color: #333;">{{ $offre->description }}</span>
                                </p>
                            </div>
                            <div class="col-md-12">
                                <div style="padding: 1.5rem; background: rgba(199, 156, 96, 0.1); border-radius: 12px; border: 2px solid rgba(199, 156, 96, 0.2);">
                                    <p class="mb-0" style="font-size: 1.1rem;">
                                        <strong class="gold-text" style="font-weight: 700; font-size: 1.3rem;"><i class="bi bi-currency-euro me-2"></i>Montant :</strong> 
                                        <span class="gold-text" style="font-size: 2rem; font-weight: 700;">{{ number_format($paiement->montant, 2, ',', ' ') }} €</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($paiement->montant > 0)
                <!-- Options de paiement -->
                <div class="d-flex align-items-center gap-2 mb-5 pb-4" style="border-bottom: 2px solid #c79c60; white-space: nowrap; margin-bottom: 2.5rem !important; padding-bottom: 1.5rem !important;">
                    <i class="bi bi-credit-card-2-front gold-text" style="font-size: 1.75rem;"></i>
                    <h4 class="mb-0 gold-text" style="font-weight: 700; font-size: 1.5rem;">Modes de paiement</h4>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <div class="card h-100" style="border: 2px solid #e0e0e0; border-radius: 16px; transition: all 0.3s ease; background: #fff;">
                            <div class="card-body p-4 text-center" style="padding:20px;display: flex; flex-direction: column; justify-content: space-between; min-height: 200px;">
                                <div>
                                    <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(199, 156, 96, 0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                                        <i class="bi bi-credit-card fs-2 gold-text"></i>
                                    </div>
                                    <h5 class="gold-text mb-3" style="font-weight: 700; font-size: 1.25rem;">Carte de crédit</h5>
                                    <p class="text-muted mb-4" style="font-size: 0.95rem;">Paiement sécurisé par Stripe</p>
                                </div>
                                <form method="POST" action="{{ route('payment.stripe') }}">
                                    @csrf
                                    <input type="hidden" name="paiement_id" value="{{ $paiement->id }}">
                                    <button type="submit" class="tm-more-button btn w-100" style="padding: 0.875rem 2rem; font-weight: 600; border: none; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-credit-card me-2"></i>Payer par carte
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100" style="border: 2px solid #e0e0e0; border-radius: 16px; transition: all 0.3s ease; background: #fff;">
                            <div class="card-body p-4 text-center" style="padding: 20px; display: flex; flex-direction: column; justify-content: space-between; min-height: 200px;">
                                <div>
                                    <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(0, 112, 186, 0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                                        <i class="bi bi-paypal fs-2" style="color: #0070ba;"></i>
                                    </div>
                                    <h5 class="mb-3" style="font-weight: 700; font-size: 1.25rem; color: #0070ba;">PayPal</h5>
                                    <p class="text-muted mb-4" style="font-size: 0.95rem;">Paiement rapide et sécurisé</p>
                                </div>
                                <form method="POST" action="{{ route('payment.paypal') }}">
                                    @csrf
                                    <input type="hidden" name="paiement_id" value="{{ $paiement->id }}">
                                    <button type="submit" class="btn w-100" style="background: #0070ba; color: white; padding: 0.875rem 2rem; font-weight: 600; border: none; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
                                        <i class="bi bi-paypal me-2"></i>Payer avec PayPal
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Virement bancaire -->
                <div class="card mb-5" style="border: 2px solid rgba(199, 156, 96, 0.3); border-radius: 16px; background: linear-gradient(135deg, rgba(199, 156, 96, 0.05), rgba(199, 156, 96, 0.02));">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width: 48px; height: 48px; border-radius: 50%; background: rgba(199, 156, 96, 0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-bank fs-4 gold-text"></i>
                            </div>
                            <h5 class="mb-0 gold-text" style="font-weight: 700; font-size: 1.25rem;">Virement bancaire</h5>
                        </div>
                        <p class="mb-4" style="color: #555; line-height: 1.7;">Pour payer par virement, veuillez utiliser les coordonnées suivantes :</p>
                        <div style="background: white; padding: 1.5rem; border-radius: 12px; border: 1px solid rgba(199, 156, 96, 0.2);">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <p class="mb-2" style="font-size: 1rem;">
                                        <strong class="gold-text" style="font-weight: 600;"><i class="bi bi-bank me-2"></i>IBAN :</strong> 
                                        <span style="color: #333; font-family: monospace; font-size: 1.1rem;">FR76 XXXX XXXX XXXX XXXX XXXX XXX</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2" style="font-size: 1rem;">
                                        <strong class="gold-text" style="font-weight: 600;"><i class="bi bi-building me-2"></i>BIC :</strong> 
                                        <span style="color: #333; font-family: monospace;">XXXXXXXX</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2" style="font-size: 1rem;">
                                        <strong class="gold-text" style="font-weight: 600;"><i class="bi bi-hash me-2"></i>Référence :</strong> 
                                        <span style="color: #333; font-family: monospace; font-weight: 600;">{{ $paiement->numero_facture }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0" style="font-size: 0.9rem; font-style: italic;">
                            <i class="bi bi-info-circle me-1"></i>Votre paiement sera validé dès réception du virement.
                        </p>
                    </div>
                </div>
            @else
                <!-- Offre gratuite -->
                <div class="alert mb-5" style="background: linear-gradient(135deg, rgba(46, 213, 115, 0.15), rgba(46, 213, 115, 0.05)); border: 2px solid rgba(46, 213, 115, 0.4); border-left: 5px solid #2ed573; border-radius: 16px; padding: 2rem;">
                    <div class="d-flex align-items-start gap-3">
                        <div style="width: 56px; height: 56px; border-radius: 50%; background: rgba(46, 213, 115, 0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="bi bi-check-circle fs-3" style="color: #2ed573;"></i>
                        </div>
                        <div style="flex: 1;">
                            <h5 class="mb-3" style="font-weight: 700; font-size: 1.3rem; color: #27ae60;">Offre gratuite</h5>
                            <p class="mb-4" style="color: #333; line-height: 1.7; font-size: 1rem;">Votre inscription est gratuite. Aucun paiement n'est requis.</p>
                            <form method="POST" action="{{ route('payment.success') }}">
                                @csrf
                                <button type="submit" class="tm-more-button btn" style="padding: 0.875rem 2rem; font-weight: 600; border: none; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-check-circle me-2"></i>Valider mon inscription
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Avertissement -->
            <div class="alert mt-5" style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.15), rgba(255, 193, 7, 0.05)); border: 2px solid rgba(255, 193, 7, 0.4); border-left: 5px solid #ffc107; border-radius: 16px; padding: 1.5rem; margin-top: 3rem !important;">
                <div class="d-flex align-items-start gap-3">
                    <div style="width: 48px; height: 48px; border-radius: 50%; background: rgba(255, 193, 7, 0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="bi bi-exclamation-triangle fs-4" style="color: #ff9800;"></i>
                    </div>
                    <div style="flex: 1;">
                        <p class="mb-0" style="line-height: 1.7; font-size: 1rem; color: #856404;">
                            <strong>Attention :</strong> Cette action est définitive. En validant, vous confirmez votre inscription.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bouton retour -->
            <div class="d-flex justify-content-start mt-5 pt-4" style="border-top: 2px solid #c79c60; margin-top: 3rem !important; padding-top: 2rem !important;">
                <a href="{{ route('payment.index') }}" class="tm-more-button btn" style="background: #f5f5f5; color: #333; border: 2px solid #ddd; padding: 0.875rem 2rem; font-weight: 600; text-align: center; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; margin-right: 1rem;">
                    <i class="bi bi-arrow-left me-2"></i>Retour
                </a>
            </div>
        </div>
    </div>
</section>
@endsection


