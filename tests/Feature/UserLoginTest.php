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
    $this->post('api/login', $loginData)
        ->assertOk()
        ->assertJsonStructure(['data' => ['token', 'user']]);
})->with([
    ['email' => 'johndoe@example.com', 'password' => 'password'],
]);

test('login fails when form request validation check fields', function ($invalidLogin) {
    $response = $this->postJson('api/login', $invalidLogin);
    $response->assertUnprocessable();
})->with([
    [['email' => 'notanemail', 'password' => 'password', 'device_name' => 'Android']],
    [['email' => 'johndoe@example.com', 'WrongPassword' => 'password', 'device_name' => 'Android']],
    [['email' => 'johndoe@example.com', 'password' => 'password', 'device_name' => '']],
]);
