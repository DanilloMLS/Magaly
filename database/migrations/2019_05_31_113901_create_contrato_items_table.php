<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql')->create('contrato_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantidade');
            $table->decimal('valor_unitario');
            $table->string('n_lote');
            $table->date('data_validade');
            $table->bigInteger('contrato_id')->unsigned();
            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('cascade');
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
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
        Schema::dropIfExists('contrato_items');
    }
}
