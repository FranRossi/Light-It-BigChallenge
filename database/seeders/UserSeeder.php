<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserFactory::new()->patient()->patientWithPersonalInfo()->create([
            'name' => 'Patient',
            'email' => 'patientemail@gmail.com',
        ]);

        UserFactory::new()->patient()->create([
            'name' => 'Patient2WithNoExtraInfo',
            'email' => 'patientWithNoExtraInfo@gmail.com',
        ]);

        UserFactory::new()->doctor()->create([
            'name' => 'Doctor',
            'email' => 'doctor@gmail.com',
        ]);
    }
}
