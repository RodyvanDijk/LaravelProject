<?php

use App\Models\Category;
use App\Models\User;
use \pest\laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->seed('CategorySeeder');

    $this->category = Category::factory()->create(['name' => 'TestCategory1']);


});
test('admin can update a category in the category admin', function () {
    $admin = User::find(3);
    $category = Category::factory()->make(['name' => 'TestCategory']);

laravel\be($admin)
   ->patchJson(route('category.update',['category' => $this->category->id]), $category->toArray())
        ->assertRedirect(route('category.index'));

    $this->assertDatabaseHas('categories',[
        'id' => $this->category->id,
        'name' => 'TestCategory'

    ]);

})->group('CategoryUpdate', 'CategoryTests');


test('salesperson can create a category in the category admin', function () {
    $salesperson = User::find(2);
    $category = Category::factory()->make(['name' => 'TestCategory']);

    $admin = User::find(3);
    $category = Category::factory()->make(['name' => 'TestCategory']);

    laravel\be($salesperson)
        ->patchJson(route('category.update',['category' => $this->category->id]), $category->toArray())
        ->assertRedirect(route('category.index'));

    $this->assertDatabaseHas('categories',[
        'id' => $this->category->id,
        'name' => 'TestCategory'

    ]);

})->group('CategoryUpdate', 'CategoryTests');

test('user can not create a category in the category admin', function () {
    $user = User::find(1);
    $category = Category::factory()->make(['name' => 'TestCategory']);



    laravel\be($user)
        ->patchJson(route('category.update',['category' => $this->category->id]), $category->toArray())
        ->assertForbidden();


})->group('CategoryUpdate', 'CategoryTests');

test('guest can not create a category in the category admin', function () {

    $category = Category::factory()->make(['name' => 'TestCategory']);

    $admin = User::find(3);
    $category = Category::factory()->make(['name' => 'TestCategory']);


        $this->patchJson(route('category.update',['category' => $this->category->id]), $category->toArray())
        ->assertForbidden();


})->group('CategoryUpdate', 'CategoryTests');
