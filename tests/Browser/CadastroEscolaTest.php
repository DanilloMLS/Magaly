<?php

namespace Tests\Browser;

use App\Escola;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CadastroEscolaTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $escola = factory(Escola::class)->make();
            $escola->telefone = '87999999999';
            $browser->loginAs(User::find(1))
                ->visit('/escola/cadastrar')
                ->assertSee('Cadastrar Escola')
                ->type('nome', $escola->nome)
                ->pause(1000)
                ->select('modalidade_ensino')
                ->pause(1000)
                ->type('endereco', $escola->endereco)
                ->pause(1000)
                ->type('rota', $escola->rota)
                ->pause(1000)
                ->type('periodo_atendimento', $escola->periodo_atendimento)
                ->pause(1000)
                ->type('qtde_alunos', $escola->qtde_alunos)
                ->pause(1000)
                ->type('gestor', $escola->gestor)
                ->pause(1000)
                ->type('telefone', $escola->telefone)
                ->pause(3000)
                ->press('Cadastrar')
                ->visit('/escola/listar')
                ->assertSee($escola->nome)
                ->pause(3000);
        });
    }
}
