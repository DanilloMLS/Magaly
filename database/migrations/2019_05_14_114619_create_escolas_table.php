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
            $table->string('rota')->nullable();
            $table->string('periodo_atendimento')->nullable();
            $table->integer('qtde_alunos');
            $table->string('endereco')->nullable();
            $table->string('gestor');
            $table->string('telefone');
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
