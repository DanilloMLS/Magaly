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
     * Como usuário, preciso cadastrar um fornecedor para fazer contratos
     * com eles.
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
                ->pause(1000)
                ->type('nome', $fornecedor->nome)
                ->type('cnpj', $fornecedor->cnpj)
                ->type('telefone', $fornecedor->telefone)
                ->type('email', $fornecedor->email)
                ->pause(1000)
                ->press('Cadastrar')
                ->visit('/fornecedor/listar')
                ->assertSee($fornecedor->nome)
                ->pause(2000);
        });
    }

    public function testCadastro_DadosEmFalta(){
        $this->browse(function (Browser $browser) {
            $fornecedor = factory(Fornecedor::class)->make();
            //$fornecedor->telefone = '87999999999';
            $browser->loginAs(User::find(1))
                ->visit('/fornecedor/cadastrar')
                ->assertSee('Cadastrar Fornecedor')
                ->pause(1000)
                ->clear('nome')
                ->clear('cnpj')
                ->type('telefone', $fornecedor->telefone)
                ->type('email', $fornecedor->email)
                ->press('Cadastrar')
                ->assertSee('O nome é obrigatório')
                ->assertSee('O CNPJ é obrigatório')
                ->pause(2000);
        });
    }

    public function testCadastro_DadosRepetidos(){
        $this->browse(function (Browser $browser) {
            $fornecedores = Fornecedor::all();
            $fornecedor = Fornecedor::find(random_int(1,count($fornecedores)));
            $forn_editar = factory(Fornecedor::class)->make();
            //$fornecedor->telefone = '87999999999';
            $browser->loginAs(User::find(1))
                ->visit('/fornecedor/cadastrar')
                ->assertSee('Cadastrar Fornecedor')
                ->pause(1000)
                ->type('nome', $fornecedor->nome)
                ->type('cnpj', $fornecedor->cnpj)
                ->type('telefone', $forn_editar->telefone)
                ->type('email', $fornecedor->email)
                ->pause(1000)
                ->press('Cadastrar')
                ->assertSee('Esse nome já está em uso')
                ->assertSee('Esse CNPJ já está em uso')
                ->assertSee('Esse e-mail já está em uso')
                ->pause(2000);
        });
    }

    public function testCadastro_CNPJInvalido(){
        $this->browse(function (Browser $browser) {
            $fornecedor = factory(Fornecedor::class)->make();
            //$fornecedor->telefone = '87999999999';
            $browser->loginAs(User::find(1))
                ->visit('/fornecedor/cadastrar')
                ->assertSee('Cadastrar Fornecedor')
                ->pause(1000)
                ->type('nome', $fornecedor->nome)
                ->type('cnpj', '2132655487')
                ->type('telefone', $fornecedor->telefone)
                ->type('email', $fornecedor->email)
                ->pause(1000)
                ->press('Cadastrar')
                ->assertSee('O CNPJ deve ter 14 dígitos')
                ->pause(2000);
        });
    }
}
