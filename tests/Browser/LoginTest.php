<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample(){
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Esqueci minha senha')
                    ->pause(2000)
                    ->type('email', 'teste@teste')
                    ->pause(2000)
                    ->type('password', 'testeteste')
                    ->pause(2000)
                    ->press('login')
                    ->pause(5000);
        });
    }
}
