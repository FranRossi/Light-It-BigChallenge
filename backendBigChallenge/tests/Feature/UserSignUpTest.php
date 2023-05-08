<?php

use App\Enums\UserRole;
use Spatie\Permission\Models\Role;

test('users can sign up with valid information', function () {
    //create role Patient
    Role::create(['name' => UserRole::PATIENT]);
    $data = [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password',
        'role' => UserRole::PATIENT->value,
    ];

    $response = $this->post('api/signup', $data);

    $response->assertStatus(200);

    $this->assertDatabaseHas('users', [
        'email' => 'johndoe@example.com',
    ]);
});

test('signup form request validation, wrong email and role', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'notanemail',
        'password' => 'securePassword',
        'role' => 'WrongRole'
    ];

    $response = $this->post('api/signup', $data);
    $response->assertRedirect();

    $errors = session('errors');
    $this->assertTrue($errors->has('email'));
    $this->assertTrue($errors->has('role'));

    $this->assertFalse($errors->has('name'));
    $this->assertFalse($errors->has('password'));
});

