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

test('admin can destroy a user', function () {
    $admin = User::find(3);
    Laravel\be($admin);
    $this->json('DELETE', route('users.destroy', ['user' => $this->user->id]));
    $this->assertDatabaseMissing('users', ['id' => $this->user->id]);

})->group('User', 'UserDestroy');

test('salesperson can destroy a user', function () {
    $salesperson = User::find(3);
    Laravel\be($salesperson);
    $this->json('DELETE', route('users.destroy', ['user' => $this->user->id]));
    $this->assertDatabaseMissing('users', ['id' => $this->user->id]);

})->group('User', 'UserDestroy');

test('user can not destroy a user', function () {
    $user = User::find(1);
    Laravel\be($user);
    $this->json('DELETE', route('users.destroy', ['user' => $this->user->id]))
        ->assertForbidden();

})->group('User', 'UserDestroy');

test('guest can not destroy a user', function () {
    $this->json('DELETE', route('users.destroy', ['user' => $this->user->id]))
        ->assertForbidden();

})->group('User', 'UserDestroy');
