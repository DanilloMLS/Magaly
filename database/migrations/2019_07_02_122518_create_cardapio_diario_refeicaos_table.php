<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardapioDiarioRefeicaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cardapio_diario_refeicaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cardapio_diario_id')->unsigned();
            $table->foreign('cardapio_diario_id')->references('id')->on('cardapio_diarios')->onDelete('cascade');
            $table->integer('refeicao_id')->unsigned();
            $table->foreign('refeicao_id')->references('id')->on('refeicaos')->onDelete('cascade');
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
        Schema::dropIfExists('cardapio_diario_refeicaos');
    }
}
