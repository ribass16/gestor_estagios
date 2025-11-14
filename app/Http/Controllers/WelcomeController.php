<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Aluno;
use App\Models\Estagio;
use App\Models\Vaga;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Contar empresas aprovadas/ativas
        $totalEmpresas = Empresa::where('estado', 'aprovada')->count();

        // Contar alunos registados
        $totalAlunos = Aluno::count();

        // Contar estágios ativos
        $totalEstagios = Estagio::where('estado', 'ativo')->count();

        // Contar vagas abertas (opcional)
        $vagasAbertas = Vaga::where('estado', 'aberta')->count();

        return view('welcome', compact(
            'totalEmpresas',
            'totalAlunos',
            'totalEstagios',
            'vagasAbertas'
        ));
    }
}
