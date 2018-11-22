<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeputadoProposicaoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('deputado_proposicao', function (Blueprint $table) {
            $table->integer('deputado_id')->unsigned();
            $table->integer('proposicao_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('deputado_proposicao');
    }
}
