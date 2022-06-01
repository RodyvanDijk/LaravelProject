<?php


use App\Models\Category;
use App\Models\User;
use \pest\laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->seed('CategorySeeder');
    $this->category = Category::factory()->create();
    $this->category = Category::factory()->create(['name' => '123456789']);

});

test('the category name can only be 100 characters max', function () {
    $admin = User::find(3);
    $category = Category::factory()->make(['name' => '1234567890.1234567890.1234567890.1234567890.1234567890.1234567890.1234567890.1234567890.1234567890.1234567890']);

    Laravel\be($admin)
        ->postJson(route('category.store'), $category->toArray())
        ->assertStatus(422);
})->group( 'CategoryStore', 'CategoryTests');

test('the category needs a name', function () {
    $admin = User::find(3);
    $category = Category::factory()->make(['name' => null]);

    Laravel\be($admin)
        ->postJson(route('category.store'), $category->toArray())
        ->assertStatus(422);
})->group( 'CategoryStore', 'CategoryTests');

test('the category name needs to be unique', function () {
    $admin = User::find(3);
    $category = Category::factory()->make(['name' => '123456789']);

    Laravel\be($admin)
        ->postJson(route('category.store'), $category->toArray())
        ->assertStatus(422);
})->group( 'CategoryStore', 'CategoryTests');

