<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
      public function run(): void
    {
        // Create roles if not exist
        $roles = [
            'admin',
            'doctor',
            'patient',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Create users and assign roles
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@precisionpulsemd.com',
                'password' => Hash::make('Admin@321'),
                'role' => 'admin',
            ],
            [
                'name' => 'Doctor User',
                'email' => 'doctor@precisionpulsemd.com',
                'password' => Hash::make('Doctor@321'),
                'role' => 'doctor',
            ],
            [
                'name' => 'Patient User',
                'email' => 'patient@precisionpulsemd.com',
                'password' => Hash::make('Patient@321'),
                'role' => 'patient',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => $userData['password'],
                ]
            );
            $user->assignRole($userData['role']);
        }
    }
}
