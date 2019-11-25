<?php

namespace Tests\Browser;

use App\User;
use App\Contrato;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EdicaoContratoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAberturaEdicao()
    {
        $this->browse(function (Browser $browser) {
            $contratos = Contrato::all();
            $contrato = Contrato::find(random_int(1,count($contratos)));
            $browser->loginAs(User::find(1))
                    ->visit('/contrato/listar')
                    ->assertSee($contrato->fornecedor_id)
                    ->visit('/contrato/editar/'.$contrato->id)
                    ->assertInputValue('data',$contrato->data)
                    ->assertInputValue('n_contrato',$contrato->n_contrato)
                    ->assertInputValue('n_processo_licitatorio',$contrato->n_processo_licitatorio)
                    ->assertInputValue('modalidade',$contrato->modalidade)
                    ->assertInputValue('descricao',$contrato->descricao)
                    ->assertInputValue('valor_total',$contrato->valor_total)
                    ->assertSelected('fornecedor_id',$contrato->fornecedor_id)
                    ->pause(2000)
                    ;
        });
    }

    public function testEdicaoValida()
    {
        $this->browse(function (Browser $browser) {
            $contratos = Contrato::all();
            $contrato = Contrato::find(random_int(1,count($contratos)));
            $contrato_teste = factory(Contrato::class)->make();
            $today = $contrato_teste->data->format('m').$contrato_teste->data->format('d').$contrato_teste->data->format('Y');
            $browser->loginAs(User::find(1))
                    ->visit('/contrato/listar')
                    ->visit('/contrato/editar/'.$contrato->id)
                    ->clear('data')
                    ->type('data',$today)
                    ->clear('n_contrato')
                    ->type('n_contrato',$contrato_teste->n_contrato)
                    ->clear('n_processo_licitatorio')
                    ->type('n_processo_licitatorio',$contrato_teste->n_processo_licitatorio)
                    ->clear('descricao')
                    ->type('descricao',$contrato_teste->descricao)
                    ->select('fornecedor_id')
                    ->pause(1000)
                    ->press('Salvar')
                    ->visit('/contrato/listar')
                    ->assertSee($contrato_teste->n_contrato)
                    ->pause(2000)
                    ;
        });
    }

    public function testEdicaoInvalida()
    {
        $this->browse(function (Browser $browser) {
            $contratos = Contrato::all();
            $contrato = Contrato::find(random_int(1,count($contratos)));
            $contrato_teste = factory(Contrato::class)->make();
            $today = $contrato_teste->data->format('m').$contrato_teste->data->format('d').$contrato_teste->data->format('Y');
            $browser->loginAs(User::find(1))
                    ->visit('/contrato/listar')
                    ->visit('/contrato/editar/'.$contrato->id)
                    ->clear('data')
                    //->type('data',$today)
                    ->clear('n_contrato')
                    //->type('n_contrato',$contrato_teste->n_contrato)
                    ->clear('n_processo_licitatorio')
                    //->type('n_processo_licitatorio',$contrato_teste->n_processo_licitatorio)
                    ->clear('descricao')
                    ->type('descricao',$contrato_teste->descricao)
                    ->select('fornecedor_id')
                    ->pause(1000)
                    ->press('Salvar')
                    ->assertSee('A data é obrigatória')
                    ->assertSee('O Nº de contrato é obrigatório')
                    ->assertSee('O nº de processo licitatório é obrigatório')
                    ->pause(2000)
                    ;
        });
    }
}
