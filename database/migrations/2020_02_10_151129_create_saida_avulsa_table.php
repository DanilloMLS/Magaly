<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaidaAvulsaTable extends Migration
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
            $table->string('observacao',1500);
            $table->unsignedBigInteger('origem_id');
            $table->foreign('origem_id')->references('id')->on('estoques');
            $table->unsignedBigInteger('destino_id');
            $table->foreign('destino_id')->references('id')->on('estoques');
            $table->unsignedBigInteger('contrato_id');
            $table->foreign('contrato_id')->references('id')->on('contratos');
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
