<?php

use Database\Factories\UserFactory;
use Laravel\Sanctum\Sanctum;

test("user can't update personal info before login in first", function () {
    $response = $this->putJson("api/update", [
        'name' => 'John Doe',
        'email' => 'john@gmail.com',
        'password' => 'password',
    ]);
    $response->assertUnauthorized();
});

test('can update a patient info', function ($body) {
    $patient = UserFactory::new()->patient()->create();
    Sanctum::actingAs($patient);

    $response = $this->putJson('api/update', $body);
    $response->assertOk();
    $this->assertDatabaseHas('users', $body);
})->with([
    'With other info' => [[
        'phone' => '123456789',
        'height' => '1.90',
        'weight' => '95',
        'other_info' => 'Lefty',
    ]],
    'Without other info' => [[
        'phone' => '0999999999',
        'height' => '1.92',
        'weight' => '100',
    ]],
]);

test('Form request validation is working', function ($body) {
    $patient = UserFactory::new()->patient()->create();
    Sanctum::actingAs($patient);

    $response = $this->putJson('api/update', $body);
    $response->assertUnprocessable();
})->with([
    'Without phone' => [[
        'height' => '1.80',
        'weight' => '80',
    ]],
    'Without height' => [[
        'phone' => '0999999999',
        'weight' => '80',
    ]],
    'Without weight' => [[
        'phone' => '0999999999',
        'height' => '1.80',
    ]]
    ]);

test('only patients can update their info', function () {
    $doctor = UserFactory::new()->doctor()->create();
    Sanctum::actingAs($doctor);

    $response = $this->putJson('api/update', []);
    $response->assertForbidden();
});
