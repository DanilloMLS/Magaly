<?php

namespace Tests\Browser;

use App\Escola;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use function PHPSTORM_META\type;

class CadastroEscolaTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCadastro()
    {
        $this->browse(function (Browser $browser) {
            $escola = factory(Escola::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/escola/cadastrar')
                    ->assertSee('Cadastrar Escola')
                    ->pause(2000)
                    ->type('nome', $escola->nome)
                    ->select('modalidade_ensino')
                    ->type('endereco', $escola->endereco)
                    ->type('rota', $escola->rota)
                    ->type('periodo_atendimento', $escola->periodo_atendimento)
                    ->type('qtde_alunos', $escola->qtde_alunos)
                    ->type('gestor', $escola->gestor)
                    ->type('telefone', $escola->telefone)
                    ->pause(2000)
                    ->press('Cadastrar')
                    ->pause(2000)
                    ->visit('/escola/listar')
                    ->assertSee($escola->nome)
                    ->pause(2000);
        });
    }
}
