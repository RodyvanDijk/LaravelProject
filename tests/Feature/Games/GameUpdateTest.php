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

test('admin can update a game', function () {
    $admin = User::find(3);
    $newCategory = Category::factory()->create(['name' => 'TestCategory']);

    Laravel\be($admin)
        ->patchJson(route('games.update', ['game' => $this->game->id]),
        [ 'game' => 'abcdefg',
            'description' => 'hijklmnopqrstuvwxyz',
            'category_id' => $newCategory->id,
            'price' => 1
        ]
        );

    $this->game = $this->game->fresh();

    $this->get(route('games.index'))
        ->assertSee('abcdefg')
        ->assertSee(1)
        ->assertSee($newCategory->name);

    $this->get(route('games.index'))
        ->assertSee($this->game->game)
        ->assertSee($this->game->price)
        ->assertSee($this->game->category->name);

})->group('Game', 'GameUpdate');

test('salesperson can update a game', function () {
    $salesperson = User::find(2);
    $newCategory = Category::factory()->create(['name' => 'TestCategory']);

    Laravel\be($salesperson)
        ->patchJson(route('games.update', ['game' => $this->game->id]),
            [ 'game' => 'abcdefg1',
                'description' => 'hijklmnopqrstuvwxyz1',
                'category_id' => $newCategory->id,
                'price' => 1
            ]
        );

    $this->game = $this->game->fresh();

    $this->get(route('games.index'))
        ->assertSee('abcdefg1')
        ->assertSee(1)
        ->assertSee($newCategory->name);

    $this->get(route('games.index'))
        ->assertSee($this->game->game)
        ->assertSee($this->game->price)
        ->assertSee($this->game->category->name);

})->group('Game', 'GameUpdate');

test('user can not update a game', function () {
    $user = User::find(1);
    $game = Game::factory()->make();

    Laravel\be($user)
        ->patchJson(route('games.update', ['game' => $this->game->id]), $game->toArray())
        ->assertForbidden();
})->group('Game', 'GameUpdate');

test('guest can not update a game', function () {
    $game = Game::factory()->make();

    $this->patchJson(route('games.update', ['game' => $this->game->id]), $game->toArray())
        ->assertForbidden();
})->group('Game', 'GameUpdate');
