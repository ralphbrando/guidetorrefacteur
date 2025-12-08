@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<section class="tm-section row">
    <div class="col-lg-12 tm-section-header-container">
        <h2 class="tm-section-header gold-text tm-handwriting-font">
            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo"> Connexion
        </h2>
        <div class="tm-hr-container"><hr class="tm-hr"></div>
    </div>
    <div class="col-lg-6 col-md-8 mx-auto margin-top-60">
        <div class="tm-special-item" style="background-color: white; padding: 40px;">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label gold-text" style="font-weight: 600;">
                        <i class="bi bi-envelope me-2"></i>Email
                    </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" 
                           placeholder="votre@email.com" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label gold-text" style="font-weight: 600;">
                        <i class="bi bi-lock me-2"></i>Mot de passe
                    </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="••••••••" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="tm-more-button" style="margin: 0 auto;">
                        Se connecter
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="gold-text" style="text-decoration: none;">
                        <i class="bi bi-question-circle me-1"></i>
                        Mot de passe oublié ?
                    </a>
                </div>
            </form>
        </div>
        
        <div class="text-center mt-4">
            <p class="gray-text">
                Pas encore de compte ? 
                <a href="{{ route('register') }}" class="gold-text" style="text-decoration: none; font-weight: 600;">
                    S'inscrire
                </a>
            </p>
        </div>
    </div>
</section>
@endsection
