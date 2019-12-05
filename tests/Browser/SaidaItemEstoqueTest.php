<?php

namespace Tests\Browser;

use App\Estoque;
use App\Estoque_item;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SaidaItemEstoqueTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSaidaValida()
    {
        $this->browse(function (Browser $browser) {
            $estoque = Estoque::find(1);
            $estoque_itens = Estoque_item::where('estoque_id','=',$estoque->id)->get();
            $estoque_item = Estoque_item::find(random_int(1,count($estoque_itens)));
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/listar')
                    ->visit('/estoque/exibirItensEstoque/'.$estoque->id)
                    ->visit('/estoque/inserirSaida/'.$estoque_item->id)
                    ->assertSee('Saída de Item no Estoque')
                    ->type('quantidade',1)
                    ->type('quantidade_danificados',0)
                    ->press('Fechar Saída')
                    ->assertSee('Saída de item.')
                    ->pause(1000)
                    ;
        });
    }

    public function testSaidaInvalida()
    {
        $this->browse(function (Browser $browser) {
            $estoque = Estoque::find(1);
            $estoque_itens = Estoque_item::where('estoque_id','=',$estoque->id)->get();
            $estoque_item = Estoque_item::find(random_int(1,count($estoque_itens)));
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/listar')
                    ->visit('/estoque/exibirItensEstoque/'.$estoque->id)
                    ->visit('/estoque/inserirSaida/'.$estoque_item->id)
                    ->assertSee('Saída de Item no Estoque')
                    ->type('quantidade',-1)
                    ->type('quantidade_danificados',-1)
                    ->press('Fechar Saída')
                    ->assertSee('A quantidade deve estar entre')
                    ->assertSee('A quantidade danificada deve estar entre 0 e 99999')
                    ->pause(1000)
                    ;
        });
    }

    public function testSaida_DadosEmFalta()
    {
        $this->browse(function (Browser $browser) {
            $estoque = Estoque::find(1);
            $estoque_itens = Estoque_item::where('estoque_id','=',$estoque->id)->get();
            $estoque_item = Estoque_item::find(random_int(1,count($estoque_itens)));
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/listar')
                    ->visit('/estoque/exibirItensEstoque/'.$estoque->id)
                    ->visit('/estoque/inserirSaida/'.$estoque_item->id)
                    ->assertSee('Saída de Item no Estoque')
                    //->type('quantidade',-1)
                    //->type('quantidade_danificados',-1)
                    ->press('Fechar Saída')
                    ->assertSee('A quantidade é obrigatória')
                    ->assertSee('A quantidade danificada é obrigatória')
                    ->pause(1000)
                    ;
        });
    }

    /* public function testSaida_QtdeInsuficiente()
    {
        $this->browse(function (Browser $browser) {
            $estoque = Estoque::find(1);
            $estoque_itens = Estoque_item::where('estoque_id','=',$estoque->id)->get();
            $estoque_item = Estoque_item::find(random_int(1,count($estoque_itens)));
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/listar')
                    ->visit('/estoque/exibirItensEstoque/'.$estoque->id)
                    ->visit('/estoque/inserirSaida/'.$estoque_item->id)
                    ->assertSee('Saída de Item no Estoque')
                    ->type('quantidade',8000)
                    ->type('quantidade_danificados',8000)
                    ->press('Fechar Saída')
                    ->assertSee('insuficiente')
                    ->pause(2000)
                    ;
        });
    } */
}
