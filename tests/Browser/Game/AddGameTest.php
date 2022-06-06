<?php

namespace Tests\Browser\Game;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddGameTest extends DuskTestCase
{
    use DatabaseMigrations;


    /**
     * @test
     */
    public function an_admin_can_add_a_game()
    {
        $this->seed('RoleAndPermissionSeeder');
        $this->seed('UserSeeder');
        $this->seed('CategorySeeder');

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Login')
                ->type('email', 'admin@tcrmbo.nl')
                ->type('password', 'admin')
                ->click('button[type="submit"]')
                ->assertSee('Admin')
                ->clickLink('Games List')
                ->clickLink('Game Toevoegen')
                ->assertSee('Games Admin')
                ->type('game', 'TestGame')
                ->type('description', 'TestGame description')
                ->type('price', '10')
                ->click('button[type="submit"]')
                ->assertSee('TestGame');
        });
    }
}
