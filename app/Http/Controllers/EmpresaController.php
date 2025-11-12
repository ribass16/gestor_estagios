<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    // PERFIL DA EMPRESA
    public function perfil()
    {
        $user = Auth::user();
        $empresa = $user->empresa;

        return view('empresa.perfil', compact('user', 'empresa'));
    }

    public function editarPerfil()
    {
        $user = Auth::user();
        $empresa = $user->empresa;

        return view('empresa.editar-perfil', compact('user', 'empresa'));
    }

    public function atualizarPerfil(Request $request)
    {
        $user = Auth::user();
        $empresa = $user->empresa;

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'telemovel' => 'nullable|string|max:20',
            'descricao' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Atualizar nome
        $user->name = $request->name;

        // Atualizar password (se preenchida)
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        // Atualizar dados da empresa
        $empresa->telemovel = $request->telemovel;
        $empresa->descricao = $request->descricao;

        // Upload do logótipo (opcional)
        if ($request->hasFile('logo')) {
            $ficheiro = $request->file('logo');
            $nomeFicheiro = 'logo_empresa_' . $empresa->id . '.' . $ficheiro->getClientOriginalExtension();
            $ficheiro->storeAs('logos', $nomeFicheiro, 'public');
            $empresa->logo_path = 'storage/logos/' . $nomeFicheiro;
        }

        $empresa->save();

        return redirect()->route('empresa.perfil')->with('success', 'Perfil da empresa atualizado com sucesso!');
    }

    // PERFIL DO RESPONSÁVEL
    public function perfilResponsavel()
    {
        $user = Auth::user();
        $empresa = $user->empresa;

        return view('empresa.responsavel', compact('user', 'empresa'));
    }

    public function editarResponsavel()
    {
        $user = Auth::user();
        $empresa = $user->empresa;

        return view('empresa.editar-responsavel', compact('user', 'empresa'));
    }

    public function atualizarResponsavel(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('empresa.responsavel')->with('success', 'Perfil do responsável atualizado com sucesso!');
    }
}
