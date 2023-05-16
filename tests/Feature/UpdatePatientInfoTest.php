<?php

use Database\Factories\UserFactory;

test("user can't update personal info before login in fisrt", function () {
    $user = UserFactory::new()->create();
    $response = $this->putJson("api/user/{$user->id}", [
        'name' => 'John Doe',
        'email' => 'john@gmail.com',
        'password' => 'password',
    ]);
    $response->assertUnauthorized();
});
