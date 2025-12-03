<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Guide 2026 des Torréfacteurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 20px;
        }
        .page-break {
            page-break-after: always;
        }
        .region-header {
            background-color: #f0f0f0;
            padding: 10px;
            margin: 20px 0 10px 0;
            font-size: 14pt;
            font-weight: bold;
        }
        .torrefacteur {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .torrefacteur-header {
            font-weight: bold;
            font-size: 12pt;
            margin-bottom: 5px;
        }
        .torrefacteur-info {
            font-size: 9pt;
            margin: 3px 0;
        }
        .equipements {
            margin-top: 5px;
            font-size: 8pt;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; margin-bottom: 30px;">Guide 2026 des Torréfacteurs</h1>
    <h2 style="text-align: center; margin-bottom: 40px;">« La Brulerie près de chez moi »</h2>

    @foreach($regions as $region)
        <div class="region-header">{{ $region->nom }}</div>
        
        @php
            $regionTorrefacteurs = $torrefacteurs->where('region_id', $region->id);
            $payants = $regionTorrefacteurs->filter(function($t) {
                return $t->offrePartenaire && $t->offrePartenaire->code !== 'G';
            })->sortBy('nom_brulerie');
            $gratuits = $regionTorrefacteurs->filter(function($t) {
                return !$t->offrePartenaire || $t->offrePartenaire->code === 'G';
            })->sortBy('nom_brulerie');
        @endphp

        @foreach($payants as $torrefacteur)
            <div class="torrefacteur">
                <div class="torrefacteur-header">{{ $torrefacteur->nom_brulerie }}</div>
                <div class="torrefacteur-info">{{ $torrefacteur->adresse }}</div>
                <div class="torrefacteur-info">{{ $torrefacteur->telephone }}</div>
                @if($torrefacteur->site_internet)
                    <div class="torrefacteur-info">{{ $torrefacteur->site_internet }}</div>
                @endif
                @if($torrefacteur->texte_descriptif)
                    <div class="torrefacteur-info">{{ $torrefacteur->texte_descriptif }}</div>
                @endif
                @if($torrefacteur->equipements->count() > 0)
                    <div class="equipements">
                        <strong>Équipements :</strong>
                        {{ $torrefacteur->equipements->pluck('nom')->implode(', ') }}
                    </div>
                @endif
            </div>
        @endforeach

        @if($gratuits->count() > 0)
            <div style="margin-top: 20px; font-weight: bold;">Et aussi dans {{ $region->nom }} :</div>
            @foreach($gratuits as $torrefacteur)
                <div class="torrefacteur" style="background-color: #f9f9f9;">
                    <div class="torrefacteur-header">{{ $torrefacteur->nom_brulerie }}</div>
                    <div class="torrefacteur-info">{{ $torrefacteur->adresse }}</div>
                    <div class="torrefacteur-info">{{ $torrefacteur->telephone }}</div>
                </div>
            @endforeach
        @endif

        <div class="page-break"></div>
    @endforeach
</body>
</html>


