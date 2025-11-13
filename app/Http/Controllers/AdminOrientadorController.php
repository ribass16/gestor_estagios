<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orientador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminOrientadorController extends Controller
{
    /**
     * Listagem com pesquisa e paginação.
     */
    public function index(Request $request): View
    {
        $q = trim((string) $request->input('q'));

        $baseQuery = Orientador::with('user');

        if ($q !== '') {
            $baseQuery->where(function ($qb) use ($q) {
                $qb->where('telemovel', 'like', "%{$q}%")
                   ->orWhere('departamento', 'like', "%{$q}%")
                   ->orWhereHas('user', function ($uq) use ($q) {
                       $uq->where('name', 'like', "%{$q}%")
                          ->orWhere('email', 'like', "%{$q}%");
                   });
            });
        }

        // Para os cards
        $pendentesCount  = Orientador::where('estado', 'pendente')->count();
        $aprovadosCount  = Orientador::where('estado', 'aprovado')->count();
        $rejeitadosCount = Orientador::where('estado', 'rejeitado')->count();

        // Tabela principal (todos os estados) paginada
        $orientadores = $baseQuery->orderBy('id', 'desc')->paginate(12)->withQueryString();

        return view('admin.orientadores.index', compact(
            'orientadores', 'q',
            'pendentesCount', 'aprovadosCount', 'rejeitadosCount'
        ));
    }

    /**
     * Formulário para criar novo orientador.
     */
    public function create(): View
    {
        return view('admin.orientadores.create');
    }

    /**
     * Guardar novo orientador (criado já como aprovado).
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
            'departamento' => ['nullable', 'string', 'max:255'],
            'telemovel'    => ['nullable', 'string', 'max:30'],
        ]);

        $user = User::create([
            'name'      => $request->nome,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'user_type' => 'orientador',
        ]);

        Orientador::create([
            'user_id'      => $user->id,
            'departamento' => $request->departamento,
            'telemovel'    => $request->telemovel,
            'estado'       => 'aprovado',
        ]);

        return redirect()->route('admin.orientadores.index')
            ->with('status', 'Orientador criado com sucesso.');
    }

    /**
     * Editar orientador (dados do user + perfil).
     */
    public function edit(Orientador $orientador): View
    {
        $orientador->load('user');
        return view('admin.orientadores.edit', compact('orientador'));
    }

    /**
     * Atualizar orientador.
     */
    public function update(Request $request, Orientador $orientador): RedirectResponse
    {
        $request->validate([
            'nome'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255', 'unique:users,email,' . $orientador->user_id],
            'departamento' => ['nullable', 'string', 'max:255'],
            'telemovel'    => ['nullable', 'string', 'max:30'],
            'estado'       => ['required', 'in:pendente,aprovado,rejeitado'],
        ]);

        // atualizar user
        $orientador->user->update([
            'name'  => $request->nome,
            'email' => $request->email,
        ]);

        // atualizar perfil
        $orientador->update([
            'departamento' => $request->departamento,
            'telemovel'    => $request->telemovel,
            'estado'       => $request->estado,
        ]);

        return redirect()->route('admin.orientadores.index')->with('status', 'Orientador atualizado.');
    }

    /**
     * Aprovar / Rejeitar rápidos.
     */
    public function aprovar(Orientador $orientador): RedirectResponse
    {
        $orientador->update(['estado' => 'aprovado']);
        return back()->with('status', 'Orientador aprovado.');
    }

    public function rejeitar(Orientador $orientador): RedirectResponse
    {
        $orientador->update(['estado' => 'rejeitado']);
        return back()->with('status', 'Orientador rejeitado.');
    }

    /**
     * Apagar (apaga também o user correspondente).
     */
    public function destroy(Orientador $orientador): RedirectResponse
    {
        $user = $orientador->user;
        $orientador->delete();
        if ($user) {
            $user->delete();
        }
        return back()->with('status', 'Orientador removido.');
    }
}
