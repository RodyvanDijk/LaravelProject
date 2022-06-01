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
test('admin can see the category admin edit page', function() {

    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('category.edit', ['category' => $this->category->id]))
        ->assertViewIs('admin.categories.edit')
        ->assertSee($this->category->name)
        ->assertStatus(200);

})->group('CategoryEdit', 'CategoryTests');

test('salesperson can see the category admin edit page', function() {

    $salesperson = User::find(2);
    Laravel\be($salesperson)
        ->get(route('category.edit', ['category' => $this->category->id]))
        ->assertViewIs('admin.categories.edit')
        ->assertSee($this->category->name)
        ->assertStatus(200);

})->group('CategoryEdit', 'CategoryTests');
test('user can not see the category user edit page', function() {

    $user = User::find(1);
    Laravel\be($user)
        ->get(route('category.edit', ['category' => $this->category->id]))
        ->assertForbidden();

})->group('CategoryEdit', 'CategoryTests');


test('guest can not see the category user edit page', function() {

        $this->get(route('category.edit', ['category' => $this->category->id]))

        ->assertForbidden();

})->group('CategoryEdit', 'CategoryTests');
