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

