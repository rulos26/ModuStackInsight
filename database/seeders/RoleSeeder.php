<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);
        $evaluador = Role::create(['name' => 'evaluador']);

        Permission::create(['name' => 'ver dashboard']);
        Permission::create(['name' => 'gestionar usuarios']);
        Permission::create(['name' => 'subir documentos']);
        Permission::create(['name' => 'ver resúmenes']);

        $superadmin->givePermissionTo(Permission::all());
        $admin->givePermissionTo(['ver dashboard','subir documentos','ver resúmenes']);
        $evaluador->givePermissionTo(['ver dashboard','ver resúmenes']);
    }
}
