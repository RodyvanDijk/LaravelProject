<?php


use App\Models\Category;
use App\Models\User;
use \pest\laravel;

beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

    $this->category1 = Category::factory()->create(['name' => '123456789']);
    $this->category2 = Category::factory()->create(['name' => '1234567890']);

});

test('the category name can only be 100 characters max', function () {
    $admin = User::find(3);
    $category = Category::factory()->make(['name' => '1234567890.1234567890.1234567890.1234567890.1234567890.1234567890.1234567890.1234567890.1234567890.1234567890']);

    Laravel\be($admin)
        ->patchJson(route('category.update',['category' => $this->category1->id]), $category->toArray())
        ->assertStatus(422);
})->group('CategoryUpdate', 'CategoryTests');

test('the category needs a name', function () {
    $admin = User::find(3);
    $category = Category::factory()->make(['name' => null]);

    Laravel\be($admin)
        ->patchJson(route('category.update',['category' => $this->category1->id]), $category->toArray())
        ->assertStatus(422);
})->group('CategoryUpdate', 'CategoryTests');

test('the category name needs to be unique', function () {
    $admin = User::find(3);
    $category = Category::factory()->make(['name' => '1234567890']);

    Laravel\be($admin)
        ->patchJson(route('category.update',['category' => $this->category1->id]), $category->toArray())
        ->assertStatus(422);
})->group('CategoryUpdate', 'CategoryTests');
