<?php

namespace App\Http\Controllers;

use App\Models\Candidatura;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaCandidaturaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Empresa ligada ao utilizador autenticado
        $empresa = Empresa::where('user_id', $user->id)->first();

        if (!$empresa) {
            abort(403, 'Empresa não encontrada para este utilizador.');
        }

        $candidaturas = Candidatura::with(['vaga', 'aluno.user'])
            ->whereHas('vaga', function ($q) use ($user) {
                // vagas.empresa_id = users.id (não empresas.id)
                $q->where('empresa_id', $user->id);
            })
            ->get();

        return view('empresa.candidaturas.index', compact('candidaturas'));
    }

    public function aceitar($id)
    {
        $empresa = Empresa::where('user_id', Auth::id())->firstOrFail();

        $candidatura = Candidatura::with('vaga')->findOrFail($id);

        // segurança: só a empresa dona da vaga pode mexer (empresa_id = users.id)
        if (!$candidatura->vaga || $candidatura->vaga->empresa_id !== Auth::id()) {
            abort(403, 'Não podes alterar esta candidatura.');
        }

        $candidatura->estado = 'aceite';
        $candidatura->save();

        return back()->with('success', 'Candidatura marcada como aceite. Aguarda a escolha do orientador pelo aluno.');
    }

    public function recusar($id)
    {
        $empresa = Empresa::where('user_id', Auth::id())->firstOrFail();

        $candidatura = Candidatura::with('vaga')->findOrFail($id);

        if (!$candidatura->vaga || $candidatura->vaga->empresa_id !== Auth::id()) {
            abort(403, 'Não podes alterar esta candidatura.');
        }

        $candidatura->estado = 'recusada';
        $candidatura->save();

        return back()->with('success', 'Candidatura recusada.');
    }
}
