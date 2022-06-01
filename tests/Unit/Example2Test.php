<?php

test('example2', function () {
    expect(true)->toBeTrue();
})->group('example');

test('example3')->assertTrue(true)->group('example');
