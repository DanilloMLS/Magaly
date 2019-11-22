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
                ->pause(2000)
                ->type('data',$today)
                ->pause(2000)
                ->type('n_contrato', $contrato->n_contrato)
                ->pause(1000)
                ->type('n_processo_licitatorio', $contrato->n_processo_licitatorio)
                ->pause(1000)
                ->type('modalidade', $contrato->modalidade)
                ->pause(1000)
                ->select('fornecedor_id')
                ->pause(1000)
                ->press('Cadastrar')
                ->pause(2000)
                ->visit('/contrato/listar')
                ->assertSee($contrato->n_contrato)
                ->pause(2000);
        });
    }
}