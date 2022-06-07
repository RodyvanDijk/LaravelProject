<?php

test('example2', function () {
    expect(true)->toBeTrue();
})->group('example');

test('example')->expect(true)->toBeTrue()->group('example');
