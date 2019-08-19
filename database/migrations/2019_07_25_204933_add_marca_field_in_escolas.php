<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMarcaFieldInEscolas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escolas', function (Blueprint $table) {
            $table->bigInteger('estoque_id')->unsigned();
            $table->foreign('estoque_id')->references('id')->on('estoques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escolas', function (Blueprint $table) {
            $table->dropForeign('estoque_id');
            $table->dropColumn('estoque_id');
        });
    }
}
