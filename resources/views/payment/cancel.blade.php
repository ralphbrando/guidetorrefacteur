@extends('layouts.app')

@section('title', 'Paiement annulé')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0"><i class="bi bi-x-circle"></i> Paiement annulé</h4>
            </div>
            <div class="card-body text-center">
                <div class="mb-4">
                    <i class="bi bi-x-circle-fill text-warning" style="font-size: 4rem;"></i>
                </div>
                <h5>Paiement annulé</h5>
                <p>Votre paiement a été annulé. Vous pouvez réessayer plus tard.</p>
                
                <div class="mt-4">
                    <a href="{{ route('payment.index') }}" class="btn btn-primary">Réessayer</a>
                    <a href="{{ route('torrefacteur.form') }}" class="btn btn-outline-secondary">Retour à mon profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


