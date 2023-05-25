<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'update personal info']);
        Permission::create(['name' => 'create submission']);

        Role::findOrCreate(UserRole::PATIENT->value)->givePermissionTo('update personal info');
        Role::findOrCreate(UserRole::DOCTOR->value);
    }
}
