<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('torrefacteur_champs_supplementaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('torrefacteur_id')->constrained()->onDelete('cascade');
            $table->foreignId('champ_supplementaire_id')->constrained('champs_supplementaires')->onDelete('cascade');
            $table->text('valeur')->nullable();
            $table->timestamps();
            
            $table->unique(['torrefacteur_id', 'champ_supplementaire_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('torrefacteur_champs_supplementaires');
    }
};


