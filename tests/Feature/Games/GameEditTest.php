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

test('admin can see the games edit page', function () {
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('games.edit', ['game' => $this->game->id]))
        ->assertViewIs('admin.games.edit')
        ->assertSee($this->game->game)
        ->assertSee($this->game->description)
        ->assertSee($this->game->category->name)
        ->assertSee(round($this->game->price))
        ->assertStatus(200);
})->group('Game', 'GameEdit');

test('salesperson can see the games edit page', function () {
    $salesperson = User::find(2);
    Laravel\be($salesperson)
        ->get(route('games.edit', ['game' => $this->game->id]))
        ->assertViewIs('admin.games.edit')
        ->assertSee($this->game->game)
        ->assertSee($this->game->description)
        ->assertSee($this->game->category->name)
        ->assertSee(round($this->game->price))
        ->assertStatus(200);
})->group('Game', 'GameEdit');

test('user can not see the games edit page', function () {
    $user = User::find(1);
    Laravel\be($user)
        ->get(route('games.edit', ['game' => $this->game->id]))
        ->assertStatus(403);
})->group('Game', 'GameEdit');

test('guest can not see the games edit page', function () {
    $this->get(route('games.edit', ['game' => $this->game->id]))
        ->assertStatus(403);
})->group('Game', 'GameEdit');
