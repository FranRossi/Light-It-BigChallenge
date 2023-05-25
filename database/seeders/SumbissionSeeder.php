<?php

namespace Database\Seeders;

use App\Enums\SubmissionStatus;
use Database\Factories\SubmissionFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SumbissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubmissionFactory::new()->create([
            'patient_id' => UserFactory::new()->patient(),
            'doctor_id' => UserFactory::new()->doctor(),
        ]);
    }
}
