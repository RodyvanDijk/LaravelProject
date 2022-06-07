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

test('admin can see the category admin create page', function()
{
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('category.create'))
        ->assertViewIs('admin.categories.create')


        ->assertStatus(200);
})->group( 'CategoryTests');

test('Salesperson can see the category admin create page', function()
{
    $this->withoutExceptionHandling();
    $admin = User::find(2);
    Laravel\be($admin)
        ->get(route('category.create'))
        ->assertViewIs('admin.categories.create')


        ->assertStatus(200);
})->group( 'CategoryTests');
test('user can not see the category admin create page', function()
{

    $user = User::find(1);
    Laravel\be($user)
        ->get(route('category.create'))
        ->assertForbidden();




})->group( 'CategoryTests');

test('guest can not see the category admin create page', function()
{

        $this->get(route('category.create'))
            ->assertForbidden();






})->group( 'CategoryTests');
