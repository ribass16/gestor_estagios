<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orientador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminOrientadorController extends Controller
{
    public function index()
    {
        $pendentes = Orientador::where('estado', 'pendente')->with('user')->get();
        $aprovados = Orientador::where('estado', 'aprovado')->with('user')->get();
        $rejeitados = Orientador::where('estado', 'rejeitado')->with('user')->get();

        return view('admin.orientadores.index', compact('pendentes', 'aprovados', 'rejeitados'));
    }

    public function create()
    {
        return view('admin.orientadores.create');
    }

    public function store(Request $request)
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
            'estado'       => 'aprovado', // criados pelo admin entram aprovados
        ]);

        return redirect()->route('admin.orientadores.index')
            ->with('status', 'Orientador criado com sucesso.');
    }

    public function aprovar(Orientador $orientador)
    {
        $orientador->update(['estado' => 'aprovado']);

        return back()->with('status', 'Orientador aprovado.');
    }

    public function rejeitar(Orientador $orientador)
    {
        $orientador->update(['estado' => 'rejeitado']);

        return back()->with('status', 'Orientador rejeitado.');
    }
}
