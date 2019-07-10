<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardapioDiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cardapio_diarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('dia_semana');
            $table->integer('cardapio_semanals_id')->unsigned();
            $table->foreign('cardapio_semanals_id')->references('id')->on('cardapio_semanals')->onDelete('cascade');
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
        Schema::dropIfExists('cardapio_diarios');
    }
}
