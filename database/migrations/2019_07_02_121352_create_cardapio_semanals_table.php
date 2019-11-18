<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardapioSemanalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql')->create('cardapio_semanals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('semana');
            $table->integer('cardapio_mensal_id')->unsigned();
            $table->foreign('cardapio_mensal_id')->references('id')->on('cardapio_mensals')->onDelete('cascade');
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
        Schema::dropIfExists('cardapio_semanals');
    }
}
