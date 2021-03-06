<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemFornecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_fornecimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contrato_id')->unsigned();
            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('cascade');
            $table->bigInteger('estoque_id')->unsigned();
            $table->foreign('estoque_id')->references('id')->on('estoques')->onDelete('cascade');
            $table->string('observacao')->nullable();
            $table->boolean('ehcompleta')->default(false);
            $table->date('data');
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
        Schema::dropIfExists('ordem_fornecimentos');
    }
}
