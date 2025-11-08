<?php

namespace App\Http\Controllers;

use App\Models\Candidatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaCandidaturaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Vê todas as candidaturas ligadas às vagas da empresa autenticada
        $candidaturas = Candidatura::whereHas('vaga', function ($query) use ($user) {
            $query->where('empresa_id', $user->id);
        })->with(['aluno', 'vaga'])->get();

        return view('empresa.candidaturas.index', compact('candidaturas'));
    }

    // Aceitar candidatura
    public function aceitar($id)
    {
        $candidatura = Candidatura::findOrFail($id);
        $candidatura->estado = 'aceite';
        $candidatura->save();

        return redirect()->back()->with('success', 'Candidatura aceite com sucesso!');
    }

    // Recusar candidatura
    public function recusar($id)
    {
        $candidatura = Candidatura::findOrFail($id);
        $candidatura->estado = 'recusada';
        $candidatura->save();

        return redirect()->back()->with('error', 'Candidatura recusada.');
    }
}
