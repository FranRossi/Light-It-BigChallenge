<?php

use App\Models\User;
use Hash;
use App\Enums\UserRole;
use Spatie\Permission\Models\Role;


beforeEach(function () {
    Role::create(['name' => UserRole::PATIENT]);
    Role::create(['name' => UserRole::DOCTOR]);
    $validUserData = [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => Hash::make('password'),
        'password_confirmation' => 'password',
        'role' => UserRole::PATIENT->value,
    ];
    User::create($validUserData);
});


test('users can log in with valid credentials', function ($email, $password) {
    $loginData = [
        'email' => $email,
        'password' => $password,
        'device_name' => 'test_device',
    ];
    $response = $this->post('api/login', $loginData);
    $response->assertOk();
    $response->assertJsonStructure(['token', 'user']);
})->with([
    ['email' => 'johndoe@example.com', 'password' => 'password'],
]);

test('login form request validation', function ($invalidValue, $invalidField) {
    $validUserData[$invalidField] = $invalidValue;
    $response = $this->post('api/login', $validUserData);
    $response->assertRedirect();
    $errors = session('errors');
    // $response->assertStatus(422);
})->with([
    [['email' => 'notanemail'], 'email'],
    [['password' => 'pass'], 'password'],
    [['device_name' => 'Android'], 'device_name'],
]);
