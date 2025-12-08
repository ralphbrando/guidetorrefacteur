@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<section class="tm-section row" style="position: relative; overflow: hidden;">
    <!-- Image de fond décorative -->
    <div style="position: absolute; top: 0; right: 0; width: 45%; height: 100%; opacity: 0.1; z-index: 0; background: url('/img/template/special-1.jpg') no-repeat center; background-size: cover; filter: blur(2px);"></div>
    
    <div class="col-lg-12 tm-section-header-container" style="position: relative; z-index: 1;">
        <h2 class="tm-section-header gold-text tm-handwriting-font">
            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo"> Inscription
        </h2>
        <div class="tm-hr-container"><hr class="tm-hr"></div>
    </div>
    
    <div class="col-lg-10 mx-auto margin-top-60" style="position: relative; z-index: 1;">
        <div class="row align-items-center">
            <!-- Image décorative -->
            <div class="col-lg-5 col-md-6 d-none d-md-block mb-4 mb-md-0">
                <div class="text-center">
                    <div class="inline-block shadow-img" style="position: relative;">
                        <img src="/img/template/popular-2.jpg" alt="Café" class="img-circle img-thumbnail" style="max-width: 100%; height: auto;">
                        <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: url('/img/template/logo.png') no-repeat center; background-size: contain; opacity: 0.3;"></div>
                    </div>
                    <p class="mt-4 gray-text" style="font-style: italic;">
                        Rejoignez notre communauté de torréfacteurs passionnés
                    </p>
                </div>
            </div>
            
            <!-- Formulaire -->
            <div class="col-lg-7 col-md-6">
                <div class="tm-special-item" style="background-color: white; padding: 50px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label gold-text" style="font-weight: 600; font-size: 1rem; margin-bottom: 0.75rem; display: block;">
                                <i class="bi bi-person me-2"></i>Nom complet
                            </label>
                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" 
                                   placeholder="Votre nom complet" required autofocus
                                   style="padding: 1rem 1.25rem; font-size: 1rem;">
                            @error('name')
                                <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label gold-text" style="font-weight: 600; font-size: 1rem; margin-bottom: 0.75rem; display: block;">
                                <i class="bi bi-envelope me-2"></i>Adresse email
                            </label>
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="votre@email.com" required
                                   style="padding: 1rem 1.25rem; font-size: 1rem;">
                            @error('email')
                                <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label gold-text" style="font-weight: 600; font-size: 1rem; margin-bottom: 0.75rem; display: block;">
                                <i class="bi bi-lock me-2"></i>Mot de passe
                            </label>
                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="Minimum 8 caractères" required
                                   style="padding: 1rem 1.25rem; font-size: 1rem;">
                            @error('password')
                                <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-1"></i>Le mot de passe doit contenir au moins 8 caractères
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label gold-text" style="font-weight: 600; font-size: 1rem; margin-bottom: 0.75rem; display: block;">
                                <i class="bi bi-lock-fill me-2"></i>Confirmer le mot de passe
                            </label>
                            <input type="password" class="form-control form-control-lg" 
                                   id="password_confirmation" name="password_confirmation" 
                                   placeholder="Répétez votre mot de passe" required
                                   style="padding: 1rem 1.25rem; font-size: 1rem;">
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms" style="font-size: 0.9rem;">
                                    J'accepte les <a href="{{ route('legal.mentions') }}" target="_blank" class="gold-text">mentions légales</a> et la politique de confidentialité
                                </label>
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="tm-more-button" style="margin: 0 auto; padding: 1rem 2rem; font-size: 1.1rem;">
                                <i class="bi bi-person-plus me-2"></i>S'inscrire
                            </button>
                        </div>

                        <div class="text-center pt-3" style="border-top: 1px solid #e0e0e0;">
                            <p class="mb-0 gray-text">
                                Déjà inscrit ? 
                                <a href="{{ route('login') }}" class="gold-text" style="text-decoration: none; font-weight: 600;">
                                    <i class="bi bi-box-arrow-in-right me-1"></i>Se connecter
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
