<?php

use Database\Factories\UserFactory;
use Laravel\Sanctum\Sanctum;

it('check doctor cannot create a submission', function () {
    $doctor = UserFactory::class::new()->doctor()->create();
    Sanctum::actingAs($doctor);

    $response = $this->postJson('api/submissions', [
        'title' => 'Submission title',
        'symptoms' => 'Submission description',
    ]);

    $response->assertForbidden();
});
