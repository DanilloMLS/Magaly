<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistribuicaoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribuicao_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->integer('distribuicao_id')->unsigned();
            $table->foreign('distribuicao_id')->references('id')->on('distribuicaos')->onDelete('cascade');
            $table->integer('quantidade_danificados')->unsigned()->nullable();
            $table->integer('quantidade_falta')->unsigned()->nullable();
            $table->integer('quantidade')->unsigned();
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
        Schema::dropIfExists('distribuicao_items');
    }
}
