<?php

it('has home page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
})->group('exampleFeature');

it('has game page')
    ->get('/games')
    ->assertStatus(200)->group('exampleFeature');
