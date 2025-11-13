<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlunoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('aluno.dashboard', compact('user'));
    }

    public function perfil()
    {
        $user = Auth::user();
        $aluno = $user->aluno;

        return view('aluno.perfil', compact('user', 'aluno'));
    }

    public function editarPerfil()
    {
        $user = Auth::user();
        $aluno = $user->aluno;

        return view('aluno.editar-perfil', compact('user', 'aluno'));
    }

    public function atualizarPerfil(Request $request)
    {
        $user = Auth::user();
        $aluno = $user->aluno;

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'descricao' => 'nullable|string',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        // Atualiza nome
        $user->name = $request->name;

        // Atualiza password (se preenchida)
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        // Atualiza descrição
        $aluno->descricao = $request->descricao;

        // Upload do CV (se enviado)
        if ($request->hasFile('cv')) {
            $ficheiro = $request->file('cv');
            $nomeFicheiro = 'cv_' . $user->id . '.' . $ficheiro->getClientOriginalExtension();
            $ficheiro->storeAs('cvs', $nomeFicheiro, 'public');
            $aluno->cv_path = 'cvs/' . $nomeFicheiro;
        }

        $aluno->save();

        return redirect()->route('aluno.perfil')->with('success', 'Perfil atualizado com sucesso!');
    }
}
