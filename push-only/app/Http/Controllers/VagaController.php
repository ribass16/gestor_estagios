<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vaga;

class VagaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Se for empresa, mostra apenas as vagas dessa empresa
        if ($user->user_type === 'empresa') {
            $vagas = Vaga::where('empresa_id', $user->id)->get();
        }
        // Se for admin, mostra todas
        elseif ($user->user_type === 'admin') {
            $vagas = Vaga::all();
        }
        // Se for aluno ou orientador, mostra todas abertas
        else {
            $vagas = Vaga::where('estado', 'aberta')->get();
        }

        return view('vagas.index', compact('vagas'));
    }

    public function create()
    {
        return view('vagas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
        ]);

        $user = Auth::user();

        // Cria a vaga associada à empresa logada
        Vaga::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'empresa_id' => $user->id, // <- aqui é a relação direta com a empresa
            'estado' => 'aberta',
        ]);

        return redirect()->route('vagas.index')->with('success', 'Vaga criada com sucesso!');
    }

    public function show(Vaga $vaga)
    {
        return view('vagas.show', compact('vaga'));
    }

    public function destroy(Vaga $vaga)
    {
        $vaga->delete();
        return redirect()->route('vagas.index')->with('success', 'Vaga eliminada com sucesso.');
    }
}
