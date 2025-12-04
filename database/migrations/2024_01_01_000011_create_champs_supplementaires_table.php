<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChampsSupplementairesTable extends Migration
{
    public function up()
    {
        Schema::create('champs_supplementaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('type')->default('text'); // text, textarea, file, checkbox, etc.
            $table->boolean('obligatoire')->default(false);
            $table->integer('ordre')->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('champs_supplementaires');
    }
}


