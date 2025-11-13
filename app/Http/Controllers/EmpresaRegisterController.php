<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmpresaRegisterController extends Controller
{
    public function create()
    {
        return view('auth.register-empresa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_empresa'      => ['required', 'string', 'max:255'],
            'nif'               => ['nullable', 'digits:9', 'unique:empresas,nif'],
            'telemovel'         => ['nullable', 'digits:9'],
            'morada'            => ['nullable', 'string', 'max:255'],
            'website'           => ['nullable', 'string', 'max:255'],
            'setor'             => ['nullable', 'string', 'max:255'],
            'descricao'         => ['nullable', 'string'],
            'contacto_nome'     => ['required', 'string', 'max:255'],
            'contacto_email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'contacto_telefone' => ['required', 'digits:9'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // cria o utilizador da empresa
        $user = User::create([
            'name'      => $request->contacto_nome,
            'email'     => $request->contacto_email,
            'password'  => Hash::make($request->password),
            'user_type' => 'empresa',
        ]);

        // cria o registo da empresa associado
        Empresa::create([
            'user_id'       => $user->id,
            'nome'          => $request->nome_empresa,
            'nif'           => $request->nif,
            'telemovel'     => $request->telemovel,
            'morada'        => $request->morada,
            'website'       => $request->website,
            'setor'         => $request->setor,
            'descricao'     => $request->descricao,
            'aceita_estagios' => true,
            'estado'        => 'pendente',
        ]);

        return redirect()->route('login')
            ->with('status', 'Registo enviado. Aguarda validação pela coordenação.');
    }
}
