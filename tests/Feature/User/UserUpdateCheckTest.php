<?php

use App\Models\Category;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

    $this->category = Category::factory()->create();
    $this->user = User::factory()->create();
});

function patchUser($overridesUser = []) {
    $user = User::find(1)->make($overridesUser);

    return Laravel\patchJson(route('user.update', ['user' => 1]), $user->toArray());
}


test('a user requires a name', function () {
    $admin = User::find(3);

    Laravel\be($admin);
    patchUser(['user' => null])
        ->assertStatus(500);

})->group('User', 'UserUpdateCheck');

