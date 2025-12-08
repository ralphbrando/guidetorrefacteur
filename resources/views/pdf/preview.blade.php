@extends('layouts.app')

@section('title', 'Prévisualisation du Guide')

@section('content')
<section class="tm-section row">
    <div class="col-lg-12 tm-section-header-container">
        <h2 class="tm-section-header gold-text tm-handwriting-font" style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: nowrap; white-space: nowrap;">
            <img src="/img/template/logo.png" alt="Logo" class="tm-site-logo" style="flex-shrink: 0;"> 
            <span>Prévisualisation du Guide 2026</span>
        </h2>
        <div class="tm-hr-container"><hr class="tm-hr"></div>
    </div>
    
    <div class="col-12">
        <div class="tm-special-item" style="background-color: white; padding: 3rem; border-radius: 16px;">
            <!-- Statistiques -->
            <div class="alert mb-5" style="background: linear-gradient(135deg, rgba(199, 156, 96, 0.1), rgba(199, 156, 96, 0.05)); border: 2px solid rgba(199, 156, 96, 0.3); border-left: 5px solid #c79c60; border-radius: 16px; padding: 2rem;">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: rgba(199, 156, 96, 0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="bi bi-bar-chart fs-3 gold-text"></i>
                    </div>
                    <div style="flex: 1;">
                        <h4 class="gold-text mb-4" style="font-weight: 700; font-size: 1.5rem;">
                            <i class="bi bi-info-circle me-2"></i>Statistiques du Guide
                        </h4>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div style="padding: 1.5rem; background: rgba(199, 156, 96, 0.1); border-radius: 12px; border: 2px solid rgba(199, 156, 96, 0.2); text-align: center;">
                                    <div style="font-size: 3rem; font-weight: 700; color: #c79c60; margin-bottom: 0.5rem;">
                                        {{ $torrefacteurs->count() }}
                                    </div>
                                    <div style="font-size: 1.1rem; color: #333; font-weight: 600;">
                                        <i class="bi bi-cup-hot me-2 gold-text"></i>Torréfacteurs validés
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="padding: 1.5rem; background: rgba(199, 156, 96, 0.1); border-radius: 12px; border: 2px solid rgba(199, 156, 96, 0.2); text-align: center;">
                                    <div style="font-size: 3rem; font-weight: 700; color: #c79c60; margin-bottom: 0.5rem;">
                                        {{ $regions->count() }}
                                    </div>
                                    <div style="font-size: 1.1rem; color: #333; font-weight: 600;">
                                        <i class="bi bi-geo-alt me-2 gold-text"></i>Régions
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions PDF -->
            <div class="mb-5">
                <h5 class="gold-text mb-4" style="font-weight: 700; font-size: 1.3rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="bi bi-file-earmark-pdf"></i>
                    <span>Actions disponibles</span>
                </h5>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100" style="border: 2px solid #e0e0e0; border-radius: 16px; transition: all 0.3s ease; background: #fff; cursor: pointer; padding: 5px;" 
                             onmouseover="this.style.borderColor='#c79c60'; this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(199, 156, 96, 0.2)';" 
                             onmouseout="this.style.borderColor='#e0e0e0'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            <div class="card-body p-4 text-center" style="display: flex; flex-direction: column; justify-content: space-between; min-height: 200px; padding: 1rem;">
                                <div>
                                    <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(199, 156, 96, 0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                                        <i class="bi bi-eye fs-2 gold-text"></i>
                                    </div>
                                    <h6 class="gold-text mb-3" style="font-weight: 700; font-size: 1.1rem;">Prévisualiser</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                                        Visualisez le guide directement dans votre navigateur
                                    </p>
                                </div>
                                <a href="{{ route('pdf.generate', ['type' => 'preview']) }}" class="tm-more-button btn w-100 mt-3" target="_blank" style="padding: 0.875rem 2rem; font-weight: 600; border: none; display: inline-flex; align-items: center; justify-content: center; margin-top: auto; align-self: center;">
                                    <i class="bi bi-file-pdf me-2"></i>Ouvrir le PDF
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card h-100" style="border: 2px solid #e0e0e0; border-radius: 16px; transition: all 0.3s ease; background: #fff; cursor: pointer; padding: 5px;" 
                             onmouseover="this.style.borderColor='#c79c60'; this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(199, 156, 96, 0.2)';" 
                             onmouseout="this.style.borderColor='#e0e0e0'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            <div class="card-body p-4 text-center" style="display: flex; flex-direction: column; justify-content: space-between; min-height: 200px; padding: 1rem;">
                                <div>
                                    <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(199, 156, 96, 0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                                        <i class="bi bi-printer fs-2 gold-text"></i>
                                    </div>
                                    <h6 class="gold-text mb-3" style="font-weight: 700; font-size: 1.1rem;">Impression</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                                        Téléchargez le PDF haute résolution pour l'impression
                                    </p>
                                </div>
                                <a href="{{ route('pdf.generate', ['type' => 'print']) }}" class="tm-more-button btn w-100 mt-3" style="padding: 0.875rem 2rem; font-weight: 600; border: none; display: inline-flex; align-items: center; justify-content: center; margin-top: auto; align-self: center;">
                                    <i class="bi bi-download me-2"></i>Télécharger
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card h-100" style="border: 2px solid #e0e0e0; border-radius: 16px; transition: all 0.3s ease; background: #fff; cursor: pointer; padding: 5px;" 
                             onmouseover="this.style.borderColor='#c79c60'; this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(199, 156, 96, 0.2)';" 
                             onmouseout="this.style.borderColor='#e0e0e0'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            <div class="card-body p-4 text-center" style="display: flex; flex-direction: column; justify-content: space-between; min-height: 200px; padding: 1rem;">
                                <div>
                                    <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(199, 156, 96, 0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                                        <i class="bi bi-palette fs-2 gold-text"></i>
                                    </div>
                                    <h6 class="gold-text mb-3" style="font-weight: 700; font-size: 1.1rem;">Illustrator</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                                        Téléchargez le PDF pour édition dans Adobe Illustrator
                                    </p>
                                </div>
                                <a href="{{ route('pdf.illustrator') }}" class="tm-more-button btn w-100 mt-3" style="padding: 0.875rem 2rem; font-weight: 600; border: none; display: inline-flex; align-items: center; justify-content: center; margin-top: auto; align-self: center;">
                                    <i class="bi bi-file-earmark-image me-2"></i>Télécharger
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information -->
            <div class="alert" style="background: rgba(199, 156, 96, 0.05); border: 1px solid rgba(199, 156, 96, 0.2); border-radius: 12px; padding: 1.5rem;">
                <div class="d-flex align-items-start gap-3">
                    <i class="bi bi-info-circle gold-text" style="font-size: 1.5rem; margin-top: 0.125rem;"></i>
                    <div>
                        <h6 class="gold-text mb-2" style="font-weight: 700; font-size: 1.1rem;">À propos du Guide</h6>
                        <p class="mb-0" style="color: #555; line-height: 1.7; font-size: 0.95rem;">
                            Le Guide 2026 des Torréfacteurs contient toutes les informations des torréfacteurs validés, organisées par région. 
                            Vous pouvez prévisualiser le guide, le télécharger pour impression, ou obtenir une version haute résolution pour édition.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


