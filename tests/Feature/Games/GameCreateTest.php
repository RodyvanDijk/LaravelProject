<?php

use App\Models\Category;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

    $this->category = Category::factory()->create();
});

test('admin can see the games create page', function () {
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('games.create'))
        ->assertViewIs('admin.games.create')
        ->assertStatus(200);
})->group('Game', 'GameCreate');

test('salesperson can see the games create page', function () {
    $salesperson = User::find(2);
    Laravel\be($salesperson)
        ->get(route('games.create'))
        ->assertViewIs('admin.games.create')
        ->assertStatus(200);
})->group('Game', 'GameCreate');

test('user can not see the games create page', function () {
    $user = User::find(1);
    Laravel\be($user)
        ->get(route('games.create'))
        ->assertStatus(403);
})->group('Game', 'GameCreate');

test('guest can not see the games create page', function () {
    $this->get(route('games.create'))
        ->assertStatus(403);
})->group('Game', 'GameCreate');
