@extends('layouts.app')

@section('title', 'Accueil - Guide 2026 des Torréfacteurs')

@section('content')
<section class="home-hero">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="glass-panel hero-card shadow-lg overflow-hidden position-relative">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-7">
                        <span class="hero-badge text-uppercase">Guide 2026 des Torréfacteurs</span>
                        <h1 class="display-4 fw-bold mb-3">Guide 2026 des Torréfacteurs</h1>
                        <p class="lead hero-quote mb-4">« La Brulerie près de chez moi »</p>
                        <p class="hero-copy mb-4">
                            Bienvenue sur la plateforme du Guide 2026 des Torréfacteurs. 
                            Connectez-vous ou inscrivez-vous pour remplir vos informations.
                        </p>
                        <div class="alert alert-info shadow-sm border-0">
                            <strong>Informations à remplir AVANT le 21 Décembre 2025</strong>
                        </div>
                        <div class="hero-actions d-flex flex-wrap gap-3 mt-4">
                            @auth
                                <a href="{{ route('torrefacteur.form') }}" class="btn btn-primary btn-lg">
                                    Accéder à mon profil
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                    Se connecter
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
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


