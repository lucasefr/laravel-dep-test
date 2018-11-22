<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Schema::table('deputado_proposicao', function (Blueprint $table) {
        //     $table->foreign('deputado_id')->references('id')->on('deputados');
        //     $table->foreign('proposicao_id')->references('id')->on('proposicaos');
        // });

        // Schema::table('despesas', function (Blueprint $table) {
        //     $table->foreign('deputado_id')->references('id')->on('deputados');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('relationships');
    }
}
