<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Fornecedor;
use App\User;

class EdicaoFornecedorTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAberturaEdicao()
    {
        $this->browse(function (Browser $browser) {
            $fornecedores = Fornecedor::all();
            $fornecedor = Fornecedor::find(random_int(1,count($fornecedores)));
            $browser->loginAs(User::find(1))
                    ->visit('/fornecedor/listar')
                    ->assertSee($fornecedor->nome)
                    ->visit('/fornecedor/editar/'.$fornecedor->id)
                    ->assertInputValue('nome',$fornecedor->nome)
                    ->assertInputValue('cnpj',$fornecedor->cnpj)
                    ->assertInputValue('telefone',$fornecedor->telefone)
                    ->assertInputValue('email',$fornecedor->email)
                    ;
        });
    }

    public function testEdicaoValidaNome()
    {
        $this->browse(function (Browser $browser) {
            $fornecedores = Fornecedor::all();
            $fornecedor = Fornecedor::find(random_int(1,count($fornecedores)));
            $forn_editar = factory(Fornecedor::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/fornecedor/listar')
                    ->assertSee($fornecedor->nome)
                    ->visit('/fornecedor/editar/'.$fornecedor->id)
                    ->assertInputValue('nome',$fornecedor->nome)
                    ->clear('nome')
                    ->type('nome',$forn_editar->nome)
                    ->press('Salvar')
                    ->pause(1000)
                    ->assertSee($forn_editar->nome)
                    ;
        });
    }
}
