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
            $table->bigInteger('contratoitem_id')->unsigned();
            $table->foreign('contratoitem_id')->references('id')->on('contrato_items');
            $table->integer('quantidade_pedida')->unsigned()->default(0);
            $table->integer('quantidade_aceita')->unsigned()->default(0);
            $table->integer('quantidade_restante')->nullable()->default(0)->unsigned();
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
