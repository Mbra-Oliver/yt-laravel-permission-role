<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Liste des utilisateurs avec leurs rôles respectifs
        $users = [
            [
                'name' => 'Alice',
                'email' => 'alice@example.com',
                'role' => 'DATA_MANAGER'
            ],
            [
                'name' => 'Bob',
                'email' => 'bob@example.com',
                'role' => 'EMPLOYE_MANAGER'
            ],
            [
                'name' => 'Charlie',
                'email' => 'charlie@example.com',
                'role' => 'MANAGER'
            ]
        ];

        foreach ($users as $userData) {


            $user = User::firstOrCreate(
                [
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make('azerty')
                ]
            );

            $role = Role::firstOrCreate([
                'name'=>$userData['role']
            ]);

            //Assigner un role a l'user
            $user->assignRole($role);
        }
    }
}
