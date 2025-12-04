<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailCampagnesTable extends Migration
{
    public function up()
    {
        Schema::create('email_campagnes', function (Blueprint $table) {
            $table->id();
            $table->string('sujet');
            $table->text('contenu');
            $table->integer('envoyes')->default(0);
            $table->integer('total')->default(0);
            $table->enum('statut', ['brouillon', 'en_cours', 'termine', 'erreur'])->default('brouillon');
            $table->timestamp('date_envoi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_campagnes');
    }
}


