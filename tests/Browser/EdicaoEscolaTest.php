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
                    ->assertInputValue('endereco',$escola->endereco)
                    ->assertInputValue('rota',$escola->rota)
                    ->assertInputValue('periodo_atendimento',$escola->periodo_atendimento)
                    ->assertInputValue('qtde_alunos',$escola->qtde_alunos)
                    ->assertInputValue('gestor',$escola->gestor)
                    ->assertInputValue('telefone',$escola->telefone)
                    ;
        });
    }

    public function testEdicaoValidaNome()
    {
        $this->browse(function (Browser $browser) {
            $escolas = Escola::all();
            $escola = Escola::find(random_int(1,count($escolas)));
            $escola_test = factory(Escola::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/escola/listar')
                    ->assertSee($escola->nome)
                    ->visit('/escola/editar/'.$escola->id)
                    ->assertInputValue('nome',$escola->nome)
                    ->clear('nome')
                    ->type('nome',$escola_test->nome)
                    ->press('Salvar')
                    ->pause(1000)
                    ->assertSee($escola_test->nome)
                    ;
        });
    }
}
