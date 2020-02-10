<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaidaItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saida_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('observacao')->nullable();
            $table->unsignedBigInteger('estoque_id');
            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->unsignedInteger('quantidade');
            $table->unsignedBigInteger('saida_id');
            $table->foreign('saida_id')->references('id')->on('saida_avulsas');
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
        Schema::dropIfExists('saida_items');
    }
}
