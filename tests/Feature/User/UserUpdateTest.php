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

test('admin can update a user', function () {
    $admin = User::find(3);

    Laravel\be($admin)
        ->patchJson(route('user.update', ['user' => $this->user->id]),
        [ 'name' => 'abcdefg',
            'email' => 'email1@email.nl',
            'password' => 'pazzword',
        ]
        );

    $this->user = $this->user->fresh();

    $this->get(route('user.index'))
        ->assertSee('abcdefg')
        ->assertSee('email1@email.nl');

    $this->get(route('user.index'))
        ->assertSee($this->user->name)
        ->assertSee($this->user->email);

})->group('User', 'UserUpdate');

test('salesperson can not update a user', function () {
    $salesperson = User::find(2);
    $newUser = User::factory()->make();

    Laravel\be($salesperson)
        ->patchJson(route('user.update', ['user' => $this->user->id]), $newUser->toArray())
        ->assertForbidden();

})->group('User', 'UserUpdate');

test('user can not update a user', function () {
    $user = User::find(1);
    $newUser = User::factory()->make();

    Laravel\be($user)
        ->patchJson(route('user.update', ['user' => $this->user->id]), $newUser->toArray())
        ->assertForbidden();
})->group('User', 'UserUpdate');

test('guest can not update a user', function () {
    $newUser = User::factory()->make();

    $this->patchJson(route('user.update', ['user' => $this->user->id]), $newUser->toArray())
        ->assertForbidden();
})->group('User', 'UserUpdate');
