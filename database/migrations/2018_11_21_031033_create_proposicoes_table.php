<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposicoesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('proposicoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('deputado_id');
            $table->string('siglaTipo');
            $table->integer('idTipo');
            $table->integer('ano');
            $table->string('ementa')->nullable();
            $table->date('dataHora');
            $table->integer('idSituacao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('proposicoes');
    }
}
