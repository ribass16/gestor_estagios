<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\User;
use App\Models\Candidatura;
use App\Models\Estagio;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminAlunoController extends Controller
{
    /**
     * Listagem com pesquisa e paginação.
     */
    public function index(Request $request): View
    {
        $q = trim((string) $request->input('q'));

        $base = Aluno::with(['user'])
            ->withCount('candidaturas')
            ->withCount(['estagios as estagios_ativos_count' => function ($q2) {
                $q2->where('estado', 'ativo');
            }]);

        if ($q !== '') {
            $base->where(function ($qb) use ($q) {
                $qb->where('curso', 'like', "%{$q}%")
                   ->orWhere('ano_letivo', 'like', "%{$q}%")
                   ->orWhere('numero_estudante', 'like', "%{$q}%")
                   ->orWhereHas('user', function ($uq) use ($q) {
                       $uq->where('name', 'like', "%{$q}%")
                          ->orWhere('email', 'like', "%{$q}%");
                   });
            });
        }

        // Cards
        $totalCount        = Aluno::count();
        $comCandidaturas   = Aluno::has('candidaturas')->count();
        $comEstagioAtivo   = Estagio::where('estado', 'ativo')->distinct('aluno_id')->count('aluno_id');

        // Tabela
        $alunos = $base->orderBy('id', 'desc')->paginate(12)->withQueryString();

        return view('admin.alunos.index', compact(
            'alunos', 'q',
            'totalCount', 'comCandidaturas', 'comEstagioAtivo'
        ));
    }

    /**
     * Form criar novo aluno.
     */
    public function create(): View
    {
        return view('admin.alunos.create');
    }

    /**
     * Guardar novo aluno (cria User + Aluno).
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
            'curso'             => ['nullable', 'string', 'max:255'],
            'ano_letivo'        => ['nullable', 'string', 'max:255'],
            'numero_estudante'  => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name'      => $request->nome,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'user_type' => 'aluno',
        ]);

        Aluno::create([
            'user_id'          => $user->id,
            'curso'            => $request->curso,
            'ano_letivo'       => $request->ano_letivo,
            'numero_estudante' => $request->numero_estudante,
        ]);

        return redirect()->route('admin.alunos.index')
            ->with('status', 'Aluno criado com sucesso.');
    }

    /**
     * Form editar aluno.
     */
    public function edit(Aluno $aluno): View
    {
        $aluno->load('user');
        return view('admin.alunos.edit', compact('aluno'));
    }

    /**
     * Atualizar aluno (User + perfil).
     */
    public function update(Request $request, Aluno $aluno): RedirectResponse
    {
        $request->validate([
            'nome'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email', 'max:255', 'unique:users,email,' . $aluno->user_id],
            'curso'             => ['nullable', 'string', 'max:255'],
            'ano_letivo'        => ['nullable', 'string', 'max:255'],
            'numero_estudante'  => ['nullable', 'string', 'max:255'],
        ]);

        // atualizar user
        if ($aluno->user) {
            $aluno->user->update([
                'name'  => $request->nome,
                'email' => $request->email,
            ]);
        }

        // atualizar perfil
        $aluno->update([
            'curso'            => $request->curso,
            'ano_letivo'       => $request->ano_letivo,
            'numero_estudante' => $request->numero_estudante,
        ]);

        return redirect()->route('admin.alunos.index')->with('status', 'Aluno atualizado.');
    }

    /**
     * Apagar (remove Aluno + User). Se tiver FKs ON DELETE CASCADE, ótimo; senão, limpa dependências principais.
     */
    public function destroy(Aluno $aluno): RedirectResponse
    {
        // limpa dependências básicas (se não tiveres cascatas no schema)
        Candidatura::where('aluno_id', $aluno->id)->delete();
        Estagio::where('aluno_id', $aluno->id)->delete();

        $user = $aluno->user;
        $aluno->delete();
        if ($user) {
            $user->delete();
        }

        return back()->with('status', 'Aluno removido.');
    }
}
