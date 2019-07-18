<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data');
            $table->decimal('valor_total')->nullable();
            $table->string('n_contrato');
            $table->string('n_processo_licitatorio');
            $table->string('descricao')->nullable();
            $table->integer('fornecedor_id')->unsigned();
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors')->onDelete('cascade');
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
        Schema::dropIfExists('contratos');
    }
}
