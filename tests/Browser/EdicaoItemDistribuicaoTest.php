<?php

namespace Tests\Browser;

use App\Distribuicao;
use App\Distribuicao_item;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EdicaoItemDistribuicaoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testVisualizarItens()
    {
        $this->browse(function (Browser $browser) {
            $distribuicoes = Distribuicao::all();
            $distribuicao = Distribuicao::find(random_int(1, count($distribuicoes)));
            $browser->loginAs(User::find(1))
                    ->visit('/distribuicao/exibirItensDistribuicao/'.$distribuicao->id)
                    ->assertSee('Itens desta distribuição')
                    ->pause(2000)
                    ;
        });
    }

    public function testEditarQtde_Valida()
    {
        $this->browse(function (Browser $browser) {
            $distribuicoes = Distribuicao::all();
            $distribuicao = Distribuicao::find(random_int(1, count($distribuicoes)));

            $distribuicao_itens = Distribuicao_item::where('distribuicao_id','=',$distribuicao->id)->get();
            $distribuicao_item = Distribuicao_item::find(random_int(1,count($distribuicao_itens)));

            $browser->loginAs(User::find(1))
                    ->visit('/distribuicao/exibirItensDistribuicao/'.$distribuicao->id)
                    ->visit('/itemDistribuicao/editar/'.$distribuicao_item->id)
                    ->assertSee('Editar Item de Distribuição')
                    ->clear('quantidade_total')
                    ->type('quantidade_total',random_int(1,10))
                    ->pause(2000)
                    ;
        });
    }
}
