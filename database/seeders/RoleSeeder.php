<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        Role::create(['name' => 'coordinador']);
        Role::create(['name' => 'auxiliar']);

        // Crear permisos (opcional)
        Permission::create(['name' => 'manage coordinators']);
        Permission::create(['name' => 'manage auxiliaries']);

        // Asignar permisos a roles (opcional)
        $coordinadorRole = Role::findByName('coordinador');
        $coordinadorRole->givePermissionTo('manage coordinators');

        $auxiliarRole = Role::findByName('auxiliar');
        $auxiliarRole->givePermissionTo('manage auxiliaries');
    }
}
