<?php
use Database\Factories\UserFactory;
use Laravel\Sanctum\Sanctum;

test('user can logout properly', function () {
   Sanctum::actingAs(
       UserFactory::new()->create(),
   );
    $response = $this->postJson('api/logout');
    $response->assertOk();
});

test('user cannot logout if not authenticated', function () {
    $response = $this->postJson('api/logout');
    $response->assertUnauthorized();
});
