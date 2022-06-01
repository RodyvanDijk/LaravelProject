<?php

use App\Models\Category;
use App\Models\User;
use \Pest\Laravel;


beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->seed('CategorySeeder');
    $this->category = Category::factory()->create();

});

test('admin can see the category admin index page', function() {

    $admin = User::find(3);
    Laravel\be($admin)
         ->get(route('category.index'))
        ->assertViewIs('admin.categories.index')
        ->assertSee($this->category->name)
        ->assertStatus(200);

})->group('CategoryIndex', 'CategoryTests');

test('salesperson can see the category admin index page', function() {

    $salesperson = User::find(2);
    Laravel\be($salesperson)
        ->get(route('category.index'))
        ->assertViewIs('admin.categories.index')
        ->assertSee($this->category->name)
        ->assertStatus(200);

})->group('CategoryIndex', 'CategoryTests');
test('user can not see the category user index page', function() {

    $user = User::find(1);
    Laravel\be($user)
      ->get(route('category.index'))
        ->assertForbidden();

})->group('CategoryIndex', 'CategoryTests');


test('guest can not see the category user index page', function() {

    $this->get(route('category.index'))

        ->assertForbidden();

})->group('CategoryIndex', 'CategoryTests');

