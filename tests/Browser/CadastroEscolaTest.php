<?php

namespace Tests\Browser;

use App\Instituicao;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CadastroInstituicaoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCadastroValido()
    {
        $this->browse(function (Browser $browser) {
            $instituicao = factory(Instituicao::class)->make();
            $browser->loginAs(User::find(1))
                ->visit('/instituicao/cadastrar')
                ->assertSee('Cadastrar Instituicao')
                ->type('nome', $instituicao->nome)
                ->select('modalidade_ensino')
                ->type('endereco', $instituicao->endereco)
                ->type('rota', $instituicao->rota)
                ->type('periodo_atendimento', $instituicao->periodo_atendimento)
                ->type('qtde_alunos', $instituicao->qtde_alunos)
                ->type('gestor', $instituicao->gestor)
                ->type('telefone', $instituicao->telefone)
                ->pause(1000)
                ->press('Cadastrar')
                ->visit('/instituicao/listar')
                ->pause(1000)
                ->assertSee($instituicao->nome)
                ->pause(3000);
        });
    }

    public function testCadastro_DadosEmFalta()
    {
        $this->browse(function (Browser $browser) {
            $instituicao = factory(Instituicao::class)->make();
            $browser->loginAs(User::find(1))
                ->visit('/instituicao/cadastrar')
                ->assertSee('Cadastrar Instituicao')
                //->type('nome', $instituicao->nome)
                //->select('modalidade_ensino')
                ->type('endereco', $instituicao->endereco)
                ->type('rota', $instituicao->rota)
                ->type('periodo_atendimento', $instituicao->periodo_atendimento)
                //->type('qtde_alunos', $instituicao->qtde_alunos)
                ->type('gestor', $instituicao->gestor)
                ->type('telefone', $instituicao->telefone)
                ->pause(1000)
                ->press('Cadastrar')
                ->assertSee('O nome é obrigatório')
                ->assertSee('A modalidade de ensino é obrigatória')
                ->assertSee('A quantidade de alunos é obrigatória')
                ->pause(1000)
                ->visit('/instituicao/listar')
                ->pause(1000)
                ->assertDontSee($instituicao->nome)
                ->pause(3000);
        });
    }

    public function testCadastro_QtdeInvalida()
    {
        $this->browse(function (Browser $browser) {
            $instituicao = factory(Instituicao::class)->make();
            $browser->loginAs(User::find(1))
                ->visit('/instituicao/cadastrar')
                ->assertSee('Cadastrar Instituicao')
                ->type('nome', $instituicao->nome)
                ->select('modalidade_ensino')
                ->type('endereco', $instituicao->endereco)
                ->type('rota', $instituicao->rota)
                ->type('periodo_atendimento', $instituicao->periodo_atendimento)
                ->type('qtde_alunos', $instituicao->qtde_alunos*(-1))
                ->type('gestor', $instituicao->gestor)
                ->type('telefone', $instituicao->telefone)
                ->pause(1000)
                ->press('Cadastrar')
                ->assertSee('A quantidade de alunos deve estar entre 0 e 9999')
                ->pause(1000)
                ->visit('/instituicao/listar')
                ->pause(1000)
                ->assertDontSee($instituicao->nome)
                ->pause(3000);
        });
    }
}
