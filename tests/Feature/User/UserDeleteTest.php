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

test('admin can see the users delete page', function () {
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('users.delete', ['user' => $this->user->id]))
        ->assertViewIs('admin.users.delete')
        ->assertSee($this->user->user)
        ->assertSee($this->user->description)
        ->assertSee($this->user->category->name)
        ->assertSee(round($this->user->price))
        ->assertStatus(200);

})->group('User', 'UserDelete');

test('salesperson can see the users delete page', function () {
    $salesperson = User::find(2);
    Laravel\be($salesperson)
        ->get(route('users.delete', ['user' => $this->user->id]))
        ->assertViewIs('admin.users.delete')
        ->assertSee($this->user->user)
        ->assertSee($this->user->description)
        ->assertSee($this->user->category->name)
        ->assertSee(round($this->user->price))
        ->assertStatus(200);

})->group('User', 'UserDelete');


test('user can not see the users delete page', function () {
    $user = User::find(1);
    Laravel\be($user)
        ->get(route('users.delete', ['user' => $this->user->id]))
        ->assertStatus(403);
})->group('User', 'UserDelete');

test('guest can not see the users delete page', function () {
    $this->get(route('users.delete', ['user' => $this->user->id]))
        ->assertStatus(403);
})->group('User', 'UserDelete');
