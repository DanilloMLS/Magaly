<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstoqueItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantidade_danificado')->unsigned()->default(0.0);
            $table->integer('quantidade')->unsigned()->default(0.0);
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->integer('estoque_id')->unsigned();
            $table->integer('estoque_id')->references('id')->on('estoques')->onDelete('cascade');
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
        Schema::dropIfExists('estoque_items');
    }
}
