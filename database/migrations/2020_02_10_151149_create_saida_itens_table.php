<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaidaItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saida_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('quantidade_aceita');
            $table->unsignedInteger('quantidade_pedida');
            $table->unsignedInteger('quantidade_restante');
            $table->boolean('sem_destino')->default(FALSE);
            $table->unsignedBigInteger('saida_avulsa_id');
            $table->foreign('saida_avulsa_id')->references('id')->on('saida_avulsas');
            $table->unsignedBigInteger('avulso_estoque_id');
            $table->foreign('avulso_estoque_id')->references('id')->on('avulso_estoques');
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
        Schema::dropIfExists('saida_items');
    }
}
