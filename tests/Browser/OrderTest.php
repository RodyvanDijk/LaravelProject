<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class OrderTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testUserOrderAndCart()
    {
        $this->seed('RoleAndPermissionSeeder');
        $this->seed('UserSeeder');
        $this->seed('CategorySeeder');
        $this->seed('GameSeeder');

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'user@tcrmbo.nl')
                ->type('password', 'user')
                ->click('button[type="submit"]')
                ->assertSee('User')
                ->clickLink('Games')
                ->click('button[id="add-2"')
                ->click('select[name="newQty"]')
                ->click('option[value="3"]')
                ->click('button[id="change"]')
                ->click('button[id="submit"]')
                ->assertSee('Bestelling Geplaatst')
                ->clickLink('Bestellingen')
                ->assertSee('Bestellingen')
                ->assertSee('3')
                ->click('a[href="/"]')
                ->clickLink('Logout')
                ->assertSee('Guest');
        });
    }

    public function testGuestOrderAndCart()
    {
        $this->seed('RoleAndPermissionSeeder');
        $this->seed('UserSeeder');
        $this->seed('CategorySeeder');
        $this->seed('GameSeeder');

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Games')
                ->click('button[id="add-3"')
                ->click('select[name="newQty"]')
                ->click('option[value="6"]')
                ->click('button[id="change"]')
                ->click('button[id="submit"]')
                ->assertSee('U moet eerst inloggen om een bestelling te plaatsen.')
                ->type('email', 'user@tcrmbo.nl')
                ->type('password', 'user')
                ->click('button[type="submit"]')
                ->assertSee('User')
                ->clickLink('Winkelwagen (6)')
                ->assertSee('Winkelwagen (6)')
                ->click('select[name="newQty"]')
                ->click('option[value="9"]')
                ->click('button[id="change"]')
                ->click('button[id="submit"]')
                ->assertSee('Bestelling Geplaatst')
                ->clickLink('Bestellingen')
                ->assertSee('Bestellingen')
                ->assertSee('9')
                ->click('a[href="/"]')
                ->clickLink('Logout')
                ->assertSee('Guest');
        });
    }
}
