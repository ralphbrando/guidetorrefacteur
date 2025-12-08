@extends('layouts.app')

@section('title', 'Paiement par carte')

@section('content')
<section class="tm-section row">
    <div class="col-lg-12 tm-section-header-container">
        <h2 class="tm-section-header gold-text tm-handwriting-font" style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: nowrap; white-space: nowrap;">
            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo" style="flex-shrink: 0;"> 
            <span>Paiement par carte</span>
        </h2>
        <div class="tm-hr-container"><hr class="tm-hr"></div>
    </div>
    
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="tm-special-item" style="background-color: white; padding: 3rem; border-radius: 16px;">
                    <!-- Récapitulatif -->
                    <div class="alert mb-5" style="background: linear-gradient(135deg, rgba(199, 156, 96, 0.1), rgba(199, 156, 96, 0.05)); border: 2px solid rgba(199, 156, 96, 0.3); border-left: 5px solid #c79c60; border-radius: 16px; padding: 1.5rem;">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div style="width: 48px; height: 48px; border-radius: 50%; background: rgba(199, 156, 96, 0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-receipt-cutoff fs-4 gold-text"></i>
                            </div>
                            <div style="flex: 1;">
                                <p class="mb-1" style="font-size: 0.9rem; color: #666;">
                                    <strong class="gold-text">Facture :</strong> {{ $paiement->numero_facture }}
                                </p>
                                <p class="mb-0" style="font-size: 1.5rem; font-weight: 700;">
                                    <span class="gold-text">{{ number_format($paiement->montant, 2, ',', ' ') }} €</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire Stripe -->
                    <div id="stripe-payment-form">
                        <div class="mb-4">
                            <label class="form-label gold-text" style="font-weight: 600; font-size: 1.1rem; margin-bottom: 1rem; display: block;">
                                <i class="bi bi-credit-card me-2"></i>Informations de la carte
                            </label>
                            <div id="card-element" style="padding: 1rem 1.5rem; border: 2px solid #ddd; border-radius: 12px; background: #fff; transition: all 0.3s ease;"></div>
                            <div id="card-errors" role="alert" class="text-danger mt-3" style="padding: 0.75rem 1rem; background: rgba(220, 53, 69, 0.1); border: 1px solid rgba(220, 53, 69, 0.3); border-radius: 8px; display: none;"></div>
                        </div>

                        <div class="alert mb-4" style="background: rgba(199, 156, 96, 0.05); border: 1px solid rgba(199, 156, 96, 0.2); border-radius: 12px; padding: 1rem;">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-shield-check gold-text" style="font-size: 1.25rem; margin-top: 0.125rem;"></i>
                                <div>
                                    <p class="mb-0" style="font-size: 0.9rem; color: #555; line-height: 1.6;">
                                        <strong class="gold-text">Paiement sécurisé</strong> par Stripe. Vos informations bancaires sont cryptées et ne sont jamais stockées sur nos serveurs.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <button id="submit-payment" class="tm-more-button btn w-100" style="padding: 1rem 2rem; font-weight: 600; border: none; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                            <i class="bi bi-lock-fill me-2"></i>Payer {{ number_format($paiement->montant, 2, ',', ' ') }} €
                        </button>

                        <div class="text-center mt-4">
                            <a href="{{ route('payment.process') }}" class="gold-text" style="text-decoration: none; font-weight: 600;">
                                <i class="bi bi-arrow-left me-1"></i>Retour aux options de paiement
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    /* Style Stripe Elements */
    .StripeElement {
        box-sizing: border-box;
        height: 50px;
        padding: 12px 16px;
        border: 2px solid #ddd;
        border-radius: 12px;
        background-color: white;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .StripeElement--focus {
        border-color: #c79c60;
        box-shadow: 0 0 0 0.2rem rgba(199, 156, 96, 0.25);
        outline: none;
    }

    .StripeElement--invalid {
        border-color: #dc3545;
    }

    .StripeElement--complete {
        border-color: #28a745;
    }

    #card-element {
        padding: 0 !important;
    }

    #submit-payment:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>
@endpush

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe('{{ config('stripe.key') }}');
const elements = stripe.elements({
    appearance: {
        theme: 'stripe',
        variables: {
            colorPrimary: '#c79c60',
            colorBackground: '#ffffff',
            colorText: '#333333',
            colorDanger: '#dc3545',
            fontFamily: 'system-ui, sans-serif',
            spacingUnit: '4px',
            borderRadius: '12px',
        }
    }
});

const cardElement = elements.create('card', {
    style: {
        base: {
            fontSize: '16px',
            color: '#333',
            '::placeholder': {
                color: '#999',
            },
        },
        invalid: {
            color: '#dc3545',
        },
    },
});

cardElement.mount('#card-element');

const cardErrors = document.getElementById('card-errors');
cardElement.on('change', ({error}) => {
    if (error) {
        cardErrors.textContent = error.message;
        cardErrors.style.display = 'block';
    } else {
        cardErrors.textContent = '';
        cardErrors.style.display = 'none';
    }
});

const submitButton = document.getElementById('submit-payment');
submitButton.addEventListener('click', async (e) => {
    e.preventDefault();
    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Traitement en cours...';

    const {error, paymentIntent} = await stripe.confirmCardPayment('{{ $clientSecret }}', {
        payment_method: {
            card: cardElement,
        }
    });

    if (error) {
        cardErrors.textContent = error.message;
        cardErrors.style.display = 'block';
        submitButton.disabled = false;
        submitButton.innerHTML = '<i class="bi bi-lock-fill me-2"></i>Payer {{ number_format($paiement->montant, 2, ',', ' ') }} €';
    } else if (paymentIntent.status === 'succeeded') {
        submitButton.innerHTML = '<i class="bi bi-check-circle me-2"></i>Paiement réussi !';
        setTimeout(() => {
            window.location.href = '{{ route('payment.success') }}?payment_intent=' + paymentIntent.id;
        }, 1000);
    }
});
</script>
@endpush
@endsection


