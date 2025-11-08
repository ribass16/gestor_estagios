<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidatura;
use App\Models\Vaga;

class CandidaturaController extends Controller
{
    // Guardar candidatura
    public function store($vagaId)
    {
        $user = Auth::user();

        // Garante que é um aluno
        if ($user->user_type !== 'aluno') {
            return redirect()->back()->with('error', 'Apenas alunos podem candidatar-se a vagas.');
        }

        // Verifica se a vaga existe
        $vaga = Vaga::find($vagaId);
        if (!$vaga) {
            return redirect()->back()->with('error', 'A vaga selecionada não existe.');
        }

        // Evita candidaturas duplicadas
        $existe = Candidatura::where('aluno_id', $user->id)
            ->where('vaga_id', $vagaId)
            ->exists();

        if ($existe) {
            return redirect()->back()->with('warning', 'Já te candidataste a esta vaga.');
        }

        // Cria a candidatura
        Candidatura::create([
            'aluno_id' => $user->id,
            'vaga_id' => $vagaId,
            'estado' => 'pendente',
        ]);

        return redirect()->back()->with('success', 'Candidatura enviada com sucesso!');
    }

    // Mostrar candidaturas do aluno logado
    public function minhasCandidaturas()
    {
        $user = Auth::user();

        $candidaturas = Candidatura::with('vaga')
            ->where('aluno_id', $user->id)
            ->get();

        return view('candidaturas.minhas', compact('candidaturas'));
    }

    public function index()
    {
        $user = Auth::user();

        // Busca todas as candidaturas do aluno autenticado
        $candidaturas = \App\Models\Candidatura::where('aluno_id', $user->id)
            ->with('vaga') // traz os dados da vaga associada
            ->get();

        return view('candidaturas.index', compact('candidaturas'));
    }

    public function destroy($id)
    {
        $candidatura = \App\Models\Candidatura::findOrFail($id);

        if (Auth::id() !== $candidatura->aluno_id) {
            abort(403, 'Acesso negado.');
        }

        $candidatura->delete();

        return redirect()->route('candidaturas.index')
            ->with('success', 'Candidatura cancelada com sucesso.');
    }



}
