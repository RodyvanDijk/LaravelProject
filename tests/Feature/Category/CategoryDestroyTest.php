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


test('an admin can delete a Category in the Category admin', function () {

    $admin = User::find(3);
    Laravel\be($admin);

    $this->json('DELETE', route('category.destroy',['category' => $this->category->id]))
        ->assertRedirect(route('category.index'));

    $this->assertDatabaseMissing('categories',['id' => $this->category->id]);
})->group('CategoryDestroy', 'CategoryTests');

test('an salesperson can delete a Category in the Category admin', function () {

    $salesperson = User::find(2);
    Laravel\be($salesperson);

    $this->json('DELETE', route('category.destroy',['category' => $this->category->id]))
        ->assertRedirect(route('category.index'));

    $this->assertDatabaseMissing('categories',['id' => $this->category->id]);
})->group('CategoryDestroy', 'CategoryTests');

test('an user can not delete a Category in the Category admin', function () {

    $admin = User::find(1);
    Laravel\be($admin);

    $this->json('DELETE', route('category.destroy',['category' => $this->category->id]))
        ->assertForbidden();


})->group('CategoryDestroy', 'CategoryTests');

test('an guest can not delete a Category in the Category admin', function () {



    $this->json('DELETE', route('category.destroy',['category' => $this->category->id]))
        ->assertForbidden();


})->group('CategoryDestroy', 'CategoryTests');


