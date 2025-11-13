<?php

namespace App\Http\Controllers;

use App\Models\Candidatura;
use App\Models\Vaga;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidaturaController extends Controller
{
    /**
     * Listar candidaturas do aluno autenticado.
     */
    public function index()
    {
        $aluno = Aluno::where('user_id', Auth::id())->first();

        if (!$aluno) {
            $candidaturas = collect();
        } else {
            $candidaturas = Candidatura::with([
                    'vaga',
                    'estagio.orientador.user', // se o Orientador tiver relação user()
                ])
                ->where('aluno_id', $aluno->id)
                ->get();
        }

        return view('candidaturas.index', compact('candidaturas'));
    }


    /**
     * Guardar candidatura a uma vaga.
     */
    public function store(Request $request, Vaga $vaga)
    {
        $aluno = Aluno::where('user_id', Auth::id())->firstOrFail();

        // Impedir duplicadas
        $jaExiste = Candidatura::where('aluno_id', $aluno->id)
            ->where('vaga_id', $vaga->id)
            ->exists();

        if ($jaExiste) {
            return redirect()
                ->route('candidaturas.index')
                ->with('success', 'Já te candidataste a esta vaga.');
        }

        Candidatura::create([
            'vaga_id' => $vaga->id,
            'aluno_id' => $aluno->id, // tem de ser o ID da tabela alunos
            'estado' => 'pendente',
        ]);



        return redirect()
            ->route('candidaturas.index')
            ->with('success', 'Candidatura submetida com sucesso.');
    }

    /**
     * Cancelar candidatura (apenas dono).
     */
    public function destroy($id)
    {
        $aluno = Aluno::where('user_id', Auth::id())->firstOrFail();

        $candidatura = Candidatura::where('id', $id)
            ->where('aluno_id', $aluno->id)
            ->firstOrFail();

        // Regra: só cancelar se estiver pendente
        if ($candidatura->estado === 'pendente') {
            $candidatura->delete();
        }

        return redirect()
            ->route('candidaturas.index')
            ->with('success', 'Candidatura cancelada.');
    }
}
