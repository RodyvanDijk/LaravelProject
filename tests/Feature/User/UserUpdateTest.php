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
    $newCategory = Category::factory()->create(['name' => 'TestCategory']);

    Laravel\be($admin)
        ->patchJson(route('users.update', ['user' => $this->user->id]),
        [ 'user' => 'abcdefg',
            'description' => 'hijklmnopqrstuvwxyz',
            'category_id' => $newCategory->id,
            'price' => 1
        ]
        );

    $this->user = $this->user->fresh();

    $this->get(route('users.index'))
        ->assertSee('abcdefg')
        ->assertSee(1)
        ->assertSee($newCategory->name);

    $this->get(route('users.index'))
        ->assertSee($this->user->user)
        ->assertSee($this->user->price)
        ->assertSee($this->user->category->name);

})->group('User', 'UserUpdate');

test('salesperson can update a user', function () {
    $salesperson = User::find(2);
    $newCategory = Category::factory()->create(['name' => 'TestCategory']);

    Laravel\be($salesperson)
        ->patchJson(route('users.update', ['user' => $this->user->id]),
            [ 'user' => 'abcdefg1',
                'description' => 'hijklmnopqrstuvwxyz1',
                'category_id' => $newCategory->id,
                'price' => 1
            ]
        );

    $this->user = $this->user->fresh();

    $this->get(route('users.index'))
        ->assertSee('abcdefg1')
        ->assertSee(1)
        ->assertSee($newCategory->name);

    $this->get(route('users.index'))
        ->assertSee($this->user->user)
        ->assertSee($this->user->price)
        ->assertSee($this->user->category->name);

})->group('User', 'UserUpdate');

test('user can not update a user', function () {
    $user = User::find(1);
    $user = User::factory()->make();

    Laravel\be($user)
        ->patchJson(route('users.update', ['user' => $this->user->id]), $user->toArray())
        ->assertForbidden();
})->group('User', 'UserUpdate');

test('guest can not update a user', function () {
    $user = User::factory()->make();

    $this->patchJson(route('users.update', ['user' => $this->user->id]), $user->toArray())
        ->assertForbidden();
})->group('User', 'UserUpdate');
