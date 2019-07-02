<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardapioMensalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cardapio_mensals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data_inicio');
            $table->date('data_fim')->unsigned();
            $table->string('modalidade_ensino');
            $table->string('nome');
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
        Schema::dropIfExists('cardapio_mensals');
    }
}
