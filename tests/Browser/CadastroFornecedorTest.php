<?php

namespace Tests\Browser;

use App\Fornecedor;
use App\User;
use Tests\DuskTestCase;
use Tests\Browser\LoginTest;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CadastroFornecedorTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCadastroValido(){
        $this->browse(function (Browser $browser) {
            $fornecedor = factory(Fornecedor::class)->make();
            //$fornecedor->telefone = '87999999999';
            $browser->loginAs(User::find(1))
                ->visit('/fornecedor/cadastrar')
                ->assertSee('Cadastrar Fornecedor')
                ->pause(2000)
                ->type('nome', $fornecedor->nome)
                ->pause(1000)
                ->type('cnpj', $fornecedor->cnpj)
                ->pause(1000)
                ->type('telefone', $fornecedor->telefone)
                ->pause(1000)
                ->type('email', $fornecedor->email)
                ->pause(2000)
                ->press('Cadastrar')
                ->visit('/fornecedor/listar')
                ->assertSee($fornecedor->nome)
                ->pause(2000);
        });
    }
}
