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
    public function testCadastroValido()
    {
        $this->browse(function (Browser $browser) {
            $escola = factory(Escola::class)->make();
            $browser->loginAs(User::find(1))
                ->visit('/escola/cadastrar')
                ->assertSee('Cadastrar Escola')
                ->type('nome', $escola->nome)
                ->select('modalidade_ensino')
                ->type('endereco', $escola->endereco)
                ->type('rota', $escola->rota)
                ->type('periodo_atendimento', $escola->periodo_atendimento)
                ->type('qtde_alunos', $escola->qtde_alunos)
                ->type('gestor', $escola->gestor)
                ->type('telefone', $escola->telefone)
                ->pause(1000)
                ->press('Cadastrar')
                ->visit('/escola/listar')
                ->pause(1000)
                ->assertSee($escola->nome)
                ->pause(3000);
        });
    }

    public function testCadastro_DadosEmFalta()
    {
        $this->browse(function (Browser $browser) {
            $escola = factory(Escola::class)->make();
            $browser->loginAs(User::find(1))
                ->visit('/escola/cadastrar')
                ->assertSee('Cadastrar Escola')
                //->type('nome', $escola->nome)
                //->select('modalidade_ensino')
                ->type('endereco', $escola->endereco)
                ->type('rota', $escola->rota)
                ->type('periodo_atendimento', $escola->periodo_atendimento)
                //->type('qtde_alunos', $escola->qtde_alunos)
                ->type('gestor', $escola->gestor)
                ->type('telefone', $escola->telefone)
                ->pause(1000)
                ->press('Cadastrar')
                ->assertSee('O nome é obrigatório')
                ->assertSee('A modalidade de ensino é obrigatória')
                ->assertSee('A quantidade de alunos é obrigatória')
                ->pause(1000)
                ->visit('/escola/listar')
                ->pause(1000)
                ->assertDontSee($escola->nome)
                ->pause(3000);
        });
    }

    public function testCadastro_QtdeInvalida()
    {
        $this->browse(function (Browser $browser) {
            $escola = factory(Escola::class)->make();
            $browser->loginAs(User::find(1))
                ->visit('/escola/cadastrar')
                ->assertSee('Cadastrar Escola')
                ->type('nome', $escola->nome)
                ->select('modalidade_ensino')
                ->type('endereco', $escola->endereco)
                ->type('rota', $escola->rota)
                ->type('periodo_atendimento', $escola->periodo_atendimento)
                ->type('qtde_alunos', $escola->qtde_alunos*(-1))
                ->type('gestor', $escola->gestor)
                ->type('telefone', $escola->telefone)
                ->pause(1000)
                ->press('Cadastrar')
                ->assertSee('A quantidade de alunos deve estar entre 0 e 9999')
                ->pause(1000)
                ->visit('/escola/listar')
                ->pause(1000)
                ->assertDontSee($escola->nome)
                ->pause(3000);
        });
    }
}
