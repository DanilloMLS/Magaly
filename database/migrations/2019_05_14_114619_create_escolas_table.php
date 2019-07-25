<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscolasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escolas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('modalidade_ensino');
            $table->string('rota');
            $table->string('periodo_atendimento');
            $table->integer('qtde_alunos');
            $table->string('endereco');
            //$table->bigInteger('estoque_id')->unsigned();
            //$table->foreign('estoque_id')->references('id')->on('estoques');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escolas');
    }
}
