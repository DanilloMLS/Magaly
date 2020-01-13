<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ordem_fornecimento_id')->unsigned();
            $table->foreign('ordem_fornecimento_id')->references('id')->on('ordem_fornecimentos');
            $table->bigInteger('contrato_id')->unsigned();
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->integer('quantidade')->unsigned();
            $table->integer('quantidade_danificados')->unsigned();
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
        Schema::dropIfExists('ordem_items');
    }
}
