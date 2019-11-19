<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckAndNextDistribuicao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distribuicaos', function (Blueprint $table) {
            $table->boolean('baixada')->default(false);
            $table->bigInteger('proxima')->nullable();
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
            $table->dropColumn('baixada');
            $table->dropColumn('proxima');
        });
    }
}
