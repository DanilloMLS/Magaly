<?php

namespace Tests\Browser;

use App\Contrato;
use App\Contrato_item;
use App\Item;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class InserirItemContratoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExibirItens()
    {
        $this->browse(function (Browser $browser) {
            $contratos = Contrato::all();
            $contrato = Contrato::find(random_int(1,count($contratos)));
            $browser->loginAs(User::find(1))
                    ->visit('/contrato/listar')
                    ->assertSee('Contratos')
                    ->visit('/contrato/exibirItensContrato/'.$contrato->id)
                    ->assertSee('Itens deste contrato')
                    ->pause(1000)
                    ;
        });
    }

    public function testInserir_DadosEmFalta()
    {
        $this->browse(function (Browser $browser) {
            $contratos = Contrato::all();
            $contrato = Contrato::find(random_int(1,count($contratos)));
            $browser->loginAs(User::find(1))
                    ->visit('/contrato/listar')
                    ->visit('/contrato/inserirItemContrato/'.$contrato->id)
                    ->assertSee('Cadastrar Item no Contrato')
                    ->press('Inserir')
                    ->assertSee('O nome é obrigatório')
                    ->assertSee('A marca é obrigatória')
                    ->assertSee('O campo valor unitario é obrigatório.')
                    ->assertSee('A gramatura é obrigatória')
                    ->assertSee('A unidade é obrigatória')
                    ->assertSee('A quantidade é obrigatória')
                    ->pause(1000)
                    ;
        });
    }

    public function testInserirValido()
    {
        $this->browse(function (Browser $browser) {
            $contratos = Contrato::all();
            $contrato = Contrato::find(random_int(1,count($contratos)));
            $contrato_teste = factory(Contrato_item::class)->make();
            $item_teste = factory(Item::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/contrato/listar')
                    ->visit('/contrato/inserirItemContrato/'.$contrato->id)
                    ->assertSee('Cadastrar Item no Contrato')
                    ->type('nome',$item_teste->nome)
                    ->type('marca',$item_teste->marca)
                    ->type('descricao',$item_teste->descricao)
                    ->type('valor_unitario',$contrato_teste->valor_unitario)
                    ->type('gramatura',$item_teste->gramatura)
                    ->select('unidade','G')
                    ->type('quantidade',$contrato_teste->quantidade)
                    ->press('Inserir')
                    ->pause(1000)
                    ->visit('/contrato/exibirItensContrato/'.$contrato->id)
                    ->assertSee($item_teste->nome)
                    ->assertSee($contrato_teste->valor_unitario)
                    ->assertSee($contrato_teste->quantidade)
                    ;
        });
    }

    public function testInserirInvalido()
    {
        $this->browse(function (Browser $browser) {
            $contratos = Contrato::all();
            $contrato = Contrato::find(random_int(1,count($contratos)));
            $contrato_teste = factory(Contrato_item::class)->make();
            $item_teste = factory(Item::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/contrato/listar')
                    ->visit('/contrato/inserirItemContrato/'.$contrato->id)
                    ->assertSee('Cadastrar Item no Contrato')
                    ->type('nome',$item_teste->nome)
                    ->type('marca',$item_teste->marca)
                    ->type('descricao',$item_teste->descricao)
                    ->type('valor_unitario',$contrato_teste->valor_unitario*(-1))
                    ->type('gramatura',$item_teste->gramatura*(-1))
                    ->select('unidade','G')
                    ->type('quantidade',$contrato_teste->quantidade*(-1))
                    ->press('Inserir')
                    ->pause(1000)
                    ->assertSee('A gramatura deve estar entre 0 e 5000000')
                    ->assertSee('A quantidade deve estar entre 0 e 5000000')
                    ->assertSee('O valor unitário deve ser maior que zero')
                    ;
        });
    }

    public function testInserir_EditarValorQtde()
    {
        $this->browse(function (Browser $browser) {
            $contratos = Contrato::all();
            $contrato = Contrato::find(random_int(1,count($contratos)));

            $contrato_teste = factory(Contrato_item::class)->make();

            $contrato_itens = Contrato_item::where('contrato_id','=',$contrato->id)->get();
            $contrato_item = Contrato_item::find(random_int(1,count($contrato_itens)));

            /* $itens = Item::where('id','=',$contrato->id)->get();
            $item = Item::find(random_int(1,count($itens))); */
            $browser->loginAs(User::find(1))
                    ->visit('/contrato/listar')
                    ->visit('/contrato/exibirItensContrato/'.$contrato->id)
                    ->visit('/itemContrato/editar/'.$contrato->id.'/'.$contrato_item->id)
                    ->clear('quantidade')
                    ->clear('valor_unitario')
                    ->type('quantidade',$contrato_teste->quantidade)
                    ->type('valor_unitario',$contrato_teste->valor_unitario)
                    ->press('Salvar')
                    ->pause(1000)
                    ->assertSee('Valores alterados com sucesso')
                    //->visit('/itemContrato/editar/'.$contrato->id.'/'.$item->id)
                    
                    ;
        });
    }

    public function testInserir_EditarValorQtdeInvalido()
    {
        $this->browse(function (Browser $browser) {
            $contratos = Contrato::all();
            $contrato = Contrato::find(random_int(1,count($contratos)));

            $contrato_teste = factory(Contrato_item::class)->make();

            $contrato_itens = Contrato_item::where('contrato_id','=',$contrato->id)->get();
            $contrato_item = Contrato_item::find(random_int(1,count($contrato_itens)));

            /* $itens = Item::where('id','=',$contrato->id)->get();
            $item = Item::find(random_int(1,count($itens))); */
            $browser->loginAs(User::find(1))
                    ->visit('/contrato/listar')
                    ->visit('/contrato/exibirItensContrato/'.$contrato->id)
                    ->visit('/itemContrato/editar/'.$contrato->id.'/'.$contrato_item->id)
                    ->clear('quantidade')
                    ->clear('valor_unitario')
                    ->type('quantidade',$contrato_teste->quantidade*(-1))
                    ->type('valor_unitario',$contrato_teste->valor_unitario*(-1))
                    ->press('Salvar')
                    ->pause(1000)
                    ->assertSee('A quantidade deve estar entre 0 e 5000000')
                    ->assertSee('O valor unitário deve estar entre 0 e 5000000')
                    ;
        });
    }
}
