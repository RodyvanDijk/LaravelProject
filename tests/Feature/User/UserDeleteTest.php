<?php

use App\Models\Category;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

    $this->user = User::factory()->create();
});

test('admin can see the user delete page', function () {
    $this->withoutExceptionHandling();

    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('admin.users.delete', ['user' => $this->user->id]))
        ->assertViewIs('admin.users.delete')
        ->assertSee($this->user->name)
        ->assertSee($this->user->email)
        ->assertStatus(200);

})->group('User', 'UserDelete');

test('salesperson can see the user delete page', function () {
    $salesperson = User::find(2);
    Laravel\be($salesperson)
        ->get(route('admin.users.delete', ['user' => $this->user->id]))
        ->assertStatus(403);

})->group('User', 'UserDelete');


test('user can not see the user delete page', function () {
    $user = User::find(1);
    Laravel\be($user)
        ->get(route('admin.users.delete', ['user' => $this->user->id]))
        ->assertStatus(403);
})->group('User', 'UserDelete');

test('guest can not see the user delete page', function () {
    $this->get(route('admin.users.delete', ['user' => $this->user->id]))
        ->assertStatus(403);
})->group('User', 'UserDelete');
