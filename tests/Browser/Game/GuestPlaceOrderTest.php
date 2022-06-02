<?php

namespace Tests\Browser\Game;

use App\Models\Game;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class GuestPlaceOrderTest extends DuskTestCase
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
                ->clickLink('Games')
                ->click('button#add-1')
                ->assertSee($this->game->game)
                ->click('button#place-order')
                ->assertSee('U moet eerst inloggen om een bestelling te plaatsen.')
                ->type('email', 'admin@tcrmbo.nl')
                ->type('password', 'admin')
                ->click('button[type="submit"]')
                ->clickLink('Winkelwagen')
                ->click('button#place-order')
                ->assertSee('Bestelling Geplaatst')
                ->clickLink('Bestellingen')
                ->assertSee($this->game->game);
        });
    }
}
