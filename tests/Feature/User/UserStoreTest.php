<?php

use App\Models\Category;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
});

test('admin can create a user', function () {
    $admin = User::find(3);
    $newUser = User::factory()->make();

    Laravel\be($admin)
        ->postJson(route('user.store'), array_merge($newUser->toArray(), ['password' => 'password']))
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseHas('users', [
        'name' => $newUser->name,
        'email' => $newUser->email
    ]);
})->group('User', 'UserStore');

test('salesperson can create a user', function () {
    $salesperson = User::find(2);
    $newUser = User::factory()->make();

    Laravel\be($salesperson)
        ->postJson(route('user.store'), array_merge($newUser->toArray(), ['password' => 'password']))
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseHas('users', [
        'name' => $newUser->name,
        'email' => $newUser->email
    ]);
})->group('User', 'UserStore');

test('user can create a user', function () {
    $user = User::find(1);
    $newUser = User::factory()->make();

    Laravel\be($user)
        ->postJson(route('user.store'), array_merge($newUser->toArray(), ['password' => 'password']))
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseHas('users', [
        'name' => $newUser->name,
        'email' => $newUser->email
    ]);
})->group('User', 'UserStore');

test('guest can create a user', function () {
    $newUser = User::factory()->make();

    $this->postJson(route('user.store'), array_merge($newUser->toArray(), ['password' => 'password']))
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseHas('users', [
        'name' => $newUser->name,
        'email' => $newUser->email
    ]);
})->group('User', 'UserStore');
