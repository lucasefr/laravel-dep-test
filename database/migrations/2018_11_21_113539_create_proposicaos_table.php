<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposicaosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('proposicaos', function (Blueprint $table) {
            $table->integer('id');
            $table->string('siglaTipo');
            $table->integer('idTipo');
            $table->integer('ano');
            $table->text('ementa');
            $table->date('dataHora');
            $table->integer('idSituacao')->nullable();
            $table->text('nomeDeputado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('proposicaos');
    }
}
