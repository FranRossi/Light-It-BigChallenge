<?php

use Database\Factories\UserFactory;
use Laravel\Sanctum\Sanctum;

test("user can't update personal info before login in fisrt", function () {
    $response = $this->putJson("api/update", [
        'name' => 'John Doe',
        'email' => 'john@gmail.com',
        'password' => 'password',
    ]);
    $response->assertUnauthorized();
});

test("user logged, can update personal info", function () {
    Sanctum::actingAs(
        UserFactory::new()->create(),
    );
    $response = $this->putJson("api/update", [
        'phone' => '099324252',
        'weight' => '78',
        'height' => '1.80',
        'other_info' => 'Blood type A+',
    ]);
    $response->assertOk();
    $this->assertDatabaseHas('users', [
        'phone' => '099324252',
        'weight' => '78',
        'height' => '1.80',
        'other_info' => 'Blood type A+',
    ]);
});
