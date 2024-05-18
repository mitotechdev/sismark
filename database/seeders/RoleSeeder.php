<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Director']);
        Role::create(['name' => 'Commissioner']);
        Role::create(['name' => 'Head of Sales & Marketing']);
        Role::create(['name' => 'Branch Manager']);
        Role::create(['name' => 'Coordinator Area']);
        Role::create(['name' => 'SPV Technition']);
        Role::create(['name' => 'Sales & Marketing']);
        Role::create(['name' => 'Admin Sales']);
        Role::findByName('Super Admin')->syncPermissions(Permission::all());
    }
}
