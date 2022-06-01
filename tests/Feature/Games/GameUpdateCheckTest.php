<?php

use App\Models\Category;
use App\Models\Game;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

    $this->category = Category::factory()->create();
    $this->game = Game::factory()->create();
});

function patchGame($overridesGame = []) {
    $game = Game::find(1)->make($overridesGame);

    return Laravel\patchJson(route('games.update', ['game' => 1]), $game->toArray());
}


test('a game requires a name', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchGame(['game' => null])
        ->assertStatus(422);

})->group('Game', 'GameUpdateCheck');

test('a game name can be max 100 characters', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchGame(['game' => str_repeat('a', 101)])
        ->assertStatus(422);

})->group('Game', 'GameUpdateCheck');

test('a game name must be unique', function () {
    $admin = User::find(3);
    $game = Game::factory()->create(['game' => 'game1']);

    Laravel\be($admin);
    patchGame(['game' => 'game1'])
        ->assertStatus(422);

})->group('Game', 'GameUpdateCheck');

test('a game description has to be 10 characters', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchGame(['description' => '0123'])
        ->assertStatus(422);

})->group('Game', 'GameUpdateCheck');

test('a game description can be max 300 characters', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchGame(['description' => str_repeat('a', 301)])
        ->assertStatus(422);

})->group('Game', 'GameUpdateCheck');

test('a game requires a price', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchGame(['price' => null])
        ->assertStatus(422);

})->group('Game', 'GameUpdateCheck');

test('a game price must be numeric', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchGame(['price' => 'abcdefg'])
        ->assertStatus(422);

})->group('Game', 'GameUpdateCheck');

test('a game price can be max 999999.99', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchGame(['price' => 1000000.00])
        ->assertStatus(422);

})->group('Game', 'GameUpdateCheck');
