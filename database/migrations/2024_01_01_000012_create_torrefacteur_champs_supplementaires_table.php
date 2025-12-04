<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTorrefacteurChampsSupplementairesTable extends Migration
{
    public function up()
    {
        Schema::create('torrefacteur_champs_supplementaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('torrefacteur_id');
            $table->unsignedBigInteger('champ_supplementaire_id');
            $table->text('valeur')->nullable();
            $table->timestamps();
            
            $table->foreign('torrefacteur_id', 'tcs_torrefacteur_fk')
                ->references('id')
                ->on('torrefacteurs')
                ->onDelete('cascade');
            
            $table->foreign('champ_supplementaire_id', 'tcs_champ_supp_fk')
                ->references('id')
                ->on('champs_supplementaires')
                ->onDelete('cascade');
            
            $table->unique(['torrefacteur_id', 'champ_supplementaire_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('torrefacteur_champs_supplementaires');
    }
}


