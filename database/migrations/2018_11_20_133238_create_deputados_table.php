<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeputadosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('deputados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('siglaPartido');
            $table->string('siglaUf');
            $table->integer('idLegislatura');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('deputados');
    }
}
