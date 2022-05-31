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

test('admin can see the games page', function () {
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('games.index'))
        ->assertViewIs('admin.games.index')
        ->assertSee($this->game->game)
        ->assertSee($this->game->category->name)
        ->assertSee(round($this->game->price))
        ->assertStatus(200);
})->group('Game', 'GameIndex');

test('salesperson can see the games page', function () {
    $salesperson = User::find(2);
    Laravel\be($salesperson)
        ->get(route('games.index'))
        ->assertViewIs('admin.games.index')
        ->assertSee($this->game->game)
        ->assertSee($this->game->category->name)
        ->assertSee(round($this->game->price))
        ->assertStatus(200);
})->group('Game', 'GameIndex');

test('user can not see the games page', function () {
    $user = User::find(1);
    Laravel\be($user)
        ->get(route('games.index'))
        ->assertForbidden();
})->group('Game', 'GameIndex');
