@extends('layouts.app')

@section('title', 'Accueil - Guide 2026 des Torréfacteurs')

@section('content')
<section class="home-hero fade-in-up">
    <div class="row justify-content-center">
        <div class="col-xl-11">
            <div class="glass-panel hero-card shadow-lg overflow-hidden position-relative">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-7 position-relative">
                        <span class="hero-badge text-uppercase">
                            <i class="bi bi-star-fill me-2"></i>
                            Guide 2026 des Torréfacteurs
                        </span>
                        <h1 class="display-4 fw-bold mb-4">Guide 2026 des Torréfacteurs</h1>
                        <p class="lead hero-quote mb-4">« La Brulerie près de chez moi »</p>
                        <p class="hero-copy mb-4">
                            Bienvenue sur la plateforme du Guide 2026 des Torréfacteurs. 
                            Connectez-vous ou inscrivez-vous pour remplir vos informations et rejoindre notre communauté de torréfacteurs passionnés.
                        </p>
                        <div class="alert alert-info shadow-sm border-0 mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-calendar-check fs-5"></i>
                                <div>
                                    <strong>Informations à remplir AVANT le 21 Décembre 2025</strong>
                                </div>
                            </div>
                        </div>
                        <div class="hero-actions d-flex flex-wrap gap-3">
                            @auth
                                <a href="{{ route('torrefacteur.form') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-person-circle me-2"></i>
                                    Accéder à mon profil
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Se connecter
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                                    <i class="bi bi-person-plus me-2"></i>
                                    S'inscrire
                                </a>
                            @endauth
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block">
                        <div class="hero-visual" aria-hidden="true">
                            <div class="hero-visual-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


