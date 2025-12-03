@extends('layouts.app')

@section('title', 'Paiement par carte')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Paiement par carte</h4>
            </div>
            <div class="card-body">
                <div id="stripe-payment-form">
                    <div id="card-element"></div>
                    <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                    <button id="submit-payment" class="btn btn-primary w-100 mt-3">
                        Payer {{ number_format($paiement->montant, 2, ',', ' ') }} €
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe('{{ config('stripe.key') }}');
const elements = stripe.elements();
const cardElement = elements.create('card');
cardElement.mount('#card-element');

const cardErrors = document.getElementById('card-errors');
cardElement.on('change', ({error}) => {
    if (error) {
        cardErrors.textContent = error.message;
    } else {
        cardErrors.textContent = '';
    }
});

const submitButton = document.getElementById('submit-payment');
submitButton.addEventListener('click', async (e) => {
    e.preventDefault();
    submitButton.disabled = true;
    submitButton.textContent = 'Traitement...';

    const {error, paymentIntent} = await stripe.confirmCardPayment('{{ $clientSecret }}', {
        payment_method: {
            card: cardElement,
        }
    });

    if (error) {
        cardErrors.textContent = error.message;
        submitButton.disabled = false;
        submitButton.textContent = 'Payer {{ number_format($paiement->montant, 2, ',', ' ') }} €';
    } else if (paymentIntent.status === 'succeeded') {
        window.location.href = '{{ route('payment.success') }}';
    }
});
</script>
@endpush
@endsection


