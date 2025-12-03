<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('torrefacteurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
            $table->foreignId('departement_id')->constrained()->onDelete('cascade');
            $table->foreignId('offre_partenaire_id')->nullable()->constrained('offre_partenaires')->onDelete('set null');
            
            // Informations obligatoires
            $table->string('nom_brulerie');
            $table->string('prenom_nom_representant');
            $table->text('adresse');
            $table->string('telephone');
            $table->string('email');
            
            // Informations optionnelles
            $table->string('logo')->nullable();
            $table->text('texte_descriptif')->nullable();
            $table->string('site_internet')->nullable();
            $table->string('photo')->nullable();
            
            // Statut
            $table->enum('statut', ['brouillon', 'en_attente', 'valide', 'refuse'])->default('brouillon');
            $table->boolean('valide')->default(false);
            $table->timestamp('date_validation')->nullable();
            
            // Champs supplémentaires préremplis
            $table->string('machine_torrefier')->nullable();
            $table->string('capacite_machine')->nullable();
            $table->boolean('ateliers_decouvertes')->default(false);
            $table->boolean('degustations')->default(false);
            $table->string('labels')->nullable();
            $table->boolean('arabica')->default(false);
            $table->boolean('robusta')->default(false);
            $table->boolean('geisha')->default(false);
            $table->boolean('thes')->default(false);
            $table->boolean('cacao')->default(false);
            $table->boolean('accessoires_cafe_domestique')->default(false);
            $table->boolean('machines_domestiques')->default(false);
            $table->boolean('accessoires_thes')->default(false);
            $table->boolean('espace_professionnels')->default(false);
            $table->boolean('cascara')->default(false);
            $table->boolean('formations_sca')->default(false);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('torrefacteurs');
    }
};


