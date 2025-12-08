@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<section class="tm-section row" style="position: relative; overflow: hidden;">
    <!-- Image de fond décorative -->
    <div style="position: absolute; top: 0; left: 0; width: 45%; height: 100%; opacity: 0.1; z-index: 0; background: url('/img/template/popular-1.jpg') no-repeat center; background-size: cover; filter: blur(2px);"></div>
    
    <div class="col-lg-12 tm-section-header-container" style="position: relative; z-index: 1;">
        <h2 class="tm-section-header gold-text tm-handwriting-font">
            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo"> Connexion
        </h2>
        <div class="tm-hr-container"><hr class="tm-hr"></div>
    </div>
    
    <div class="col-lg-10 mx-auto margin-top-60" style="position: relative; z-index: 1;">
        <div class="row align-items-center">
            <!-- Formulaire -->
            <div class="col-lg-7 col-md-6 order-2 order-md-1">
                <div class="tm-special-item" style="background-color: white; padding: 50px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-5">
                            <label for="email" class="form-label gold-text" style="font-weight: 600; font-size: 1rem; margin-bottom: 0.75rem;">
                                <i class="bi bi-envelope me-2"></i>Adresse email
                            </label>
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="votre@email.com" required autofocus
                                   style="padding: 1rem 1.25rem; font-size: 1rem;">
                            @error('email')
                                <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="password" class="form-label gold-text" style="font-weight: 600; font-size: 1rem; margin-bottom: 0.75rem;">
                                <i class="bi bi-lock me-2"></i>Mot de passe
                            </label>
                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="••••••••" required
                                   style="padding: 1rem 1.25rem; font-size: 1rem;">
                            @error('password')
                                <div class="invalid-feedback" style="margin-top: 0.5rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" style="width: 1.25rem; height: 1.25rem;">
                                <label class="form-check-label" for="remember" style="font-size: 0.95rem; cursor: pointer;">
                                    Se souvenir de moi
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}" class="gold-text" style="text-decoration: none; font-size: 0.95rem;">
                                <i class="bi bi-question-circle me-1"></i>Mot de passe oublié ?
                            </a>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="tm-more-button" style="margin: 0 auto; padding: 1rem 2rem; font-size: 1.1rem;">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                            </button>
                        </div>

                        <div class="text-center pt-3" style="border-top: 1px solid #e0e0e0;">
                            <p class="mb-0 gray-text">
                                Pas encore de compte ? 
                                <a href="{{ route('register') }}" class="gold-text" style="text-decoration: none; font-weight: 600;">
                                    <i class="bi bi-person-plus me-1"></i>S'inscrire
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Image décorative -->
            <div class="col-lg-5 col-md-6 order-1 order-md-2 mb-4 mb-md-0">
                <div class="text-center">
                    <div class="inline-block shadow-img" style="position: relative;">
                        <img src="/img/template/popular-3.jpg" alt="Café" class="img-circle img-thumbnail" style="max-width: 100%; height: auto;">
                        <div style="position: absolute; top: -10px; left: -10px; width: 60px; height: 60px; background: url('/img/template/logo.png') no-repeat center; background-size: contain; opacity: 0.3;"></div>
                    </div>
                    <p class="mt-4 gray-text" style="font-style: italic;">
                        Accédez à votre espace personnel
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
