<?php

use App\Models\Category;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
});

test('admin can see the user create page', function () {
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('admin.users.create'))
        ->assertViewIs('admin.users.create')
        ->assertStatus(200);
})->group('User', 'UserCreate');

test('salesperson can not see the user create page', function () {
    $salesperson = User::find(2);
    Laravel\be($salesperson)
        ->get(route('admin.users.create'))
        ->assertStatus(403);
})->group('User', 'UserCreate');

test('user can not see the user create page', function () {
    $user = User::find(1);
    Laravel\be($user)
        ->get(route('admin.users.create'))
        ->assertStatus(403);
})->group('User', 'UserCreate');

test('guest can not see the user create page', function () {
    $this->get(route('admin.users.create'))
        ->assertStatus(403);
})->group('User', 'UserCreate');
