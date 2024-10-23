<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@restaurante.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin', // Rol de administrador
        ]);

        // Crear usuario mesero
        User::create([
            'name' => 'Mesero',
            'email' => 'mesero@restaurante.com',
            'password' => Hash::make('mesero123'),
            'role' => 'mesero', // Rol de mesero
        ]);
    }

}
