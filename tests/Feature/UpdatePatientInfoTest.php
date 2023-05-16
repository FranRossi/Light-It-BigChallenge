<?php

use Database\Factories\UserFactory;

test ("user is logged before updating personal info", function () {
    $user = UserFactory::new()->create();
    $response = $this->putJson("api/update/{$user->id}", [
        'name' => 'John Doe',
        'email' => 'john@gmail.com',
        'password' => 'password',
    ]);
    $response->assertUnauthorized();
});
