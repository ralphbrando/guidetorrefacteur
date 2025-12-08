@extends('layouts.app')

@section('title', 'Mentions Légales')

@section('content')
<section class="tm-section row">
    <div class="col-lg-12 tm-section-header-container">
        <h2 class="tm-section-header gold-text tm-handwriting-font">
            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo"> Mentions Légales
        </h2>
        <div class="tm-hr-container"><hr class="tm-hr"></div>
    </div>
    
    <div class="col-lg-10 mx-auto margin-top-60">
        <div class="tm-special-item" style="background-color: white; padding: 50px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
            
            <div class="mb-5">
                <h3 class="gold-text mb-3" style="font-weight: 700; border-bottom: 2px solid #c79c60; padding-bottom: 10px;">
                    <i class="bi bi-building me-2"></i>1. Informations légales
                </h3>
                <p class="mb-3">
                    <strong>Dénomination sociale :</strong> Guide 2026 des Torréfacteurs<br>
                    <strong>Forme juridique :</strong> [À compléter]<br>
                    <strong>Siège social :</strong> [À compléter]<br>
                    <strong>SIRET :</strong> [À compléter]<br>
                    <strong>Numéro TVA intracommunautaire :</strong> [À compléter]
                </p>
                <p class="mb-3">
                    <strong>Directeur de publication :</strong> [À compléter]<br>
                    <strong>Hébergeur :</strong> [À compléter]
                </p>
            </div>

            <div class="mb-5">
                <h3 class="gold-text mb-3" style="font-weight: 700; border-bottom: 2px solid #c79c60; padding-bottom: 10px;">
                    <i class="bi bi-shield-check me-2"></i>2. Protection des données personnelles
                </h3>
                <p class="mb-3">
                    Conformément à la loi « Informatique et Libertés » du 6 janvier 1978 modifiée et au Règlement Général sur la Protection des Données (RGPD), vous disposez d'un droit d'accès, de rectification, de suppression et d'opposition aux données personnelles vous concernant.
                </p>
                <p class="mb-3">
                    Les données collectées sur ce site sont destinées à la gestion de votre inscription et de votre participation au Guide 2026 des Torréfacteurs. Elles sont conservées pour la durée nécessaire aux finalités pour lesquelles elles ont été collectées.
                </p>
                <p class="mb-3">
                    Pour exercer vos droits, vous pouvez nous contacter à l'adresse suivante : <a href="mailto:contact@guide-torrefacteurs.fr" class="gold-text">contact@guide-torrefacteurs.fr</a>
                </p>
            </div>

            <div class="mb-5">
                <h3 class="gold-text mb-3" style="font-weight: 700; border-bottom: 2px solid #c79c60; padding-bottom: 10px;">
                    <i class="bi bi-cookie me-2"></i>3. Cookies
                </h3>
                <p class="mb-3">
                    Ce site utilise des cookies pour améliorer votre expérience de navigation. Les cookies sont de petits fichiers texte stockés sur votre appareil lorsque vous visitez un site web.
                </p>
                <p class="mb-3">
                    Vous pouvez configurer votre navigateur pour refuser les cookies, mais cela peut affecter certaines fonctionnalités du site.
                </p>
            </div>

            <div class="mb-5">
                <h3 class="gold-text mb-3" style="font-weight: 700; border-bottom: 2px solid #c79c60; padding-bottom: 10px;">
                    <i class="bi bi-copyright me-2"></i>4. Propriété intellectuelle
                </h3>
                <p class="mb-3">
                    L'ensemble du contenu de ce site (textes, images, logos, graphismes, etc.) est la propriété exclusive de Guide 2026 des Torréfacteurs, sauf mention contraire.
                </p>
                <p class="mb-3">
                    Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite sans autorisation écrite préalable.
                </p>
            </div>

            <div class="mb-5">
                <h3 class="gold-text mb-3" style="font-weight: 700; border-bottom: 2px solid #c79c60; padding-bottom: 10px;">
                    <i class="bi bi-exclamation-triangle me-2"></i>5. Responsabilité
                </h3>
                <p class="mb-3">
                    Guide 2026 des Torréfacteurs s'efforce de fournir sur le site des informations aussi précises que possible. Toutefois, il ne pourra être tenu responsable des omissions, des inexactitudes et des carences dans la mise à jour, qu'elles soient de son fait ou du fait des tiers partenaires qui lui fournissent ces informations.
                </p>
                <p class="mb-3">
                    Tous les informations indiquées sur le site sont données à titre indicatif, et sont susceptibles d'évoluer. Par ailleurs, les renseignements figurant sur le site ne sont pas exhaustifs.
                </p>
            </div>

            <div class="mb-5">
                <h3 class="gold-text mb-3" style="font-weight: 700; border-bottom: 2px solid #c79c60; padding-bottom: 10px;">
                    <i class="bi bi-link-45deg me-2"></i>6. Liens hypertextes
                </h3>
                <p class="mb-3">
                    Le site peut contenir des liens hypertextes vers d'autres sites présents sur le réseau Internet. Les liens vers ces autres ressources vous font quitter le site Guide 2026 des Torréfacteurs.
                </p>
                <p class="mb-3">
                    Il est possible de créer un lien vers la page de présentation de ce site sans autorisation expresse de l'éditeur. Aucune autorisation ni demande d'information préalable ne peut être exigée par l'éditeur à l'égard d'un site qui souhaite établir un lien vers le site de l'éditeur.
                </p>
            </div>

            <div class="mb-5">
                <h3 class="gold-text mb-3" style="font-weight: 700; border-bottom: 2px solid #c79c60; padding-bottom: 10px;">
                    <i class="bi bi-credit-card me-2"></i>7. Paiements
                </h3>
                <p class="mb-3">
                    Les paiements sont sécurisés et traités par nos partenaires de confiance (Stripe, PayPal). Aucune information bancaire n'est stockée sur nos serveurs.
                </p>
                <p class="mb-3">
                    En cas de problème de paiement, vous pouvez nous contacter à l'adresse : <a href="mailto:contact@guide-torrefacteurs.fr" class="gold-text">contact@guide-torrefacteurs.fr</a>
                </p>
            </div>

            <div class="mb-5">
                <h3 class="gold-text mb-3" style="font-weight: 700; border-bottom: 2px solid #c79c60; padding-bottom: 10px;">
                    <i class="bi bi-envelope me-2"></i>8. Contact
                </h3>
                <p class="mb-3">
                    Pour toute question concernant ces mentions légales, vous pouvez nous contacter :
                </p>
                <p class="mb-3">
                    <strong>Email :</strong> <a href="mailto:contact@guide-torrefacteurs.fr" class="gold-text">contact@guide-torrefacteurs.fr</a><br>
                    <strong>Téléphone :</strong> [À compléter]<br>
                    <strong>Adresse :</strong> [À compléter]
                </p>
            </div>

            <div class="mb-0">
                <h3 class="gold-text mb-3" style="font-weight: 700; border-bottom: 2px solid #c79c60; padding-bottom: 10px;">
                    <i class="bi bi-calendar me-2"></i>9. Droit applicable
                </h3>
                <p class="mb-3">
                    Les présentes mentions légales sont régies par le droit français. En cas de litige et à défaut d'accord amiable, le litige sera porté devant les tribunaux français conformément aux règles de compétence en vigueur.
                </p>
                <p class="mb-0">
                    <strong>Dernière mise à jour :</strong> {{ date('d/m/Y') }}
                </p>
            </div>

            <div class="text-center mt-5 pt-4" style="border-top: 2px solid #c79c60;">
                <a href="{{ route('home') }}" class="tm-more-button" style="display: inline-flex;">
                    <i class="bi bi-arrow-left me-2"></i>Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

