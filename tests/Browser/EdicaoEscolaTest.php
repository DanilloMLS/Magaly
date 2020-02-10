<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Instituicao;
use App\User;

class EdicaoInstituicaoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAberturaEdicao()
    {
        $this->browse(function (Browser $browser) {
            $instituicaos = Instituicao::all();
            $instituicao = Instituicao::find(random_int(1,count($instituicaos)));
            $browser->loginAs(User::find(1))
                    ->visit('/instituicao/listar')
                    ->assertSee($instituicao->nome)
                    ->visit('/instituicao/editar/'.$instituicao->id)
                    ->assertInputValue('nome',$instituicao->nome)
                    //->assertSelected('modalidade_ensino',$instituicao->modalidade_ensino)
                    //->assertInputValue('endereco',$instituicao->endereco)
                    ->assertInputValue('rota',$instituicao->rota)
                    ->assertInputValue('periodo_atendimento',$instituicao->periodo_atendimento)
                    ->assertInputValue('qtde_alunos',$instituicao->qtde_alunos)
                    ->assertInputValue('gestor',$instituicao->gestor)
                    ->assertInputValue('telefone',$instituicao->telefone)
                    ;
        });
    }

    public function testEdicaoValida()
    {
        $this->browse(function (Browser $browser) {
            $instituicaos = Instituicao::all();
            $instituicao = Instituicao::find(random_int(1,count($instituicaos)));
            $instituicao_test = factory(Instituicao::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/instituicao/listar')
                    ->assertSee($instituicao->nome)
                    ->visit('/instituicao/editar/'.$instituicao->id)
                    ->clear('nome')
                    ->type('nome',$instituicao_test->nome)
                    ->select('modalidade_ensino')
                    ->clear('endereco')
                    ->type('endereco',$instituicao_test->endereco)
                    ->clear('rota')
                    ->type('rota',$instituicao_test->rota)
                    ->clear('periodo_atendimento')
                    ->type('periodo_atendimento',$instituicao_test->periodo_atendimento)
                    ->clear('qtde_alunos')
                    ->type('qtde_alunos',$instituicao_test->qtde_alunos)
                    ->clear('gestor')
                    ->type('gestor',$instituicao_test->gestor)
                    ->clear('telefone')
                    ->type('telefone',$instituicao_test->telefone)
                    ->press('Salvar')
                    ->pause(1000)
                    ->visit('/instituicao/listar')
                    ->pause(1000)
                    ->assertSee($instituicao_test->nome)
                    ->pause(2000)
                    ;
        });
    }

    public function testEdicaoInvalida()
    {
        $this->browse(function (Browser $browser) {
            $instituicaos = Instituicao::all();
            $instituicao1 = Instituicao::find(random_int(1,count($instituicaos)));
            $instituicao2 = Instituicao::find(random_int(1,count($instituicaos)));
            $browser->loginAs(User::find(1))
                    ->visit('/instituicao/listar')
                    ->assertSee($instituicao1->nome)
                    ->visit('/instituicao/editar/'.$instituicao1->id)
                    ->clear('nome')
                    ->type('nome',$instituicao2->nome)
                    //->select('modalidade_ensino','Selecione uma Modalidade de ensino')
                    ->clear('endereco')
                    ->type('endereco',$instituicao1->endereco)
                    ->clear('rota')
                    ->type('rota',$instituicao1->rota)
                    ->clear('periodo_atendimento')
                    ->type('periodo_atendimento',$instituicao1->periodo_atendimento)
                    ->clear('qtde_alunos')
                    //->type('qtde_alunos',$instituicao1->qtde_alunos)
                    ->clear('gestor')
                    ->type('gestor',$instituicao1->gestor)
                    ->clear('telefone')
                    ->type('telefone','$instituicao1->telefone')
                    ->press('Salvar')
                    ->pause(1000)
                    ->assertSee('O nome já está em uso')
                    ->assertSee('A quantidade de alunos é obrigatória')
                    //->assertSee('A modalidade de ensino é obrigatória')
                    ;
        });
    }
}
