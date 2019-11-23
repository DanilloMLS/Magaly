<?php

namespace Tests\Browser;

use App\Estoque;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CadastroEstoqueTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCadastroValido()
    {
        $this->browse(function (Browser $browser) {
            $estoque = factory(Estoque::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/cadastrar')
                    ->pause(1000)
                    ->assertSee('Cadastrar Estoque')
                    ->type('nome',$estoque->nome)
                    ->press('Cadastrar')
                    ->visit('/estoque/listar')
                    ->assertSee($estoque->nome)
                    ->pause(2000)
                    ;
        });
    }

    public function testCadastro_SemNome()
    {
        $this->browse(function (Browser $browser) {
            $estoque = factory(Estoque::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/cadastrar')
                    ->pause(1000)
                    //->type('nome','')
                    ->press('Cadastrar')
                    ->assertSee('O nome é obrigatório')
                    ->pause(2000)
                    ;
        });
    }

    public function testCadastro_NomeRepetido()
    {
        $this->browse(function (Browser $browser) {
            $estoques = Estoque::all();
            $estoque = Estoque::find(random_int(1,count($estoques)));
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/cadastrar')
                    ->pause(1000)
                    ->type('nome',$estoque->nome)
                    ->press('Cadastrar')
                    ->assertSee('O nome já está em uso')
                    ->pause(2000)
                    ;
        });
    }
}
