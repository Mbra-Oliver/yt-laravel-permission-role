<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
        foreach($data as $item){
            $role = Role::firstOrCreate([
                'name'=> $item['role_name']
            ]);

            $permission = Permission::firstOrCreate([
                'name'=>$item['permission_name']
            ]);

            $role->givePermissionTo($permission);

        }
    }
}
