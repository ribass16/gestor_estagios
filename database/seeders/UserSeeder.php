<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Empresa;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Geral',
            'email' => 'admin@istec.pt',
            'password' => Hash::make('password'),
            'user_type' => 'admin',
        ]);

        // Aluno
        User::create([
            'name' => 'Aluno Teste',
            'email' => 'aluno@istec.pt',
            'password' => Hash::make('password'),
            'user_type' => 'aluno',
        ]);

        // Orientador
        User::create([
            'name' => 'Orientador Teste',
            'email' => 'orientador@istec.pt',
            'password' => Hash::make('password'),
            'user_type' => 'orientador',
        ]);

        // Empresa + relação direta com user_id
        $empresaUser = User::create([
            'name' => 'Empresa Teste',
            'email' => 'empresa@istec.pt',
            'password' => Hash::make('password'),
            'user_type' => 'empresa',
        ]);

        Empresa::create([
            'nome' => 'Empresa Teste Lda',
            'descricao' => 'Empresa de exemplo para gestão de estágios.',
            'user_id' => $empresaUser->id,
        ]);
    }
}
