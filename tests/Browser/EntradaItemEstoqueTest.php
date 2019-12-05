<?php

namespace Tests\Browser;

use App\Estoque;
use App\Estoque_item;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EntradaItemEstoque extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testEntradaValida()
    {
        $this->browse(function (Browser $browser) {
            $estoque = Estoque::find(1);
            $estoque_itens = Estoque_item::where('estoque_id','=',$estoque->id)->get();
            $estoque_item = Estoque_item::find(random_int(1,count($estoque_itens)));
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/listar')
                    ->visit('/estoque/exibirItensEstoque/'.$estoque->id)
                    ->visit('/estoque/inserirEntrada/'.$estoque_item->id)
                    ->assertSee('Entrada de Item no Estoque')
                    ->type('quantidade',1)
                    ->type('quantidade_danificados',1)
                    ->press('Fechar Entrada')
                    ->assertSee('Entrada de item.')
                    ->pause(1000)
                    ;
        });
    }

    public function testEntradaInvalida()
    {
        $this->browse(function (Browser $browser) {
            $estoque = Estoque::find(1);
            $estoque_itens = Estoque_item::where('estoque_id','=',$estoque->id)->get();
            $estoque_item = Estoque_item::find(random_int(1,count($estoque_itens)));
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/listar')
                    ->visit('/estoque/exibirItensEstoque/'.$estoque->id)
                    ->visit('/estoque/inserirEntrada/'.$estoque_item->id)
                    ->assertSee('Entrada de Item no Estoque')
                    ->type('quantidade',-1)
                    ->type('quantidade_danificados',-1)
                    ->press('Fechar Entrada')
                    ->assertSee('A quantidade deve estar entre 0 e 99999')
                    ->assertSee('A quantidade danificada deve estar entre 0 e 99999')
                    ->pause(1000)
                    ;
        });
    }

    public function testEntrada_DadosEmFalta()
    {
        $this->browse(function (Browser $browser) {
            $estoque = Estoque::find(1);
            $estoque_itens = Estoque_item::where('estoque_id','=',$estoque->id)->get();
            $estoque_item = Estoque_item::find(random_int(1,count($estoque_itens)));
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/listar')
                    ->visit('/estoque/exibirItensEstoque/'.$estoque->id)
                    ->visit('/estoque/inserirEntrada/'.$estoque_item->id)
                    ->assertSee('Entrada de Item no Estoque')
                    //->type('quantidade',-1)
                    //->type('quantidade_danificados',-1)
                    ->press('Fechar Entrada')
                    ->assertSee('A quantidade é obrigatória')
                    ->assertSee('A quantidade danificada é obrigatória')
                    ->pause(1000)
                    ;
        });
    }

    public function testEntrada_QtdeInsuficiente()
    {
        $this->browse(function (Browser $browser) {
            $estoque = Estoque::find(1);
            $estoque_itens = Estoque_item::where('estoque_id','=',$estoque->id)->get();
            $estoque_item = Estoque_item::find(random_int(1,count($estoque_itens)));
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/listar')
                    ->visit('/estoque/exibirItensEstoque/'.$estoque->id)
                    ->visit('/estoque/inserirEntrada/'.$estoque_item->id)
                    ->assertSee('Entrada de Item no Estoque')
                    ->type('quantidade',8000)
                    ->type('quantidade_danificados',8000)
                    ->press('Fechar Entrada')
                    ->assertSee('Contrato não tem quantidade suficiente')
                    ->pause(2000)
                    ;
        });
    }
}
