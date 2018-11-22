<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDespesasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('deputado_id')->unsigned();
            $table->integer('ano');
            $table->string('mes');
            $table->string('tipoDespesa');
            $table->date('dataDocumento')->nullable();
            $table->double('valorDocumento');
            $table->integer('idDocumento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('despesas');
    }
}
