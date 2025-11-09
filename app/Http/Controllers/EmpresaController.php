<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $empresa = $user->empresa;

        if (!$empresa) {
            abort(403, 'Perfil de empresa não encontrado.');
        }

        if ($empresa->estado === 'pendente') {
            return view('empresa.pendente', compact('empresa'));
        }

        if ($empresa->estado === 'rejeitada') {
            return view('empresa.rejeitada', compact('empresa'));
        }

        // aprovado → dashboard
        $vagas = $empresa->vagas()->get();

        return view('empresa.dashboard', compact('empresa', 'vagas'));
    }

}
