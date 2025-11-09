<?php

namespace App\Http\Controllers;

use App\Models\Empresa;

class AdminEmpresaController extends Controller
{
    public function index()
    {
        // Ajusta os valores de 'estado' para o que tiveres nas tuas migrations/seeds
        // Se na BD estiver 'aprovado' em vez de 'aprovada', troca ali em baixo.

        $pendentes = Empresa::where('estado', 'pendente')->get();
        $aprovadas = Empresa::where('estado', 'aprovada')->orWhere('estado', 'aprovado')->get();
        $rejeitadas = Empresa::where('estado', 'rejeitada')->get();

        return view('admin.empresas.index', compact('pendentes', 'aprovadas', 'rejeitadas'));
    }

    public function aprovar(Empresa $empresa)
    {
        $empresa->estado = 'aprovada'; // ou 'aprovado' se preferires, mas usa o mesmo em todo o lado
        $empresa->save();

        return redirect()
            ->route('admin.empresas.index')
            ->with('status', 'Empresa aprovada com sucesso.');
    }

    public function rejeitar(Empresa $empresa)
    {
        $empresa->estado = 'rejeitada';
        $empresa->save();

        return redirect()
            ->route('admin.empresas.index')
            ->with('status', 'Empresa rejeitada.');
    }
}
