<?php

test('example2', function () {
    expect(true)->toBeTrue();
})->group('example');

test('example3')->expect(true)->toBeTrue()->group('example');

