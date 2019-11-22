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
                    ->pause(2000)
                    ;
        });
    }

    public function testEdicaoValida()
    {
        $this->browse(function (Browser $browser) {
            $fornecedores = Fornecedor::all();
            $fornecedor = Fornecedor::find(random_int(1,count($fornecedores)));
            $forn_editar = factory(Fornecedor::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/fornecedor/listar')
                    ->pause(1000)
                    ->assertSee($fornecedor->nome)
                    ->visit('/fornecedor/editar/'.$fornecedor->id)
                    ->assertInputValue('nome',$fornecedor->nome)
                    ->clear('nome')
                    ->type('nome',$forn_editar->nome)
                    ->clear('cnpj')
                    ->type('cnpj',$forn_editar->cnpj)
                    ->clear('telefone')
                    ->type('telefone',$forn_editar->telefone)
                    ->clear('email')
                    ->type('email',$forn_editar->email)
                    ->press('Salvar')
                    ->pause(1000)
                    ->assertSee($forn_editar->nome)
                    ->assertSee($forn_editar->cnpj)
                    ->assertSee($forn_editar->telefone)
                    ->assertSee($forn_editar->email)
                    ->pause(2000)
                    ;
        });
    }

    public function testEdicaoInvalida()
    {
        $this->browse(function (Browser $browser) {
            $fornecedores = Fornecedor::all();
            $fornecedor1 = Fornecedor::find(random_int(1,count($fornecedores)));
            $fornecedor2 = Fornecedor::find(random_int(1,count($fornecedores)));
            $forn_editar = factory(Fornecedor::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/fornecedor/listar')
                    ->pause(1000)
                    ->assertSee($fornecedor1->nome)
                    ->visit('/fornecedor/editar/'.$fornecedor1->id)
                    ->clear('nome')
                    ->type('nome',$fornecedor2->nome)
                    ->clear('cnpj')
                    ->type('cnpj',$fornecedor2->cnpj)
                    ->clear('telefone')
                    ->type('telefone',$fornecedor2->telefone)
                    ->clear('email')
                    ->type('email',$fornecedor2->email)
                    ->press('Salvar')
                    ->pause(1000)
                    ->assertSee('Esse nome já está em uso')
                    ->assertSee('Esse CNPJ já está em uso')
                    ->assertSee('Esse e-mail já está em uso')
                    ->pause(2000)
                    ;
        });
    }
}
