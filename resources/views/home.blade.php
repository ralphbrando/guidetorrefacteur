@extends('layouts.app')

@section('title', 'Accueil - Guide 2026 des Torréfacteurs')

@section('content')
<section class="tm-welcome-section">
    <div class="container tm-position-relative">
        <div class="tm-lights-container">
            <img src="/img/template/light.png" alt="Light" class="light light-1">
            <img src="/img/template/light.png" alt="Light" class="light light-2">
            <img src="/img/template/light.png" alt="Light" class="light light-3">  
        </div>        
        <div class="row tm-welcome-content">
            <h2 class="white-text tm-handwriting-font tm-welcome-header fade-in-down">
                <img src="/img/template/header-line.png" alt="Line" class="tm-header-line">&nbsp;Bienvenue au&nbsp;&nbsp;
                <img src="/img/template/header-line.png" alt="Line" class="tm-header-line">
            </h2>
            <h2 class="gold-text tm-welcome-header-2 fade-in-down">Guide 2026 des Torréfacteurs</h2>
            <p class="gray-text tm-welcome-description fade-in-up" style="font-size: 1.15rem; line-height: 1.8; font-weight: 400;">
                Bienvenue sur la plateforme du <span class="gold-text" style="font-weight: 600;">Guide 2026 des Torréfacteurs</span>. 
                Rejoignez notre communauté de torréfacteurs passionnés et faites découvrir votre brûlerie. 
                Connectez-vous ou inscrivez-vous pour remplir vos informations et apparaître dans notre guide annuel.
            </p>
            <div class="alert alert-warning mt-4 fade-in-up" style="animation-delay: 0.3s; color:white;">
                <strong>⚠️ Informations à remplir AVANT le 21 Décembre 2025</strong>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 mt-4 fade-in-up" style="animation-delay: 0.4s;">
                @auth
                    <a href="{{ route('torrefacteur.form') }}" class="tm-more-button tm-more-button-welcome">Mon Profil</a>
                @else
                    <a href="{{ route('login') }}" class="tm-more-button tm-more-button-welcome">Se Connecter</a>
                    <a href="{{ route('register') }}" class="tm-more-button tm-more-button-welcome">S'Inscrire</a>
                @endauth
            </div>
        </div>
        <img src="/img/template/table-set.png" alt="Table Set" class="tm-table-set img-responsive">             
    </div>      
</section>

<div class="tm-main-section light-gray-bg">
    <div class="container" id="main">
        <section class="tm-section row fade-in-up">
            <div class="col-lg-9 col-md-9 col-sm-8">
                <h2 class="tm-section-header gold-text tm-handwriting-font">Le Meilleur Café pour Vous</h2>
                <h2 class="gold-text" style="font-weight: 700; margin-bottom: 1.5rem;">Guide 2026 des Torréfacteurs</h2>
                <p class="tm-welcome-description" style="font-size: 1.1rem; line-height: 1.8; color: #333; font-weight: 400;">
                    Le <span class="gold-text" style="font-weight: 600;">Guide 2026</span> des Torréfacteurs est votre référence pour découvrir les meilleures brûleries de France. 
                    Rejoignez notre communauté et faites connaître votre passion pour le café. 
                    Inscrivez-vous dès maintenant pour apparaître dans notre guide annuel et toucher un public de passionnés de café.
                </p>
                <a href="#features" class="tm-more-button margin-top-30">En Savoir Plus</a> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 tm-welcome-img-container fade-in-up" style="animation-delay: 0.2s;">
                <div class="inline-block shadow-img">
                    <img src="/img/template/1.jpg" alt="Image" class="img-circle img-thumbnail">  
                </div>              
            </div>            
        </section>          
        
        <section class="tm-section tm-section-margin-bottom-0 row fade-in-up" id="features" style="animation-delay: 0.3s;">
            <div class="col-lg-12 tm-section-header-container">
                <h2 class="tm-section-header gold-text tm-handwriting-font">
                    <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo"> Pourquoi Nous Rejoindre
                </h2>
                <div class="tm-hr-container"><hr class="tm-hr"></div>
            </div>
            <div class="col-lg-12 tm-popular-items-container">
                <div class="tm-popular-item">
                    <img src="/img/template/popular-1.jpg" alt="Popular" class="tm-popular-item-img">
                    <div class="tm-popular-item-description">
                        <h3 class="tm-handwriting-font tm-popular-item-title">
                            <span class="tm-handwriting-font bigger-first-letter">V</span>isibilité
                        </h3>
                        <hr class="tm-popular-item-hr">
                        <p>Apparaissez dans notre guide annuel et touchez un large public de passionnés de café à travers toute la France.</p>
                        <div class="order-now-container">
                            <a href="{{ route('register') }}" class="order-now-link tm-handwriting-font">Inscription</a>
                        </div>
                    </div>              
                </div>
                <div class="tm-popular-item">
                    <img src="/img/template/popular-2.jpg" alt="Popular" class="tm-popular-item-img">
                    <div class="tm-popular-item-description">
                        <h3 class="tm-handwriting-font tm-popular-item-title">
                            <span class="tm-handwriting-font bigger-first-letter">C</span>ommunauté
                        </h3>
                        <hr class="tm-popular-item-hr">
                        <p>Rejoignez une communauté de torréfacteurs passionnés et partagez votre savoir-faire avec d'autres professionnels.</p>
                        <div class="order-now-container">
                            <a href="{{ route('register') }}" class="order-now-link tm-handwriting-font">Rejoindre</a>
                        </div>
                    </div>              
                </div>
                <div class="tm-popular-item">
                    <img src="/img/template/popular-3.jpg" alt="Popular" class="tm-popular-item-img">
                    <div class="tm-popular-item-description">
                        <h3 class="tm-handwriting-font tm-popular-item-title">
                            <span class="tm-handwriting-font bigger-first-letter">P</span>romotion
                        </h3>
                        <hr class="tm-popular-item-hr">
                        <p>Mettez en avant votre brûlerie avec des photos, descriptions et informations détaillées pour attirer de nouveaux clients.</p>
                        <div class="order-now-container">
                            <a href="{{ route('register') }}" class="order-now-link tm-handwriting-font">Découvrir</a>
                        </div>
                    </div>              
                </div>
            </div>          
        </section>
        
        <section class="tm-section row fade-in-up" style="animation-delay: 0.4s;">
            <div class="col-lg-12 tm-section-header-container">
                <h2 class="tm-section-header gold-text tm-handwriting-font">
                    <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo"> Comment ça Marche
                </h2>
                <div class="tm-hr-container"><hr class="tm-hr"></div>
            </div>          
            <div class="col-lg-12 tm-special-container margin-top-60">
                <div class="tm-special-container-left">
                    <div class="tm-special-item">
                        <div class="tm-special-img-container">
                            <img src="/img/template/special-1.jpg" alt="Special" class="tm-special-img img-responsive">  
                            <a href="{{ route('register') }}">
                                <div class="tm-special-description">
                                    <h3 class="tm-special-title">1. Inscription</h3>
                                    <p>Créez votre compte en quelques clics</p>  
                                </div>            
                            </a>
                        </div>
                    </div>
                </div>
                <div class="tm-special-container-right">
                    <div>
                        <div class="tm-special-item">
                            <div class="tm-special-img-container">
                                <img src="/img/template/special-2.jpg" alt="Special" class="img-responsive">  
                                <a href="{{ route('torrefacteur.form') }}">
                                    <div class="tm-special-description">
                                        <h3 class="tm-special-title">2. Remplissez vos informations</h3>
                                        <p>Ajoutez les détails de votre brûlerie</p>
                                    </div>
                                </a>
                            </div>
                        </div>  
                    </div>
                    <div class="tm-special-container-lower">
                        <div class="tm-special-item">
                            <div class="tm-special-img-container">
                                <img src="/img/template/special-3.jpg" alt="Special" class="img-responsive">  
                                <a href="{{ route('payment.index') }}">
                                    <div class="tm-special-description">
                                        <p>3. Choisissez votre offre</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="tm-special-item">
                            <div class="tm-special-img-container">
                                <img src="/img/template/special-4.jpg" alt="Special" class="img-responsive">  
                                <a href="#">
                                    <div class="tm-special-description">
                                        <p>4. Apparaissez dans le guide</p>
                                    </div>
                                </a>
                            </div>
                        </div>  
                    </div>              
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
