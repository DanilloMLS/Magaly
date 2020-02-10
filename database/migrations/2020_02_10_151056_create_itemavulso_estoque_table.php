<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemavulsoEstoqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemavulso_estoques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('quantidade');
            $table->unsignedBigInteger('estoque_id');
            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->unsignedBigInteger('avulso_contrato_id');
            $table->foreign('avulso_contrato_id')->references('id')->on('itemavulso_contratos');
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
        Schema::dropIfExists('avulso_estoques');
    }
}
