<?php

namespace Tests\Browser;

use App\Estoque;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EdicaoEstoqueTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    /* public function testAberturaEdicao()
    {
         $this->browse(function (Browser $browser) {
            //$estoque = Estoque::find(1);
            $estoques = Estoque::all();
            $estoque = Estoque::find(random_int(1,count($estoques)));
            //$estoque_test = factory(Estoque::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/listar')
                    ->pause(1000)
                    ->visit('/estoque/editar/'.$estoque->id)
                    ->assertInputValue('nome',$estoque->nome)
                    ->pause(2000)
                    ;
        });
    }

    public function testEdicaoValida()
    {
        $this->browse(function (Browser $browser) {
            $estoque = Estoque::find(1);
            //$estoques = Estoque::all();
            //$estoque = Estoque::find(random_int(1,count($estoques)));
            $estoque_test = factory(Estoque::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/listar')
                    ->assertSee($estoque->nome)
                    ->visit('/estoque/editar/'.$estoque->id)
                    ->clear('nome')
                    ->type('nome',$estoque_test->nome)
                    ->press('Salvar')
                    ;
        });
    }

    public function testEdicaoInvalida()
    {
        $this->browse(function (Browser $browser) {
            $estoques = Estoque::all();
            $estoque = Estoque::find(random_int(1,count($estoques)));
            //$estoque_test = factory(Estoque::class)->make();
            $browser->loginAs(User::find(1))
                    ->visit('/estoque/listar')
                    ->assertSee($estoque->nome)
                    ->visit('/estoque/editar/'.$estoque->id)
                    //->assertInputValue('nome',$estoque->nome)
                    ->clear('nome')
                    //->type('nome',$estoque_test->nome)
                    ->pause(1000)
                    ->press('Salvar')
                    ->assertSee('O nome é obrigatório')
                    ->pause(2000)
                    ;
        });
    } */
}
