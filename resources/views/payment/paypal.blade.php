@extends('layouts.app')

@section('title', 'Paiement PayPal')

@section('content')
<section class="tm-section row">
    <div class="col-lg-12 tm-section-header-container">
        <h2 class="tm-section-header gold-text tm-handwriting-font" style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: nowrap; white-space: nowrap;">
            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo" style="flex-shrink: 0;"> 
            <span>Paiement PayPal</span>
        </h2>
        <div class="tm-hr-container"><hr class="tm-hr"></div>
    </div>
    
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="tm-special-item" style="background-color: white; padding: 3rem; border-radius: 16px;">
                    <!-- Récapitulatif -->
                    <div class="alert mb-5" style="background: linear-gradient(135deg, rgba(0, 112, 186, 0.1), rgba(0, 112, 186, 0.05)); border: 2px solid rgba(0, 112, 186, 0.3); border-left: 5px solid #0070ba; border-radius: 16px; padding: 1.5rem;">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div style="width: 48px; height: 48px; border-radius: 50%; background: rgba(0, 112, 186, 0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-paypal fs-4" style="color: #0070ba;"></i>
                            </div>
                            <div style="flex: 1;">
                                <p class="mb-1" style="font-size: 0.9rem; color: #666;">
                                    <strong style="color: #0070ba;">Facture :</strong> {{ $paiement->numero_facture }}
                                </p>
                                <p class="mb-0" style="font-size: 1.5rem; font-weight: 700;">
                                    <span style="color: #0070ba;">{{ number_format($paiement->montant, 2, ',', ' ') }} €</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Instructions PayPal -->
                    <div class="alert mb-5" style="background: rgba(199, 156, 96, 0.05); border: 1px solid rgba(199, 156, 96, 0.2); border-radius: 12px; padding: 1.5rem;">
                        <div class="d-flex align-items-start gap-3">
                            <i class="bi bi-info-circle gold-text" style="font-size: 1.5rem; margin-top: 0.125rem;"></i>
                            <div>
                                <h6 class="gold-text mb-3" style="font-weight: 700; font-size: 1.1rem;">Instructions de paiement</h6>
                                <p class="mb-3" style="color: #555; line-height: 1.7; font-size: 0.95rem;">
                                    Pour finaliser votre paiement via PayPal, veuillez suivre les étapes suivantes :
                                </p>
                                <ol style="color: #555; line-height: 1.8; padding-left: 1.5rem;">
                                    <li>Cliquez sur le bouton "Payer avec PayPal" ci-dessous</li>
                                    <li>Connectez-vous à votre compte PayPal</li>
                                    <li>Confirmez le montant et validez le paiement</li>
                                    <li>Vous serez redirigé automatiquement vers notre site</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton PayPal -->
                    <form method="POST" action="{{ route('payment.paypal.callback') }}" id="paypal-form">
                        @csrf
                        <input type="hidden" name="paiement_id" value="{{ $paiement->id }}">
                        <input type="hidden" name="paymentId" id="paymentId" value="">
                        <input type="hidden" name="PayerID" id="PayerID" value="">
                        
                        <div id="paypal-button-container" class="mb-4"></div>
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('payment.process') }}" class="gold-text" style="text-decoration: none; font-weight: 600;">
                            <i class="bi bi-arrow-left me-1"></i>Retour aux options de paiement
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
@if(config('paypal.client_id') && config('paypal.client_id') !== 'YOUR_PAYPAL_CLIENT_ID')
<script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.client_id') }}&currency=EUR&intent=capture"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{ number_format($paiement->montant, 2, '.', '') }}',
                        currency_code: 'EUR'
                    },
                    description: 'Facture {{ $paiement->numero_facture }}',
                    custom_id: '{{ $paiement->id }}'
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Set the payment ID and Payer ID
                document.getElementById('paymentId').value = data.orderID;
                document.getElementById('PayerID').value = details.payer.payer_id;
                
                // Submit the form
                document.getElementById('paypal-form').submit();
            });
        },
        onError: function(err) {
            alert('Une erreur est survenue lors du paiement PayPal. Veuillez réessayer.');
            console.error('PayPal Error:', err);
        },
        style: {
            color: 'blue',
            shape: 'rect',
            label: 'paypal',
            layout: 'vertical'
        }
    }).render('#paypal-button-container');
</script>
@else
<script>
    // Fallback si PayPal n'est pas configuré
    document.getElementById('paypal-button-container').innerHTML = `
        <div class="alert alert-warning" style="background: rgba(255, 193, 7, 0.1); border: 2px solid rgba(255, 193, 7, 0.3); border-radius: 12px; padding: 1.5rem;">
            <div class="d-flex align-items-start gap-3">
                <i class="bi bi-exclamation-triangle fs-4" style="color: #ff9800;"></i>
                <div>
                    <h6 class="mb-2" style="font-weight: 700; color: #856404;">PayPal non configuré</h6>
                    <p class="mb-3" style="color: #856404; line-height: 1.6;">
                        L'intégration PayPal n'est pas encore configurée. Pour le moment, vous pouvez utiliser le virement bancaire ou la carte de crédit.
                    </p>
                    <a href="{{ route('payment.process') }}" class="btn" style="background: #ffc107; color: #333; font-weight: 600; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="bi bi-arrow-left"></i>Retour aux options de paiement
                    </a>
                </div>
            </div>
        </div>
    `;
</script>
@endif
@endpush
@endsection

