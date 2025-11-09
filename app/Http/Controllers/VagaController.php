<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class VagaController extends Controller
{
    /**
     * Garante que o utilizador autenticado é uma empresa aprovada.
     * Devolve o modelo Empresa ou lança 403 se algo não estiver correto.
     */
    private function ensureEmpresaAprovada(): Empresa
    {
        $user = Auth::user();

        if (!$user || $user->user_type !== 'empresa') {
            throw new HttpException(403, 'Apenas empresas podem gerir vagas.');
        }

        $empresa = Empresa::where('user_id', $user->id)->first();

        if (!$empresa) {
            throw new HttpException(403, 'Registo de empresa não encontrado.');
        }

        // normaliza o estado para evitar problemas com espaços/maiúsculas
        $estado = strtolower(trim((string) $empresa->estado));

        // ajusta aqui ao valor REAL da BD: 'aprovada'
        if ($estado !== 'aprovada') {
            throw new HttpException(
                403,
                'A tua empresa ainda não foi aprovada. Só podes criar e gerir vagas depois da aprovação.'
            );
        }

        return $empresa;
    }

    /**
     * Listagem de vagas:
     * - Empresa → Minhas vagas (se aprovada; se não, mensagem)
     * - Admin   → Todas as vagas
     * - Outros  → Vagas abertas
     */
    public function index()
    {
        $user = Auth::user();

        // EMPRESA: "Minhas Vagas"
        if ($user && $user->user_type === 'empresa') {
            $empresa = Empresa::where('user_id', $user->id)->first();

            if (!$empresa) {
                abort(403, 'Registo de empresa não encontrado.');
            }

            $estado = strtolower(trim((string) $empresa->estado));

            // ainda não aprovada → não mostra vagas, só flag na view
            if ($estado !== 'aprovada') {
                $vagas = collect();
                $pendente = true;

                return view('empresa.vagas.index', compact('vagas', 'pendente'));
            }

            // aprovada → listar vagas desta empresa
            $vagas = Vaga::where('empresa_id', $empresa->id)->get();

            return view('empresa.vagas.index', compact('vagas'));
        }

        // ADMIN: todas as vagas
        if ($user && $user->user_type === 'admin') {
            $vagas = Vaga::with('empresa')->get();

            return view('admin.vagas.index', compact('vagas'));
        }

        // ALUNO / ORIENTADOR / GUEST: só vagas abertas
        $vagas = Vaga::with('empresa')
            ->where('estado', 'aberta')
            ->get();

        return view('vagas.index', compact('vagas'));
    }

    /**
     * Formulário criar vaga (apenas empresa aprovada)
     */
    public function create()
    {
        $this->ensureEmpresaAprovada();

        return view('vagas.create');
    }

    /**
     * Guardar vaga (apenas empresa aprovada)
     */
    public function store(Request $request)
    {
        $empresa = $this->ensureEmpresaAprovada();

        $data = $request->validate([
            'titulo'    => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
        ]);

        $data['empresa_id'] = $empresa->id; // FK para empresas.id
        $data['estado']     = 'aberta';

        Vaga::create($data);

        return redirect()
            ->route('vagas.index')
            ->with('success', 'Vaga criada com sucesso.');
    }

    /**
     * Mostrar detalhes de uma vaga
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
        $empresa = $this->ensureEmpresaAprovada();

        $vaga = Vaga::findOrFail($id);

        if ($vaga->empresa_id !== $empresa->id) {
            abort(403, 'Acesso negado.');
        }

        return view('vagas.edit', compact('vaga'));
    }

    /**
     * Atualizar vaga (apenas empresa dona + aprovada)
     */
    public function update(Request $request, $id)
    {
        $empresa = $this->ensureEmpresaAprovada();

        $vaga = Vaga::findOrFail($id);

        if ($vaga->empresa_id !== $empresa->id) {
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
     * Apagar vaga (apenas empresa dona + aprovada)
     */
    public function destroy(Vaga $vaga)
    {
        $empresa = $this->ensureEmpresaAprovada();

        if ($vaga->empresa_id !== $empresa->id) {
            abort(403, 'Acesso negado.');
        }

        $vaga->delete();

        return redirect()
            ->route('vagas.index')
            ->with('success', 'Vaga eliminada com sucesso.');
    }
}
