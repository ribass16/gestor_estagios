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
        // Empresa do utilizador autenticado
        $empresa = Empresa::where('user_id', Auth::id())->firstOrFail();

        // Candidaturas para vagas desta empresa (nota: vagas.empresa_id == empresas.id)
        $candidaturas = Candidatura::with([
                'vaga:id,titulo,empresa_id',
                'vaga.empresa:id,nome',
                'aluno.user:id,name,email',
            ])
            ->whereHas('vaga', fn ($q) => $q->where('empresa_id', $empresa->id))
            ->latest()
            ->paginate(12);

        return view('empresa.candidaturas.index', compact('candidaturas'));
    }

    public function aceitar($id)
    {
        $empresa = Empresa::where('user_id', Auth::id())->firstOrFail();

        $cand = Candidatura::where('id', $id)
            ->whereHas('vaga', fn ($q) => $q->where('empresa_id', $empresa->id))
            ->firstOrFail();

        $cand->update(['estado' => 'aceite']);

        return back()->with('success', 'Candidatura aceite.');
    }

    public function recusar($id)
    {
        $empresa = Empresa::where('user_id', Auth::id())->firstOrFail();

        $cand = Candidatura::where('id', $id)
            ->whereHas('vaga', fn ($q) => $q->where('empresa_id', $empresa->id))
            ->firstOrFail();

        $cand->update(['estado' => 'rejeitada']);

        return back()->with('success', 'Candidatura rejeitada.');
    }
}
