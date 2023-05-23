<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    public function patient(): UserFactory
    {
        return $this->afterCreating(function (User $user) {
            $patientRole = Role::findOrCreate(UserRole::PATIENT->value);
            Permission::findOrCreate('update personal info');
            $patientRole->givePermissionTo('update personal info');
            $user->assignRole(UserRole::PATIENT->value);
        });
    }

    public function doctor(): UserFactory
    {
        return $this->afterCreating(function (User $user) {
            $doctorRole = Role::findOrCreate(UserRole::DOCTOR->value);
            $user->assignRole(UserRole::DOCTOR->value);
        });
    }

    public function patientWithPersonalInfo(): UserFactory
    {
        return $this->afterCreating(function (User $user){
            $informationPatient = [
                'phone' => fake()->phoneNumber(),
                'weight' => fake()->numberBetween(50, 150),
                'height' => fake()->randomFloat(2, 1, 2),
                'other_info' => fake()->text(255),
            ];
            $user->update($informationPatient);
        });
    }
}
