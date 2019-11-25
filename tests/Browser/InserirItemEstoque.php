<?php

namespace Tests\Browser;

use App\Estoque;
use App\Estoque_item;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class InserirItemEstoque extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testInserirValido()
    {
        $this->browse(function (Browser $browser) {
            $estoque = Estoque::find(1);
            $item = factory(Estoque_item::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/novoItemEstoque/'.$estoque->id)
                    ->select('item_contrato_id')
                    ->type('quantidade',1)
                    ->type('quantidade_danificados',1)
                    ->type('data_validade','01012020')
                    ->type('n_lote',$item->n_lote)
                    ->pause(1000)
                    ->press('Inserir no Estoque')
                    ->pause(2000)
                    ->visit('/estoque/exibirItensEstoque/'.$estoque->id)
                    ->assertSee($item->n_lote)
                    ;
        });
    }

    public function testInserirInvalido()
    {
        $this->browse(function (Browser $browser) {
            $estoque = Estoque::find(1);
            $item = factory(Estoque_item::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/novoItemEstoque/'.$estoque->id)
                    ->select('item_contrato_id')
                    ->type('quantidade',-10)
                    ->type('quantidade_danificados',-10)
                    ->type('data_validade','01012000')
                    ->type('n_lote',$item->n_lote)
                    ->press('Inserir no Estoque')
                    ->pause(1000)
                    ->assertSee('A quantidade deve estar entre 0 e 99999')
                    ->assertSee('A quantidade danificada deve estar entre 0 e 99999')
                    ->assertSee('A data deve ser igual ou posterior a hoje')
                    ;
        });
    }

    public function testInserir_DadosEmFalta()
    {
        $this->browse(function (Browser $browser) {
            $estoque = Estoque::find(1);
            $item = factory(Estoque_item::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/novoItemEstoque/'.$estoque->id)
                    /* ->select('item_contrato_id')
                    ->type('quantidade',-10)
                    ->type('quantidade_danificados',-10)
                    ->type('data_validade','01012000')
                    ->type('n_lote',$item->n_lote) */
                    ->press('Inserir no Estoque')
                    ->pause(1000)
                    ->assertSee('O campo item contrato id é obrigatório.')
                    ->assertSee('A quantidade é obrigatória')
                    ->assertSee('A quantidade danificada é obrigatória')
                    ->assertSee('A data é obrigatória')
                    ->assertSee('O lote é obrigatório')
                    ;
        });
    }
}
