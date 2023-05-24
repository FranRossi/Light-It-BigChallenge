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

        Role::create(['name' => UserRole::PATIENT->value])->givePermissionTo('update personal info');
        Role::create(['name' => UserRole::DOCTOR->value]);
    }
}
