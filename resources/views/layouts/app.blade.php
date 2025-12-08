<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Guide 2026 des Torréfacteurs')</title>
    
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Template CSS -->
    <link href="{{ asset('css/template/templatemo-style.css') }}" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    <!-- Preloader -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Preloader -->
    
    <div class="tm-top-header">
        <div class="container">
            <div class="row">
                <div class="tm-top-header-inner">
                    <div class="tm-logo-container">
                        <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none">
                            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo">
                            <h1 class="tm-site-name tm-handwriting-font">Guide 2026</h1>
                        </a>
                    </div>
                    <div class="mobile-menu-icon">
                        <i class="fa fa-bars"></i>
                    </div>
                    <nav class="tm-nav">
                        <ul>
                            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a></li>
                            @auth
                                <li><a href="{{ route('torrefacteur.form') }}" class="{{ request()->routeIs('torrefacteur.*') ? 'active' : '' }}">Mon Profil</a></li>
                                <li><a href="{{ route('payment.index') }}" class="{{ request()->routeIs('payment.*') ? 'active' : '' }}">Paiement</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-white p-0" style="background: none; border: none; padding: 15px 15px 20px 30px !important; font-weight: 700; text-transform: uppercase; transition: all 0.3s ease;">Déconnexion</button>
                                    </form>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Connexion</a></li>
                                <li><a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Inscription</a></li>
                            @endauth
                        </ul>
                    </nav>   
                </div>           
            </div>    
        </div>
    </div>

    <main class="tm-main-section light-gray-bg">
        <div class="container" id="main">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer>
        <div class="tm-black-bg">
            <div class="container">
                <div class="row margin-bottom-60">
                    <nav class="col-lg-3 col-md-3 tm-footer-nav tm-footer-div">
                        <h3 class="tm-footer-div-title">Menu Principal</h3>
                        <ul>
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            @auth
                                <li><a href="{{ route('torrefacteur.form') }}">Mon Profil</a></li>
                                <li><a href="{{ route('payment.index') }}">Paiement</a></li>
                            @else
                                <li><a href="{{ route('login') }}">Connexion</a></li>
                                <li><a href="{{ route('register') }}">Inscription</a></li>
                            @endauth
                        </ul>
                    </nav>
                    <div class="col-lg-5 col-md-5 tm-footer-div">
                        <h3 class="tm-footer-div-title">À Propos</h3>
                        <p class="margin-top-15">Bienvenue sur la plateforme du Guide 2026 des Torréfacteurs. Rejoignez notre communauté de torréfacteurs passionnés et faites découvrir votre brûlerie.</p>
                        <p class="margin-top-15">Connectez-vous ou inscrivez-vous pour remplir vos informations et apparaître dans notre guide annuel.</p>
                    </div>
                    <div class="col-lg-4 col-md-4 tm-footer-div">
                        <h3 class="tm-footer-div-title">Contact</h3>
                        <p class="margin-top-15">Pour toute question, n'hésitez pas à nous contacter.</p>
                        <div class="alert alert-info mt-3">
                            <strong>Informations à remplir AVANT le 21 Décembre 2025</strong>
                        </div>
                    </div>
                </div>          
            </div>  
        </div>      
        <div>
            <div class="container">
                <div class="row tm-copyright">
                    <p class="col-lg-12 small copyright-text text-center">Copyright &copy; {{ date('Y') }} Guide 2026 des Torréfacteurs. Tous droits réservés.</p>
                </div>  
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preloader
        $(window).on('load', function() {
            $('body').addClass('loaded');
        });
        
        // Mobile menu
        $('.mobile-menu-icon').click(function(){
            $('.tm-nav').slideToggle();
        });

        $(window).resize(function() {
            if($(window).width() > 767) {
                $('.tm-nav').show();
            } else {
                $('.tm-nav').hide();
            }
        });

        // Smooth scroll
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
