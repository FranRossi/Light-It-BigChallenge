<?php

use App\Enums\UserRole;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    Role::create(['name' => UserRole::PATIENT]);
});


$validUserData = [
    'name' => 'John Doe',
    'email' => 'johndoe@example.com',
    'password' => 'password',
    'role' => UserRole::PATIENT->value,
];


test('users can sign up with valid information', function ($userData) use ($validUserData) {
    $userData = array_merge($validUserData, $userData);
    $response = $this->post('api/signup', $validUserData);
    $response->assertStatus(200);
    $this->assertDatabaseHas('users', [
        'email' => 'johndoe@example.com',
    ]);
})->with([
    [['role' => UserRole::PATIENT->value]],
    [['role' => UserRole::DOCTOR->value]],
]);

test('signup form request validation', function ($userData, $fieldTesting) use ($validUserData) {
    $userData = array_merge($validUserData, $userData);
    $response = $this->post('api/signup', $userData);
    $response->assertRedirect();
    $errors = session('errors');
    $this->assertTrue($errors->has($fieldTesting));
})->with([
    [['email' => 'notanemail'], 'email'],
    [['role' => 'WrongRole'], 'role'],
]);
