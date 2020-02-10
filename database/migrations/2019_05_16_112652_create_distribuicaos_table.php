<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistribuicaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribuicaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('observacao', 1500)->nullable();
            $table->integer('instituicao_id')->unsigned();
            $table->foreign('instituicao_id')->references('id')->on('instituicaos')->onDelete('cascade');
            $table->integer('cardapio_id')->unsigned();
            $table->string('token')->unique();
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
        Schema::dropIfExists('distribuicaos');
    }
}
