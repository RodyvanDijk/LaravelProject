<?php

it('has cart page', function () {
    $response = $this->get('/cart');

    $response->assertStatus(200);
})->group('exampleFeature');

it('has games page', function () {
    $response = $this->get('/games');

    $response->assertStatus(200);
})->group('exampleFeature');
