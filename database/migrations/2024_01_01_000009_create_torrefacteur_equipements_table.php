<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTorrefacteurEquipementsTable extends Migration
{
    public function up()
    {
        Schema::create('torrefacteur_equipements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('torrefacteur_id');
            $table->unsignedBigInteger('equipement_id');
            $table->timestamps();
            
            $table->foreign('torrefacteur_id', 'te_torrefacteur_fk')
                ->references('id')
                ->on('torrefacteurs')
                ->onDelete('cascade');
            
            $table->foreign('equipement_id', 'te_equipement_fk')
                ->references('id')
                ->on('equipements')
                ->onDelete('cascade');
            
            $table->unique(['torrefacteur_id', 'equipement_id'], 'te_torref_equip_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('torrefacteur_equipements');
    }
}


