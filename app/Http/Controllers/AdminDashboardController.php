<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Empresa;
use App\Models\Orientador;
use App\Models\Vaga;
use App\Models\Estagio;
use App\Models\Candidatura;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $alunosTotal           = Aluno::count();

        $empresasTotal         = Empresa::count();
        $empresasPendentes     = Empresa::where('estado', 'pendente')->count();

        $orientadoresTotal     = Orientador::count();
        $orientadoresPendentes = Orientador::where('estado', 'pendente')->count();

        $vagasAbertas          = Vaga::where('estado', 'aberta')->count();
        $estagiosAtivos        = Estagio::where('estado', 'ativo')->count();

        $ultimasCandidaturas = Candidatura::with(['aluno.user', 'vaga.empresa'])
            ->whereHas('vaga')            // só com vaga existente
            ->latest('id')
            ->take(5)
            ->get();


        return view('admin.dashboard', compact(
            'alunosTotal',
            'empresasTotal', 'empresasPendentes',
            'orientadoresTotal', 'orientadoresPendentes',
            'vagasAbertas', 'estagiosAtivos',
            'ultimasCandidaturas'
        ));
    }
}
