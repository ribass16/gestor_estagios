<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Aluno;
use App\Models\Orientador;
use App\Models\Vaga;
use App\Models\Candidatura;
use App\Models\Estagio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Users (use firstOrCreate to avoid duplicates)
        try {
            $admin = User::firstOrCreate(
                ['email' => 'admin@istec.pt'],
                ['name' => 'Admin Geral', 'password' => Hash::make('admin123'), 'user_type' => 'admin']
            );
        } catch (\Exception $e) {
            Log::error('Seeder error creating admin: '.$e->getMessage());
            throw $e;
        }

        try {
            $alunoUser = User::firstOrCreate(
                ['email' => 'aluno@istec.pt'],
                ['name' => 'Aluno Teste', 'password' => Hash::make('aluno123'), 'user_type' => 'aluno']
            );
        } catch (\Exception $e) {
            Log::error('Seeder error creating alunoUser: '.$e->getMessage());
            throw $e;
        }

        try {
            $orientadorUser = User::firstOrCreate(
                ['email' => 'orientador@istec.pt'],
                ['name' => 'Orientador Teste', 'password' => Hash::make('orientador123'), 'user_type' => 'orientador']
            );
        } catch (\Exception $e) {
            Log::error('Seeder error creating orientadorUser: '.$e->getMessage());
            throw $e;
        }

        try {
            $empresaUser = User::firstOrCreate(
                ['email' => 'empresa@istec.pt'],
                ['name' => 'Empresa Teste', 'password' => Hash::make('empresa123'), 'user_type' => 'empresa']
            );
        } catch (\Exception $e) {
            Log::error('Seeder error creating empresaUser: '.$e->getMessage());
            throw $e;
        }

        // Empresa record
        try {
            $empresa = Empresa::firstOrCreate(
                ['user_id' => $empresaUser->id],
                ['nome' => 'Empresa Teste Lda', 'descricao' => 'Empresa de exemplo para estágios', 'aceita_estagios' => true]
            );
        } catch (\Exception $e) {
            Log::error('Seeder error creating empresa: '.$e->getMessage());
            throw $e;
        }

        // Aluno record
        try {
            $aluno = Aluno::firstOrCreate(
                ['user_id' => $alunoUser->id],
                ['curso' => 'Engenharia Informática', 'ano_letivo' => '3', 'numero_estudante' => '20250001']
            );
        } catch (\Exception $e) {
            Log::error('Seeder error creating aluno: '.$e->getMessage());
            throw $e;
        }

        // Orientador record
        try {
            $orientador = Orientador::firstOrCreate(
                ['user_id' => $orientadorUser->id],
                ['departamento' => 'Departamento de Informática', 'especialidade' => 'Sistemas de Informação']
            );
        } catch (\Exception $e) {
            Log::error('Seeder error creating orientador: '.$e->getMessage());
            throw $e;
        }

        // Vagas (empresa_id references users table per migration)
        try {
            $vaga1 = Vaga::firstOrCreate(
                ['titulo' => 'Desenvolvedor Backend', 'empresa_id' => $empresaUser->id],
                ['descricao' => 'Vaga para desenvolver APIs em Laravel', 'estado' => 'aberta']
            );
        } catch (\Exception $e) {
            Log::error('Seeder error creating vaga1: '.$e->getMessage());
            throw $e;
        }

        try {
            $vaga2 = Vaga::firstOrCreate(
                ['titulo' => 'Front-end Developer', 'empresa_id' => $empresaUser->id],
                ['descricao' => 'Vaga para trabalhar com Vue/React/Vite', 'estado' => 'aberta']
            );
        } catch (\Exception $e) {
            Log::error('Seeder error creating vaga2: '.$e->getMessage());
            throw $e;
        }

        // Candidatura: aluno -> vaga1
        try {
            Candidatura::firstOrCreate(
                ['aluno_id' => $alunoUser->id, 'vaga_id' => $vaga1->id],
                ['orientador_id' => $orientadorUser->id, 'estado' => 'pendente']
            );
        } catch (\Exception $e) {
            Log::error('Seeder error creating candidatura: '.$e->getMessage());
            throw $e;
        }

        // Estágio: link aluno, empresa (companies table) and orientador
        try {
            Estagio::firstOrCreate(
                ['aluno_id' => $aluno->id, 'empresa_id' => $empresa->id],
                ['orientador_id' => $orientador->id, 'titulo' => 'Estágio em Desenvolvimento Web', 'descricao' => 'Estágio prático em Laravel', 'data_inicio' => Carbon::now()->toDateString(), 'estado' => 'pendente']
            );
        } catch (\Exception $e) {
            Log::error('Seeder error creating estagio: '.$e->getMessage());
            throw $e;
        }
    }
}
