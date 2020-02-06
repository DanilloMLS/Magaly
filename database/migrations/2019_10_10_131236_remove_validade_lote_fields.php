<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveValidadeLoteFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contrato_items', function (Blueprint $table) {
            $table->dropColumn('data_validade');
            $table->dropColumn('n_lote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* Schema::table('contrato_items', function (Blueprint $table) {
            $table->string('n_lote');
            $table->date('data_validade');
        }); */
    }
}
