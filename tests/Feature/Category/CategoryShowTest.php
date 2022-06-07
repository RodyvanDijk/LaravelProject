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
test('admin can see the category admin show page', function()
{
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('category.show', ['category' => $this->category->id]))
        ->assertViewIs('admin.categories.show')
        ->assertSee($this->category->id)
        ->assertStatus(200);

})->group( 'CategoryShow', 'CategoryTests');

test('salesperson can see the category salesperson show page', function()
{
    $salesperson = User::find(2);
    Laravel\be($salesperson)
        ->get(route('category.show', ['category' => $this->category->id]))
        ->assertViewIs('admin.categories.show')
        ->assertSee($this->category->id)
        ->assertStatus(200);

})->group( 'CategoryShow', 'CategoryTests');

test('guest can not see the category guest show page', function()
{
    $guest = User::find(1);
    Laravel\be($guest)
        ->get(route('category.show', ['category' => $this->category->id]))

        ->assertForbidden();

})->group( 'CategoryShow', 'CategoryTests');

test('guest can not see the category admin show page', function()
{

      $this->get(route('category.show', ['category' => $this->category->id]))

        ->assertForbidden();

})->group( 'CategoryShow', 'CategoryTests');



