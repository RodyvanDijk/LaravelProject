<?php

use App\Models\Category;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

    $this->category = Category::factory()->create();
    $this->user = User::factory()->create();
});

function patchUser($overridesUser = []) {
    $user = User::find(1)->make($overridesUser);

    return Laravel\patchJson(route('users.update', ['user' => 1]), $user->toArray());
}


test('a user requires a name', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchUser(['user' => null])
        ->assertStatus(422);

})->group('User', 'UserUpdateCheck');

test('a user name can be max 100 characters', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchUser(['user' => str_repeat('a', 101)])
        ->assertStatus(422);

})->group('User', 'UserUpdateCheck');

test('a user name must be unique', function () {
    $admin = User::find(3);
    $user = User::factory()->create(['user' => 'user1']);

    Laravel\be($admin);
    patchUser(['user' => 'user1'])
        ->assertStatus(422);

})->group('User', 'UserUpdateCheck');

test('a user description has to be 10 characters', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchUser(['description' => '0123'])
        ->assertStatus(422);

})->group('User', 'UserUpdateCheck');

test('a user description can be max 300 characters', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchUser(['description' => str_repeat('a', 301)])
        ->assertStatus(422);

})->group('User', 'UserUpdateCheck');

test('a user requires a price', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchUser(['price' => null])
        ->assertStatus(422);

})->group('User', 'UserUpdateCheck');

test('a user price must be numeric', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchUser(['price' => 'abcdefg'])
        ->assertStatus(422);

})->group('User', 'UserUpdateCheck');

test('a user price can be max 999999.99', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchUser(['price' => 1000000.00])
        ->assertStatus(422);

})->group('User', 'UserUpdateCheck');
