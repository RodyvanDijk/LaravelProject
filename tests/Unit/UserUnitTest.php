<?php

use App\Models\User;
use Carbon\Carbon;

beforeEach(function () {

    $this->User = User::factory()->create();
});

// checks if the User ID is a int in the database
test('User ID is a INT', function () {
    expect($this->User->id)->toBeInt();
})->group('UserUnitTests', 'UserTests');

// checks if the name is a string in the database
test('User Name is a string', function () {
    expect($this->User->name)->toBeString();
})->group('UserUnitTests', 'UserTests');

test('User email is a string', function () {
    expect($this->User->email)->toBeString();
})->group('UserUnitTests', 'UserTests');

test('User password is a string', function () {
    expect($this->User->password)->toBeString();
})->group('UserUnitTests', 'UserTests');

test('User remember_token is a string', function () {
    expect($this->User->remember_token)->toBeString();
})->group('UserUnitTests', 'UserTests');



// checks if the created_at is a DatTime in the database
test('email_verified_at is a DateTime', function () {
    expect($this->User->email_verified_at)->toBeInstanceOf(Carbon::class);
})->group('UserUnitTests', 'UserTests');

// checks if the created_at is a DatTime in the database
test('User create_at is a DateTime', function () {
    expect($this->User->created_at)->toBeInstanceOf(Carbon::class);
})->group('UserUnitTests', 'UserTests');

// checks if the updated_at is a DatTime in the database
test('User updated_at is a DateTime', function () {
    expect($this->User->updated_at)->toBeInstanceOf(Carbon::class);
})->group('UserUnitTests', 'UserTests');
