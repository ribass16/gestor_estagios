<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class OrientadorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orientador = $user->orientador;

        if (!$orientador) {
            abort(403, 'Perfil de orientador não encontrado.');
        }

        if ($orientador->estado === 'pendente') {
            return view('orientador.pendente', compact('orientador'));
        }

        if ($orientador->estado === 'rejeitado') {
            return view('orientador.rejeitado', compact('orientador'));
        }

        if ($orientador->estado === 'aprovado') {
            $estagios = Estagio::with(['aluno.user', 'empresa', 'vaga'])
                ->where('orientador_id', $orientador->id)
                ->where('estado', 'ativo')
                ->get();

            return view('orientador.dashboard', compact('orientador', 'estagios'));
        }


        // aqui está aprovado → mostra dashboard real
        return view('orientador.dashboard', compact('orientador'));
    }
}
