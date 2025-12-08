@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<section class="tm-section row">
    <div class="col-lg-12 tm-section-header-container">
        <h2 class="tm-section-header gold-text tm-handwriting-font">
            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo"> Inscription
        </h2>
        <div class="tm-hr-container"><hr class="tm-hr"></div>
    </div>
    <div class="col-lg-7 col-md-9 mx-auto margin-top-60">
        <div class="tm-special-item" style="background-color: white; padding: 40px;">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label gold-text" style="font-weight: 600;">
                        <i class="bi bi-person me-2"></i>Nom
                    </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" 
                           placeholder="Votre nom complet" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label gold-text" style="font-weight: 600;">
                        <i class="bi bi-envelope me-2"></i>Email
                    </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" 
                           placeholder="votre@email.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label gold-text" style="font-weight: 600;">
                        <i class="bi bi-lock me-2"></i>Mot de passe
                    </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="Minimum 8 caractères" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label gold-text" style="font-weight: 600;">
                        <i class="bi bi-lock-fill me-2"></i>Confirmer le mot de passe
                    </label>
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation" 
                           placeholder="Répétez votre mot de passe" required>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="tm-more-button" style="margin: 0 auto;">
                        S'inscrire
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="gold-text" style="text-decoration: none;">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        Déjà inscrit ? Se connecter
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
