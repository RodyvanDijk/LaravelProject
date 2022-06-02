<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;

use Tests\DuskTestCase;

class CategoryTest extends DuskTestCase
{


   /**
 * A basic browser test example.
 *
 * @return void
 */
    public function testCategoryIndex()
    {

        /**
         * A basic browser test example.
         *
         *
         */
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->typeSlowly('email', 'admin@tcrmbo.nl')
                ->typeSlowly('password', 'admin')
                ->click('button[type="submit"]');

            $browser->visit('/admin/category')
                ->assertSee('Categories');
        });

    }
    public function testCategoryCreate()
    {

        /**
         * A basic browser test example.
         *
         *
         */
        $this->browse(function (Browser $browser) {


            $browser->visit('admin/category/create')
                ->typeSlowly('name', 'admin@tcrmbo.nl')
                ->click('button[id="create"]')
                ->assertSee('Categorie Aangemaakt');
        });

    }

    public function testCategoryEdit()
    {

        /**
         * A basic browser test example.
         *
         *
         */
        $this->browse(function (Browser $browser) {


            $browser->visit('/admin/category')
                ->click('a[id="edit-6"]')
                ->typeSlowly('name', 'admin@tcrmbo1.nl')
                ->click('button[id="update"')
                ->assertSee('Categorie Gewijzigd');
        });

    }

    public function testCategoryShow()
    {

        /**
         * A basic browser test example.
         *
         *
         */
        $this->browse(function (Browser $browser) {


            $browser->visit('/admin/category')
                ->click('a[id="show-6"]')
                ->assertSee('Admin@Tcrmbo1.Nl');


        });
    }

        public function testCategoryDelete()
        {

            /**
             * A basic browser test example.
             *
             *
             */
            $this->browse(function (Browser $browser) {


                $browser->visit('/admin/category')
                    ->click('a[id="delete-6"]')
                    ->click('button[id="delete"')
                    ->assertSee('Categorie Verwijderd');
            });

        }



}
