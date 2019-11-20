<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRefeicao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
 {
   Schema::table('refeicaos', function (Blueprint $table) {
       $table->decimal('quantidade_total');
   });
 }
 /**
  * Reverse the migrations.
  *
  * @return void
  */
 public function down()
 {
    Schema::table('refeicaos', function (Blueprint $table) {
        $table->dropColumn('quantidade_total');
    });
 }
}
