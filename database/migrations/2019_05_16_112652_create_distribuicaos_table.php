<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistribuicaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribuicaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('observacao')->nullable();
            $table->integer('escola_id')->unsigned();
            $table->foreign('escola_id')->references('id')->on('escolas')->onDelete('cascade');
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
        Schema::dropIfExists('distribuicaos');
    }
}
