<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemavulsoContratoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avulso_contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('marca');
            $table->string('descricao',1500);
            $table->unsignedBigInteger('contrato_id');
            $table->foreing('contrato_id')->references('id')->on('contratos');
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
        Schema::dropIfExists('avulso_contrato');
    }
}
