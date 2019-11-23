<?php

namespace Tests\Browser;

use App\Contrato;
use App\Fornecedor;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
class CadastroContratoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCadastroValido(){
        $this->browse(function (Browser $browser) {
            $contrato = factory(Contrato::class)->make();
            $today = $contrato->data->format('m').$contrato->data->format('d').$contrato->data->format('Y');
            $browser->loginAs(User::find(1))
                ->visit('/contrato/telaCadastrar')
                ->assertSee('Cadastrar Contrato')
                ->pause(1000)
                ->type('data',$today)
                ->type('n_contrato', $contrato->n_contrato)
                ->type('n_processo_licitatorio', $contrato->n_processo_licitatorio)
                ->type('modalidade', $contrato->modalidade)
                ->type('descricao', $contrato->descricao)
                ->select('fornecedor_id')
                ->pause(1000)
                ->press('Cadastrar')
                ->visit('/contrato/listar')
                ->assertSee($contrato->n_contrato)
                ->pause(2000);
        });
    }

    public function testCadastro_DadosEmFalta(){
        $this->browse(function (Browser $browser) {
            $contrato = factory(Contrato::class)->make();
            $today = $contrato->data->format('m').$contrato->data->format('d').$contrato->data->format('Y');
            $browser->loginAs(User::find(1))
                ->visit('/contrato/telaCadastrar')
                ->assertSee('Cadastrar Contrato')
                ->pause(1000)
                //->type('data',$today)
                //->type('n_contrato', $contrato->n_contrato)
                ->type('n_processo_licitatorio', $contrato->n_processo_licitatorio)
                //->type('modalidade', $contrato->modalidade)
                ->type('descricao', $contrato->descricao)
                ->select('fornecedor_id')
                ->pause(1000)
                ->press('Cadastrar')
                ->assertSee('A data é obrigatória')
                ->assertSee('O Nº de contrato é obrigatório')
                ->assertSee('A modalidade é obrigatória')
                ->pause(2000);
        });
    }

    public function testCadastro_DadosInvalidos(){
        $this->browse(function (Browser $browser) {
            $contrato = factory(Contrato::class)->make();
            $today = $contrato->data->format('m').$contrato->data->format('d').$contrato->data->format('1950');
            $browser->loginAs(User::find(1))
                ->visit('/contrato/telaCadastrar')
                ->assertSee('Cadastrar Contrato')
                ->pause(1000)
                ->type('data','01011970')
                ->type('n_contrato', $contrato->n_contrato)
                ->type('n_processo_licitatorio', $contrato->n_processo_licitatorio)
                ->type('modalidade', $contrato->modalidade)
                ->type('descricao', $contrato->descricao)
                ->select('fornecedor_id')
                ->pause(1000)
                ->press('Cadastrar')
                ->assertSee('A data é muito antiga')
                ->pause(2000);
        });
    }

    public function testCadastro_ContratoRep(){
        $this->browse(function (Browser $browser) {
            $contratos = Contrato::all();
            $contrato_rep = Contrato::find(random_int(1,count($contratos)));
            $contrato = factory(Contrato::class)->make();
            $today = $contrato->data->format('m').$contrato->data->format('d').$contrato->data->format('1950');
            $browser->loginAs(User::find(1))
                ->visit('/contrato/telaCadastrar')
                ->assertSee('Cadastrar Contrato')
                ->pause(1000)
                ->type('data',$today)
                ->type('n_contrato', $contrato_rep->n_contrato)
                ->type('n_processo_licitatorio', $contrato->n_processo_licitatorio)
                ->type('modalidade', $contrato->modalidade)
                ->type('descricao', $contrato->descricao)
                ->select('fornecedor_id')
                ->pause(1000)
                ->press('Cadastrar')
                ->assertSee('Esse nº de contrato de já está em uso')
                ->pause(2000);
        });
    }
}