<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaidaAvulsasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saida_avulsas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('observacao',1500)->nullable();
            $table->unsignedBigInteger('origem');
            $table->foreign('origem')->references('estoque_id')->on('estoques');
            $table->unsignedBigInteger('destino')->nullable();
            $table->foreign('destino')->references('estoque_id')->on('estoques');
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
        Schema::dropIfExists('saida_avulsas');
    }
}
