<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CadastroDistribuicaoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCadastroValido()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/distribuicao/telaCadastrar')
                    ->assertSee('Cadastrar Distribuição')
                    ->select('instituicao_id')
                    ->select('cardapio_id')
                    ->select('estoque_id',1)
                    ->pause(1000)
                    ->press('Cadastrar')
                    ->pause(2000)
                    ;
        });
    }

    public function testCadastroInvalido()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/distribuicao/telaCadastrar')
                    ->assertSee('Cadastrar Distribuição')
                    /* ->select('instituicao_id')
                    ->select('cardapio_id')
                    ->select('estoque_id') */
                    ->pause(1000)
                    ->press('Cadastrar')
                    ->pause(1000)
                    ->assertSee('Escolha uma instituicao')
                    ->assertSee('Escolha um cardápio')
                    ->assertSee('Escolha um estoque')
                    ;
        });
    }
}