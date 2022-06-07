<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testMakesUser()
    {
        $this->seed('RoleAndPermissionSeeder');
        $this->seed('UserSeeder');

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Guest')
                ->clickLink('Login')
                ->assertSee('Email')
                ->type('email', 'admin@tcrmbo.nl')
                ->type('password', 'admin')
                ->click('button[type="submit"]')
                ->assertSee('Admin')
                ->clickLink('User List')
                ->assertSee('User Admin')
                ->clickLink('User Toevoegen')
                ->assertSee('Account Naam:')
                ->type('name', 'Test')
                ->type('email', 'test@tcrmbo.nl')
                ->type('password', 'testtest')
                ->click('select[name="role"]')
                ->click('option[value="salesperson"]')
                ->click('button[id="submit"]')
                ->assertSee('User Admin')
                ->assertSee('Test')
                ->click('a[id="user-edit-5"]')
                ->type('name', 'Test1')
                ->type('email', 'test1@tcrmbo.nl')
                ->click('select[name="role"]')
                ->click('option[value="user"]')
                ->click('button[id="submit"]')
                ->assertSee('User Gewijzigd')
                ->click('a[id="user-detail-5"]')
                ->assertSee('User Details')
                ->assertSee('Test1')
                ->assertSee('User')
                ->clickLink('Overzicht User')
                ->assertSee('Edit')
                ->assertSee('Delete')
                ->click('a[id="user-delete-5"]')
                ->assertSee('Verwijderen')
                ->click('button[id="submit"]')
                ->assertSee('User Verwijderd')
                ->click('a[href="/"]')
                ->clickLink('Logout')
                ->assertSee('Guest');
        });
    }
}
