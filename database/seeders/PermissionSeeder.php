<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Données de rôles et permissions à créer
        $data = [
            [
                'permission_name' => 'EDIT_DATA',
                'role_name' => 'DATA_MANAGER',
            ],
            [
                'permission_name' => 'ADD_DATA',
                'role_name' => 'DATA_MANAGER',
            ],
            [
                'permission_name' => 'ADD_NEW_EMPLOYE',
                'role_name' => 'EMPLOYE_MANAGER',
            ],
            [
                'permission_name' => 'DELETE_AN_EMPLOYE',
                'role_name' => 'EMPLOYE_MANAGER',
            ],
            [
                'permission_name' => 'REVOKE_EMPLOYE_ACCESS',
                'role_name' => 'MANAGER',
            ],
            [
                'permission_name' => 'ADD_STAGIAIRE',
                'role_name' => 'MANAGER',
            ],
            [
                'permission_name' => 'ENROL_STAGIAIRE',
                'role_name' => 'MANAGER',
            ],
        ];

        foreach ($data as $item) {

            $role = Role::firstOrCreate(['name' => $item['role_name']]);

            // Assurez-vous que la permission existe, sinon, créez-la
            $permission = Permission::firstOrCreate(['name' => $item['permission_name']]);

            // Assignez la permission au rôle
            $role->givePermissionTo($permission);
        }
    }
}
