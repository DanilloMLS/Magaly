<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstoqueIdDistribuicaos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distribuicaos', function (Blueprint $table) {
            $table->bigInteger('estoque_id')->unsigned();
            $table->foreign('estoque_id')->references('id')->on('estoques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distribuicaos', function (Blueprint $table) {
            $table->dropForeign('estoque_id');
            $table->dropColumn('estoque_id');
        });
    }
}
