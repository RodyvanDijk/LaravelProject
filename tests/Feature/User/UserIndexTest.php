<?php

use App\Models\Category;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

    $this->user = User::factory()->create();
});

test('admin can see the user page', function () {
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('admin.users.index'))
        ->assertViewIs('admin.users.index')
        ->assertSee($this->user->name)
        ->assertSee($this->user->email)
        ->assertStatus(200);
})->group('User', 'UserIndex');

test('salesperson can not see the user page', function () {
    $salesperson = User::find(2);
    Laravel\be($salesperson)
        ->get(route('admin.users.index'))
        ->assertForbidden();
})->group('User', 'UserIndex');

test('user can not see the user page', function () {
    $user = User::find(1);
    Laravel\be($user)
        ->get(route('admin.users.index'))
        ->assertForbidden();
})->group('User', 'UserIndex');

test('guest can not see the user page', function () {
    $this->get(route('admin.users.index'))
        ->assertForbidden();
})->group('User', 'UserIndex');
