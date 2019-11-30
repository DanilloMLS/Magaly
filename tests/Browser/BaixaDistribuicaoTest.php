<?php

namespace Tests\Browser;

use App\User;
use App\Distribuicao;
use App\Distribuicao_item;
use App\Item;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BaixaDistribuicaoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAbertura()
    {
        $this->browse(function (Browser $browser) {
            $distribuicoes = Distribuicao::all();
            $distribuicao = Distribuicao::find(random_int(1, count($distribuicoes)));

            $distribuicao_itens = Distribuicao_item::where('distribuicao_id','=',$distribuicao->id)->get();
            $distribuicao_item = Distribuicao_item::find(random_int(1,count($distribuicao_itens)));
            $item = Item::find($distribuicao_item->item_id);

            $browser->loginAs(User::find(1))
                    ->visit('/distribuicao/novaBaixa/'.$distribuicao->id)
                    ->assertSee('Baixa Distribuição - Lista de Itens')
                    ->assertSee($item->nome)
                    ->pause(1000)
                    ;
        });
    }

    public function testBaixaItem()
    {
        $this->browse(function (Browser $browser) {
            $distribuicoes = Distribuicao::all();
            $distribuicao = Distribuicao::find(random_int(1, count($distribuicoes)));

            $distribuicao_itens = Distribuicao_item::where('distribuicao_id','=',$distribuicao->id)->get();
            $distribuicao_item = Distribuicao_item::find(random_int(1,count($distribuicao_itens)));
            $item = Item::find($distribuicao_item->item_id);
            
            $q_d = random_int(0,($distribuicao_item->quantidade_falta)/10);
            $q_a = random_int(0,($distribuicao_item->quantidade_falta)/2);
            $browser->loginAs(User::find(1))
                    ->visit('/distribuicao/novaBaixa/'.$distribuicao->id)
                    ->assertSee('Baixa Distribuição - Lista de Itens')
                    ->assertSee($item->nome)
                    ->pause(1000)
                    ->visit('/distribuicao/baixaItem/'.$distribuicao_item->id)
                    ->assertSee('Baixa de Item')
                    ->type('quantidade_aceita',$q_a)
                    ->type('quantidade_danificados',$q_d)
                    ->press('Salvar')
                    ->pause(1000)
                    ->assertSee('Baixa Distribuição - Lista de Itens')
                    //->assertUrlIs('http://localhost:8000/distribuicao/novaBaixa/'.$distribuicao->id)
                    ;
        });
    }

    public function testBaixaDistribuicao()
    {
        $this->browse(function (Browser $browser) {
            $distribuicoes = Distribuicao::all();
            $distribuicao = Distribuicao::find(random_int(1, count($distribuicoes)));

            $distribuicao_itens = Distribuicao_item::where('distribuicao_id','=',$distribuicao->id)->get();
            $distribuicao_item = Distribuicao_item::find(random_int(1,count($distribuicao_itens)));
            $item = Item::find($distribuicao_item->item_id);
            
            $q_d = random_int(0,($distribuicao_item->quantidade_falta)/10);
            $q_a = random_int(0,($distribuicao_item->quantidade_falta)/2);
            $browser->loginAs(User::find(1))
                    ->visit('/distribuicao/novaBaixa/'.$distribuicao->id)
                    ->assertSee('Baixa Distribuição - Lista de Itens')
                    ->assertSee($item->nome)
                    ->pause(1000)
                    ->visit('/distribuicao/baixaItem/'.$distribuicao_item->id)
                    ->assertSee('Baixa de Item')
                    ->type('quantidade_aceita',$q_a)
                    ->type('quantidade_danificados',$q_d)
                    ->press('Salvar')
                    ->pause(1000)
                    ->visit('/distribuicao/novaBaixa/'.$distribuicao->id)
                    ->click('#btnconcluir')
                    ->pause(2000)
                    ->assertSee('Baixa cadastrada. Movimentações nos estoques feitas automaticamente.')
                    ;
        });
    }
}
