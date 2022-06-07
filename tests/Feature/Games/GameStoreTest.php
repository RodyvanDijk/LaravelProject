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

test('admin can create a game', function () {
    $admin = User::find(3);
    $game = Game::factory()->make();

    Laravel\be($admin)
        ->postJson(route('games.store'), $game->toArray())
        ->assertRedirect(route('games.index'));

    $this->assertDatabaseHas('games', [
        'game' => $game->game,
        'description' => $game->description,
        'category_id' => $game->category_id,
        'price' => round($game->price)
    ]);
})->group('Game', 'GameStore');

test('salesperson can create a game', function () {
    $salesperson = User::find(2);
    $game = Game::factory()->make();

    Laravel\be($salesperson)
        ->postJson(route('games.store'), $game->toArray())
        ->assertRedirect(route('games.index'));

    $this->assertDatabaseHas('games',[
        'game' => $game->game,
        'description' => $game->description,
        'category_id' => $game->category_id,
        'price' => round($game->price)
    ]);
})->group('Game', 'GameStore');

test('user can not create a game', function () {
    $user = User::find(1);
    Laravel\be($user)
        ->postJson(route('games.store'))
        ->assertForbidden();
})->group('Game', 'GameStore');

test('guest can not create a game', function () {
    $this->postJson(route('games.store'))
        ->assertForbidden();
})->group('Game', 'GameStore');
