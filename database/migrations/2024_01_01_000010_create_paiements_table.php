<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('torrefacteur_id')->constrained()->onDelete('cascade');
            $table->foreignId('offre_partenaire_id')->constrained('offre_partenaires')->onDelete('cascade');
            $table->string('numero_facture')->unique();
            $table->string('nom_societe');
            $table->decimal('montant', 10, 2);
            $table->enum('methode', ['carte', 'paypal', 'virement'])->nullable();
            $table->enum('statut', ['en_attente', 'paye', 'annule', 'rembourse'])->default('en_attente');
            $table->string('transaction_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('date_paiement')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paiements');
    }
}


