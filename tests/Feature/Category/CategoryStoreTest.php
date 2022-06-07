<?php

use App\Models\Category;
use App\Models\User;
use \pest\laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->seed('CategorySeeder');
    $this->category = Category::factory()->create();


});
test('admin can create a category in the category admin', function () {
    $admin = User::find(3);
    $category = Category::factory()->make(['name' => 'TestCategory']);

    laravel\be($admin)
        ->postJson(route('category.store'), $category->toArray())
        ->assertRedirect(route('category.index'));

    $this->assertDatabaseHas('categories', [
        'name' => 'TestCategory'
    ]);
})->group('CategoryStore', 'CategoryTests');


test('salesperson can create a category in the category admin', function () {
    $salesperson = User::find(2);
    $category = Category::factory()->make(['name' => 'TestCategory']);

    laravel\be($salesperson)
        ->postJson(route('category.store'), $category->toArray())
        ->assertRedirect(route('category.index'));

    $this->assertDatabaseHas('categories', [
        'name' => 'TestCategory'
    ]);
})->group('CategoryStore', 'CategoryTests');

test('user can not create a category in the category admin', function () {
    $user = User::find(1);
    $category = Category::factory()->make(['name' => 'TestCategory']);

    laravel\be($user)
        ->postJson(route('category.store'), $category->toArray())
        ->assertForbidden();


})->group('CategoryStore', 'CategoryTests');

test('guest can not create a category in the category admin', function () {

    $category = Category::factory()->make(['name' => 'TestCategory']);


        $this->postJson(route('category.store'), $category->toArray())
        ->assertForbidden();


})->group('CategoryStore', 'CategoryTests');


