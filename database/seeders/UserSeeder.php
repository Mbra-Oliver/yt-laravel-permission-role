<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

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
            // Créez l'utilisateur avec un mot de passe par défaut
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('azerty') // Mot de passe par défaut
                ]
            );

            // Assurez-vous que le rôle existe
            $role = Role::firstOrCreate(['name' => $userData['role']]);

            // Assignez le rôle à l'utilisateur
            $user->assignRole($role);
        }
    }
}
