@extends('layouts.app')

@section('title', 'Prévisualisation du Guide')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Prévisualisation du Guide 2026</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="{{ route('pdf.generate', ['type' => 'preview']) }}" class="btn btn-primary" target="_blank">
                        <i class="bi bi-file-pdf"></i> Prévisualiser en PDF
                    </a>
                    <a href="{{ route('pdf.generate', ['type' => 'print']) }}" class="btn btn-success">
                        <i class="bi bi-download"></i> Télécharger PDF pour impression
                    </a>
                    <a href="{{ route('pdf.illustrator') }}" class="btn btn-warning">
                        <i class="bi bi-file-earmark-image"></i> Télécharger pour Illustrator
                    </a>
                </div>

                <div class="alert alert-info">
                    <strong>Statistiques :</strong>
                    <ul class="mb-0">
                        <li>Total de torréfacteurs validés : {{ $torrefacteurs->count() }}</li>
                        <li>Nombre de régions : {{ $regions->count() }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


