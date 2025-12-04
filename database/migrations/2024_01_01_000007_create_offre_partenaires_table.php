<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffrePartenairesTable extends Migration
{
    public function up()
    {
        Schema::create('offre_partenaires', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // G, P1, P2, P3, P4, P5, P6
            $table->string('nom');
            $table->text('description')->nullable();
            $table->decimal('prix', 10, 2);
            $table->integer('nombre_guides')->default(0);
            $table->integer('limite')->nullable(); // null = illimité
            $table->integer('reserve')->default(0); // nombre réservé
            $table->boolean('actif')->default(true);
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('offre_partenaires');
    }
}


