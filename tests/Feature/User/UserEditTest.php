<?php

use App\Models\Category;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

    $this->user = User::factory()->create();
});

test('admin can see the user edit page', function () {
    $this->withoutExceptionHandling();

    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('admin.users.edit', ['user' => $this->user->id]))
        ->assertViewIs('admin.users.edit')
        ->assertSee($this->user->name)
        ->assertSee($this->user->email)
        ->assertStatus(200);
})->group('User', 'UserEdit');

test('salesperson can not see the user edit page', function () {
    $salesperson = User::find(2);
    Laravel\be($salesperson)
        ->get(route('admin.users.edit', ['user' => $this->user->id]))
        ->assertStatus(403);
})->group('User', 'UserEdit');

test('user can not see the user edit page', function () {
    $user = User::find(1);
    Laravel\be($user)
        ->get(route('admin.users.edit', ['user' => $this->user->id]))
        ->assertStatus(403);
})->group('User', 'UserEdit');

test('guest can not see the user edit page', function () {
    $this->get(route('admin.users.edit', ['user' => $this->user->id]))
        ->assertStatus(403);
})->group('User', 'UserEdit');
