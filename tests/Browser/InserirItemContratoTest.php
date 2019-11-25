<?php

namespace Tests\Browser;

use App\Contrato;
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

    /* public function testInserir_DadosEmFalta()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });
    } */
}
