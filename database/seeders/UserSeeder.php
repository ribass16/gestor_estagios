<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Geral',
            'email' => 'admin@istec.pt',
            'password' => Hash::make('admin123'),
            'user_type' => 'admin',
        ]);

        User::create([
            'name' => 'Aluno Teste',
            'email' => 'aluno@istec.pt',
            'password' => Hash::make('aluno123'),
            'user_type' => 'aluno',
        ]);

        User::create([
            'name' => 'Orientador Teste',
            'email' => 'orientador@istec.pt',
            'password' => Hash::make('orientador123'),
            'user_type' => 'orientador',
        ]);

        User::create([
            'name' => 'Empresa Teste',
            'email' => 'empresa@istec.pt',
            'password' => Hash::make('empresa123'),
            'user_type' => 'empresa',
        ]);
    }
}
