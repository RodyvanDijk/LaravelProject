<?php

namespace Tests\Browser\Game;

use App\Models\Game;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UpdateGameTest extends DuskTestCase
{
    use DatabaseMigrations;


    /**
     * @test
     */
    public function an_admin_can_update_a_game()
    {
        $this->seed('RoleAndPermissionSeeder');
        $this->seed('UserSeeder');
        $this->seed('CategorySeeder');

        $this->game = Game::factory()->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Login')
                ->type('email', 'admin@tcrmbo.nl')
                ->type('password', 'admin')
                ->click('button[type="submit"]')
                ->assertSee('Admin')
                ->clickLink('Games List')
                ->assertSee($this->game->game)
                ->click('a#edit-1')
                ->type('game', 'Banaan')
                ->click('button[type="submit"]')
                ->assertSee('Banaan')
                ->assertDontSee('TestGame');
        });
    }
}
