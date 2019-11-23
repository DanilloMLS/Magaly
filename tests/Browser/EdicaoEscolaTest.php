<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Escola;
use App\User;

class EdicaoEscolaTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAberturaEdicao()
    {
        $this->browse(function (Browser $browser) {
            $escolas = Escola::all();
            $escola = Escola::find(random_int(1,count($escolas)));
            $browser->loginAs(User::find(1))
                    ->visit('/escola/listar')
                    ->assertSee($escola->nome)
                    ->visit('/escola/editar/'.$escola->id)
                    ->assertInputValue('nome',$escola->nome)
                    //->assertSelected('modalidade_ensino',$escola->modalidade_ensino)
                    //->assertInputValue('endereco',$escola->endereco)
                    ->assertInputValue('rota',$escola->rota)
                    ->assertInputValue('periodo_atendimento',$escola->periodo_atendimento)
                    ->assertInputValue('qtde_alunos',$escola->qtde_alunos)
                    ->assertInputValue('gestor',$escola->gestor)
                    ->assertInputValue('telefone',$escola->telefone)
                    ;
        });
    }

    public function testEdicaoValida()
    {
        $this->browse(function (Browser $browser) {
            $escolas = Escola::all();
            $escola = Escola::find(random_int(1,count($escolas)));
            $escola_test = factory(Escola::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/escola/listar')
                    ->assertSee($escola->nome)
                    ->visit('/escola/editar/'.$escola->id)
                    ->clear('nome')
                    ->type('nome',$escola_test->nome)
                    ->select('modalidade_ensino')
                    ->clear('endereco')
                    ->type('endereco',$escola_test->endereco)
                    ->clear('rota')
                    ->type('rota',$escola_test->rota)
                    ->clear('periodo_atendimento')
                    ->type('periodo_atendimento',$escola_test->periodo_atendimento)
                    ->clear('qtde_alunos')
                    ->type('qtde_alunos',$escola_test->qtde_alunos)
                    ->clear('gestor')
                    ->type('gestor',$escola_test->gestor)
                    ->clear('telefone')
                    ->type('telefone',$escola_test->telefone)
                    ->press('Salvar')
                    ->pause(1000)
                    ->visit('/escola/listar')
                    ->pause(1000)
                    ->assertSee($escola_test->nome)
                    ->pause(2000)
                    ;
        });
    }

    public function testEdicaoInvalida()
    {
        $this->browse(function (Browser $browser) {
            $escolas = Escola::all();
            $escola1 = Escola::find(random_int(1,count($escolas)));
            $escola2 = Escola::find(random_int(1,count($escolas)));
            $browser->loginAs(User::find(1))
                    ->visit('/escola/listar')
                    ->assertSee($escola1->nome)
                    ->visit('/escola/editar/'.$escola1->id)
                    ->clear('nome')
                    ->type('nome',$escola2->nome)
                    //->select('modalidade_ensino','Selecione uma Modalidade de ensino')
                    ->clear('endereco')
                    ->type('endereco',$escola1->endereco)
                    ->clear('rota')
                    ->type('rota',$escola1->rota)
                    ->clear('periodo_atendimento')
                    ->type('periodo_atendimento',$escola1->periodo_atendimento)
                    ->clear('qtde_alunos')
                    //->type('qtde_alunos',$escola1->qtde_alunos)
                    ->clear('gestor')
                    ->type('gestor',$escola1->gestor)
                    ->clear('telefone')
                    ->type('telefone','$escola1->telefone')
                    ->press('Salvar')
                    ->pause(1000)
                    ->assertSee('O nome já está em uso')
                    ->assertSee('A quantidade de alunos é obrigatória')
                    //->assertSee('A modalidade de ensino é obrigatória')
                    ;
        });
    }
}
