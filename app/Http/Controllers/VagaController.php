<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VagaController extends Controller
{
    /**
     * Garante que o user autenticado é uma empresa aprovada.
     * Devolve o registo Empresa ou RedirectResponse se não puder avançar.
     */
    private function getEmpresaAprovadaOrRedirect()
    {
        $user = Auth::user();

        $empresa = Empresa::where('user_id', $user->id)->first();

        if (!$empresa) {
            abort(403, 'Empresa não encontrada.');
        }

        if ($empresa->estado !== 'aprovado') {
            return redirect()
                ->route('empresa.dashboard')
                ->with('error', 'A tua empresa ainda não foi aprovada. Só podes criar e gerir vagas depois da aprovação.');
        }

        return $empresa;
    }

    /**
     * Listagem de vagas:
     * - Empresa → Minhas vagas (filtra por users.id)
     * - Admin   → Todas as vagas
     * - Outros  → Vagas abertas
     */
    public function index()
    {
        $user = Auth::user();

        if ($user && $user->user_type === 'empresa') {
            $empresa = Empresa::where('user_id', $user->id)->first();

            if (!$empresa) {
                abort(403, 'Empresa não encontrada.');
            }

            if ($empresa->estado !== 'aprovado') {
                $vagas = collect();
                $pendente = true;
                return view('empresa.vagas.index', compact('vagas', 'pendente'));
            }

            // ATENÇÃO: empresa_id em vagas referencia users.id
            $vagas = Vaga::where('empresa_id', $user->id)->orderByDesc('id')->get();

            return view('empresa.vagas.index', compact('vagas'));
        }

        if ($user && $user->user_type === 'admin') {
            $vagas = Vaga::with('empresa')->orderByDesc('id')->get();
            return view('admin.vagas.index', compact('vagas'));
        }

        $vagas = Vaga::with('empresa')
            ->where('estado', 'aberta')
            ->orderByDesc('id')
            ->get();

        return view('vagas.index', compact('vagas'));
    }

    /**
     * Formulário criar vaga (empresa aprovada)
     */
    public function create()
    {
        $empresa = $this->getEmpresaAprovadaOrRedirect();
        if ($empresa instanceof \Illuminate\Http\RedirectResponse) {
            return $empresa;
        }

        return view('vagas.create');
    }

    /**
     * Guardar vaga (empresa aprovada)
     */
    public function store(Request $request)
    {
        $empresa = $this->getEmpresaAprovadaOrRedirect();
        if ($empresa instanceof \Illuminate\Http\RedirectResponse) {
            return $empresa;
        }

        $data = $request->validate([
            'titulo'    => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
        ]);

        // >>> FK para users.id (dono da empresa)
        $data['empresa_id'] = Auth::id();
        $data['estado']     = 'aberta';

        Vaga::create($data);

        return redirect()
            ->route('vagas.index')
            ->with('success', 'Vaga criada com sucesso.');
    }

    /**
     * Mostrar detalhes de vaga
     */
    public function show(Vaga $vaga)
    {
        $vaga->load('empresa');
        return view('vagas.show', compact('vaga'));
    }

    /**
     * Editar vaga (apenas empresa dona + aprovada)
     */
    public function edit($id)
    {
        $empresa = $this->getEmpresaAprovadaOrRedirect();
        if ($empresa instanceof \Illuminate\Http\RedirectResponse) {
            return $empresa;
        }

        $vaga = Vaga::findOrFail($id);

        // Dono é o user da empresa (FK para users.id)
        if ($vaga->empresa_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        return view('vagas.edit', compact('vaga'));
    }

    /**
     * Atualizar vaga
     */
    public function update(Request $request, $id)
    {
        $empresa = $this->getEmpresaAprovadaOrRedirect();
        if ($empresa instanceof \Illuminate\Http\RedirectResponse) {
            return $empresa;
        }

        $vaga = Vaga::findOrFail($id);

        if ($vaga->empresa_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $request->validate([
            'titulo'    => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
        ]);

        $vaga->update($request->only('titulo', 'descricao'));

        return redirect()
            ->route('vagas.index')
            ->with('success', 'Vaga atualizada com sucesso!');
    }

    /**
     * Apagar vaga
     */
    public function destroy(Vaga $vaga)
    {
        $empresa = $this->getEmpresaAprovadaOrRedirect();
        if ($empresa instanceof \Illuminate\Http\RedirectResponse) {
            return $empresa;
        }

        if ($vaga->empresa_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $vaga->delete();

        return redirect()
            ->route('vagas.index')
            ->with('success', 'Vaga eliminada com sucesso.');
    }
}
