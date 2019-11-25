<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Item;
use App\User;

class EdicaoItemTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAberturaEdicao()
    {
        $this->browse(function (Browser $browser) {
            $itens = Item::all();
            $item = Item::find(random_int(1,count($itens)));
            $browser->loginAs(User::find(1))
                    ->visit('/item/listar')
                    ->assertSee($item->nome)
                    ->visit('/item/editar/'.$item->id)
                    ->assertInputValue('nome',$item->nome)
                    ->assertInputValue('marca',$item->marca)
                    ->assertInputValue('descricao',$item->descricao)
                    ->assertSelected('unidade',$item->unidade)
                    ->assertInputValue('gramatura',$item->gramatura)
                    ->pause(1000)
                    ;
        });
    }

    public function testEdicaoValida()
    {
        $this->browse(function (Browser $browser) {
            $itens = Item::all();
            $item = Item::find(random_int(1,count($itens)));
            $item_teste = factory(Item::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/item/listar')
                    ->assertSee($item->nome)
                    ->visit('/item/editar/'.$item->id)
                    ->clear('nome')
                    ->type('nome',$item_teste->nome)
                    ->clear('marca')
                    ->type('marca',$item_teste->marca)
                    ->clear('descricao')
                    ->type('descricao',$item_teste->descricao)
                    ->clear('gramatura')
                    ->type('gramatura',$item_teste->gramatura)
                    ->select('unidade')
                    ->pause(1000)
                    ->press('Salvar')
                    ->visit('/item/listar')
                    ->assertSee($item->nome)
                    ->assertSee($item->marca)
                    ->pause(2000)
                    ;
        });
    }

    public function testEdicaoInvalida()
    {
        $this->browse(function (Browser $browser) {
            $itens = Item::all();
            $item = Item::find(random_int(1,count($itens)));
            $item_teste = factory(Item::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/item/listar')
                    ->assertSee($item->nome)
                    ->visit('/item/editar/'.$item->id)
                    ->clear('nome')
                    //->type('nome',$item_teste->nome)
                    ->clear('marca')
                    //->type('marca',$item_teste->marca)
                    ->clear('descricao')
                    ->type('descricao',$item_teste->descricao)
                    ->clear('gramatura')
                    //->type('gramatura',$item_teste->gramatura)
                    ->select('unidade')
                    ->pause(1000)
                    ->press('Salvar')
                    ->assertSee('O nome é obrigatório')
                    ->assertSee('A marca é obrigatória')
                    ->assertSee('A gramatura é obrigatória')
                    ->pause(2000)
                    ;
        });
    }
}
