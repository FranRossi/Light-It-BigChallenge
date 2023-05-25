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

test('user is logged before creating submission', function (){
    $response = $this->postJson('api/submissions', []);
    $response->assertUnauthorized();
});

test('patient can create a submission', function (){
    $patient = UserFactory::class::new()->patient()->create();
    Sanctum::actingAs($patient);

    $response = $this->postJson('api/submissions', [
        'title' => 'Submission title',
        'symptoms' => 'Submission description',
    ]);

    $response->assertCreated();
    $this->assertDatabaseHas('submissions', [
        'title' => 'Submission title',
        'symptoms' => 'Submission description',
    ]);
});

