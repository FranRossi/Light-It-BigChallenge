<?php


test('users can sign up with valid information', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password',
    ];

    $response = $this->post('api/signup', $data);

    $response->assertStatus(201);

    $this->assertDatabaseHas('users', [
        'email' => 'johndoe@example.com',
    ]);
});

test('signup form request validation', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'notanemail',
        'password' => 'pass',
    ];

    $response = $this->post('api/signup', $data);
    $response->assertRedirect();

    $errors = session('errors');
    $this->assertTrue($errors->has('email'));

    $this->assertFalse($errors->has('name'));
    $this->assertFalse($errors->has('password'));
});

