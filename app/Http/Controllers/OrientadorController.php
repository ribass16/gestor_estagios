<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidatura;

class OrientadorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orientador = $user->orientador;

        if (!$orientador) {
            abort(403, 'Perfil de orientador não encontrado.');
        }

        // Se ainda não foi aprovado
        if ($orientador->estado === 'pendente') {
            return view('orientador.pendente', compact('orientador'));
        }

        // Se foi rejeitado
        if ($orientador->estado === 'rejeitado') {
            return view('orientador.rejeitado', compact('orientador'));
        }

        // Se está aprovado → buscar as candidaturas associadas aos estágios que ele orienta
        if ($orientador->estado === 'aprovado') {
            $candidaturas = Candidatura::with(['aluno.user', 'vaga.empresa'])
                ->whereHas('estagio', function ($q) use ($orientador) {
                    $q->where('orientador_id', $orientador->id);
                })
                ->get();

            return view('orientador.dashboard', compact('orientador', 'candidaturas'));
        }

        // fallback
        return view('orientador.pendente', compact('orientador'));
    }

    public function perfil()
    {
        $user = Auth::user();
        $orientador = $user->orientador;

        return view('orientador.perfil', compact('user', 'orientador'));
    }

    public function editarPerfil()
    {
        $user = Auth::user();
        $orientador = $user->orientador;

        return view('orientador.editar-perfil', compact('user', 'orientador'));
    }

    public function atualizarPerfil(Request $request)
    {
        $user = Auth::user();
        $orientador = $user->orientador;

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'telemovel' => 'nullable|string|max:20',
            'descricao' => 'nullable|string|max:1000',
        ]);

        // Atualizar nome
        $user->name = $request->name;

        // Atualizar password (se preenchida)
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        // Atualizar dados do orientador
        $orientador->telemovel = $request->telemovel;
        $orientador->descricao = $request->descricao;
        $orientador->save();

        return redirect()->route('orientador.perfil')->with('success', 'Perfil atualizado com sucesso!');
    }
}
