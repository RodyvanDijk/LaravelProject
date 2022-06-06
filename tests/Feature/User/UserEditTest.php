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

test('admin can see the users edit page', function () {
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('users.edit', ['user' => $this->user->id]))
        ->assertViewIs('admin.users.edit')
        ->assertSee($this->user->user)
        ->assertSee($this->user->description)
        ->assertSee($this->user->category->name)
        ->assertSee(round($this->user->price))
        ->assertStatus(200);
})->group('User', 'UserEdit');

test('salesperson can see the users edit page', function () {
    $salesperson = User::find(2);
    Laravel\be($salesperson)
        ->get(route('users.edit', ['user' => $this->user->id]))
        ->assertViewIs('admin.users.edit')
        ->assertSee($this->user->user)
        ->assertSee($this->user->description)
        ->assertSee($this->user->category->name)
        ->assertSee(round($this->user->price))
        ->assertStatus(200);
})->group('User', 'UserEdit');

test('user can not see the users edit page', function () {
    $user = User::find(1);
    Laravel\be($user)
        ->get(route('users.edit', ['user' => $this->user->id]))
        ->assertStatus(403);
})->group('User', 'UserEdit');

test('guest can not see the users edit page', function () {
    $this->get(route('users.edit', ['user' => $this->user->id]))
        ->assertStatus(403);
})->group('User', 'UserEdit');
