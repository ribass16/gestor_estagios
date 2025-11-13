<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Empresa;
use App\Models\Candidatura;
use App\Models\Orientador;
use App\Models\Estagio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlunoOrientadorController extends Controller
{
    public function create(Candidatura $candidatura)
    {
        $userId  = Auth::id();
        $ownerId = $this->resolveOwnerUserId($candidatura);

        if ($userId !== $ownerId || $candidatura->estado !== 'aceite') {
            abort(403);
        }

        $orientadores = Orientador::where('estado', 'aprovado')
            ->withCount(['estagios' => function ($q) {
                $q->where('estado', 'ativo');
            }])
            ->having('estagios_count', '<', 5)
            ->get();

        return view('aluno.escolher-orientador', compact('candidatura', 'orientadores'));
    }

    public function store(Request $request, Candidatura $candidatura)
    {
        $userId  = Auth::id();
        $ownerId = $this->resolveOwnerUserId($candidatura);

        if ($userId !== $ownerId || $candidatura->estado !== 'aceite') {
            abort(403);
        }

        $request->validate([
            'orientador_id' => ['required', 'exists:orientadores,id'],
        ]);

        $orientador = Orientador::where('id', $request->orientador_id)
            ->where('estado', 'aprovado')
            ->withCount(['estagios' => function ($q) {
                $q->where('estado', 'ativo');
            }])
            ->firstOrFail();

        if ($orientador->estagios_count >= 5) {
            return back()->withErrors([
                'orientador_id' => 'Este orientador já atingiu o limite de 5 alunos.',
            ]);
        }

        $alunoModelId = $this->resolveAlunoModelId($candidatura);
        if (!$alunoModelId) {
            return back()->withErrors([
                'orientador_id' =>
                    'Não foi possível associar o aluno ao estágio (não existe registo correspondente na tabela "alunos").',
            ]);
        }

        $empresaId = $this->resolveEmpresaId($candidatura);
        if (!$empresaId) {
            return back()->withErrors([
                'orientador_id' =>
                    'Não foi possível associar a empresa ao estágio (verifica se a vaga está ligada a uma empresa válida).',
            ]);
        }

        // depois de criar o estágio

            Estagio::create([
                'candidatura_id' => $candidatura->id,
                'aluno_id'       => $alunoModelId,
                'empresa_id'     => $empresaId,
                'orientador_id'  => $orientador->id,
                'titulo'         => $candidatura->vaga->titulo ?? 'Estágio',
                'descricao'      => $candidatura->vaga->descricao ?? '',
                'data_inicio'    => now(),
                'estado'         => 'ativo',
            ]);

            $candidatura->estado = 'aceite';
            $candidatura->save();

            return redirect()
                ->route('candidaturas.index')
                ->with('success', 'Orientador escolhido e estágio criado com sucesso.');

    }

    private function resolveOwnerUserId(Candidatura $candidatura): ?int
    {
        if (!is_null($candidatura->user_id)) {
            return $candidatura->user_id;
        }

        if (method_exists($candidatura, 'aluno') && $candidatura->aluno) {
            $aluno = $candidatura->aluno;
            if ($aluno->user_id) {
                return $aluno->user_id;
            }
        }

        if (!is_null($candidatura->aluno_id)) {
            return $candidatura->aluno_id;
        }

        return null;
    }

    private function resolveAlunoModelId(Candidatura $candidatura): ?int
    {
        if (method_exists($candidatura, 'aluno') && $candidatura->aluno instanceof Aluno) {
            return $candidatura->aluno->id;
        }

        if ($candidatura->aluno_id) {
            if ($aluno = Aluno::find($candidatura->aluno_id)) {
                return $aluno->id;
            }
        }

        if ($candidatura->aluno_id) {
            if ($byUser = Aluno::where('user_id', $candidatura->aluno_id)->first()) {
                return $byUser->id;
            }
        }

        if ($candidatura->user_id) {
            if ($byUser = Aluno::where('user_id', $candidatura->user_id)->first()) {
                return $byUser->id;
            }
        }

        return null;
    }

    private function resolveEmpresaId(Candidatura $candidatura): ?int
    {
        $vaga = $candidatura->vaga;

        if (!$vaga) {
            return null;
        }

        if ($vaga->empresa_id && Empresa::find($vaga->empresa_id)) {
            return $vaga->empresa_id;
        }

        if ($vaga->empresa_id) {
            if ($byUser = Empresa::where('user_id', $vaga->empresa_id)->first()) {
                return $byUser->id;
            }
        }

        if (method_exists($vaga, 'empresa') && $vaga->empresa instanceof Empresa) {
            return $vaga->empresa->id;
        }

        return null;
    }
}
