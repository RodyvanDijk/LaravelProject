<?php


use App\Models\User;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');


});


test('admin can go to user create', function () {
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin)
        ->get('/user/create')
        ->assertStatus(200);
})->group('exampleFeature');

test('salesperson can not go to user create', function () {

    $salesperson = User::find(2);
    Laravel\be($salesperson)
        ->get('/user/create')
        ->assertStatus(403);
})->group('exampleFeature');



