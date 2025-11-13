<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orientador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrientadorRegisterController extends Controller
{
    public function create()
    {
        return view('auth.register-orientador');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
            'departamento' => ['nullable', 'string', 'max:255'],
            'telemovel'    => ['nullable', 'digits:9'],
        ]);

        // cria user como orientador
        $user = User::create([
            'name'      => $request->nome,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'user_type' => 'orientador',
        ]);

        // perfil orientador pendente
        Orientador::create([
            'user_id'      => $user->id,
            'departamento' => $request->departamento,
            'telemovel'    => $request->telemovel,
            'estado'       => 'pendente',
        ]);

        return redirect()->route('login')
            ->with('status', 'Registo submetido. Aguarda validação pela coordenação.');
    }
}
