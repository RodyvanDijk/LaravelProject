<?php

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Game;
use \Pest\Laravel;

beforeEach(function (){
    $this->category = Category::factory()->create();
    $this->game = Game::factory()->create();
});

test('a game is inside a category', function (){

    expect($this->game->category)->toBeInstanceOf(Category::class);

})->group('GameUnit');

test('a game name is a string', function (){

    expect($this->game->game)->toBeString();

})->group('GameUnit');

test('a game description is a string', function (){

    expect($this->game->description)->toBeString();

})->group('GameUnit');

test('a game id is an integer', function (){

    expect($this->game->id)->toBeInt();

})->group('GameUnit');

test('a game category_id is an integer', function (){

    expect($this->game->category_id)->toBeInt();

})->group('GameUnit');

test('a game price is a float', function (){

    expect($this->game->price)->toBeFloat();

})->group('GameUnit');

test('a game created at is a datetime', function (){

    expect($this->game->created_at)->toBeInstanceOf(Carbon::class);

})->group('GameUnit');


test('a game updated at is a datetime', function (){

    expect($this->game->updated_at)->toBeInstanceOf(Carbon::class);

})->group('GameUnit');
