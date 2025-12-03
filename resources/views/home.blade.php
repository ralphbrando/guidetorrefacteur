@extends('layouts.app')

@section('title', 'Accueil - Guide 2026 des Torréfacteurs')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body text-center p-5">
                <h1 class="display-4 mb-4">Guide 2026 des Torréfacteurs</h1>
                <p class="lead mb-4">« La Brulerie près de chez moi »</p>
                <p class="mb-4">
                    Bienvenue sur la plateforme du Guide 2026 des Torréfacteurs. 
                    Connectez-vous ou inscrivez-vous pour remplir vos informations.
                </p>
                <div class="alert alert-info">
                    <strong>Informations à remplir AVANT le 21 Décembre 2025</strong>
                </div>
                <div class="mt-4">
                    @auth
                        <a href="{{ route('torrefacteur.form') }}" class="btn btn-primary btn-lg me-2">
                            Accéder à mon profil
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">
                            Se connecter
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                            S'inscrire
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


