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

test('admin can destroy a game', function () {
    $admin = User::find(3);
    Laravel\be($admin);
    $this->json('DELETE', route('games.destroy', ['game' => $this->game->id]));
    $this->assertDatabaseMissing('games', ['id' => $this->game->id]);

})->group('Game', 'GameDestroy');

test('salesperson can destroy a game', function () {
    $salesperson = User::find(3);
    Laravel\be($salesperson);
    $this->json('DELETE', route('games.destroy', ['game' => $this->game->id]));
    $this->assertDatabaseMissing('games', ['id' => $this->game->id]);

})->group('Game', 'GameDestroy');

test('user can not destroy a game', function () {
    $user = User::find(1);
    Laravel\be($user);
    $this->json('DELETE', route('games.destroy', ['game' => $this->game->id]))
        ->assertForbidden();

})->group('Game', 'GameDestroy');

test('guest can not destroy a game', function () {
    $this->json('DELETE', route('games.destroy', ['game' => $this->game->id]))
        ->assertForbidden();

})->group('Game', 'GameDestroy');
