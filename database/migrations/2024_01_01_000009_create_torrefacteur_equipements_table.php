<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('torrefacteur_equipements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('torrefacteur_id')->constrained()->onDelete('cascade');
            $table->foreignId('equipement_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['torrefacteur_id', 'equipement_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('torrefacteur_equipements');
    }
};


