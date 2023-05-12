<?php

use App\Enums\UserRole;
use App\Models\User;
use Hash;
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
    $this->postJson('api/login', $invalidLogin)
         ->assertUnProcessable();
})->with([
    [['email' => 'notanemail', 'password' => 'password', 'device_name' => 'Android']],
    [['email' => 'johndoe@example.com', '' => 'password', 'device_name' => 'Android']],
    [['email' => 'johndoe@example.com', 'password' => 'password', 'device_name' => '']],
]);

test('login fails when credentials are wrong', function ($invalidLogin) {
    $this->postJson('api/login', $invalidLogin)
         ->assertUnauthorized();
})->with([
    [['email' => 'martin@example.com', 'password' => 'password', 'device_name' => 'Android']],
]);
