<?php

namespace Tests\Feature\Games;

use App\Models\Category;
use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameStoreCheckTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed('RoleAndPermissionSeeder');
        $this->seed('UserSeeder');
        $this->seed('CategorySeeder');
        $this->seed('GameSeeder');

        $this->category = Category::factory()->create();
        $this->game = Game::factory()->create();
    }

    public function postGame($overrides = []) {
        $game = Game::factory()->make($overrides);

        return $this->postJson(route('games.store'), $game->toArray());
    }

    /**
     * @test
     * @group Game
     * @group GameStoreCheck
     */

    function a_game_requires_a_name() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postGame(['game' => NULL])->assertStatus(422);
    }

    /**
     * @test
     * @group Game
     * @group GameStoreCheck
     */

    function a_game_name_can_be_max_100_characters() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postGame(['game' => str_repeat('a', 101)])
            ->assertStatus(422);
    }

    /**
     * @test
     * @group Game
     * @group GameStoreCheck
     */

    function a_game_name_must_be_unique() {
        $admin = User::find(3);
        $game = Game::find(1);
        $this->actingAs($admin);
        $this->postGame(['game' => $game->game])->assertStatus(422);
    }

    /**
     * @test
     * @group Game
     * @group GameStoreCheck
     */

    function a_game_description_has_to_be_10_characters() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postGame(['description' => '0123'])->assertStatus(422);
    }

    /**
     * @test
     * @group Game
     * @group GameStoreCheck
     */

    function a_game_description_can_be_max_300_characters() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postGame(['description' => str_repeat('a', 301)])->assertStatus(422);
    }

    /**
     * @test
     * @group Game
     * @group GameStoreCheck
     */

    function a_game_requires_a_price() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postGame(['price' => NULL])->assertStatus(422);
    }

    /**
     * @test
     * @group Game
     * @group GameStoreCheck
     */

    function a_game_price_must_be_numeric() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postGame(['price' => 'abcdefg'])->assertStatus(422);
    }

    /**
     * @test
     * @group Game
     * @group GameStoreCheck
     */

    function a_game_price_can_max_be_999999_99() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postGame(['price' => 1000000.00])->assertStatus(422);
    }
}
