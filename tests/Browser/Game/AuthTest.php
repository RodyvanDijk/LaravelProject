<?php

namespace Tests\Browser\Game;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_user_can_register_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', 'TestUser')
                ->type('email', 'TestUser@test.nl')
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->click('button[type="submit"]')
                ->assertSee('TestUser');
        });
    }
}
