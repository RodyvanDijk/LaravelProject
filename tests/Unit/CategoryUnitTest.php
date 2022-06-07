<?php
use App\Models\Category;
use Carbon\Carbon;

beforeEach(function () {

    $this->category = Category::factory()->create();
});

// checks if the category ID is a int in the database
test('category ID is a INT', function () {
    expect($this->category->id)->toBeInt();
})->group('CategoryUnitTests', 'CategoryTests');

// checks if the name is a string in the database
test('category Name is a string', function () {
    expect($this->category->name)->toBeString();
})->group('CategoryUnitTests', 'CategoryTests');

// checks if the created_at is a DatTime in the database
test('category create_at is a DateTime', function () {
    expect($this->category->created_at)->toBeInstanceOf(Carbon::class);
})->group('CategoryUnitTests', 'CategoryTests');

// checks if the updated_at is a DatTime in the database
test('category updated_at is a DateTime', function () {
    expect($this->category->updated_at)->toBeInstanceOf(Carbon::class);
})->group('CategoryUnitTests', 'CategoryTests');
