<?php

namespace App\Http\Controllers;

use App\Models\Estagio;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminEstagioController extends Controller
{
    /**
     * Listagem + pesquisa + filtros + paginação.
     */
    public function index(Request $request): View
    {
        $q       = trim((string) $request->input('q', ''));
        $estado  = (string) $request->input('estado', '');                 // '', ativo, concluido, cancelado, pendente
        $perPage = (int) $request->input('per_page', 12);
        $perPage = in_array($perPage, [10,12,15,25,50]) ? $perPage : 12;

        $query = Estagio::with([
            'aluno.user',
            'orientador.user',
            'vaga.empresa.user',
        ]);

        if ($q !== '') {
            $query->where(function ($qb) use ($q) {
                // aluno
                $qb->orWhereHas('aluno.user', function ($u) use ($q) {
                    $u->where('name', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%");
                });
                // empresa
                $qb->orWhereHas('vaga.empresa', function ($e) use ($q) {
                    $e->where('nome', 'like', "%{$q}%");
                });
                // orientador
                $qb->orWhereHas('orientador.user', function ($o) use ($q) {
                    $o->where('name', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%");
                });
            });
        }

        if (in_array($estado, ['pendente','ativo','concluido','cancelado'])) {
            $query->where('estado', $estado);
        }

        $estagios = $query->orderByDesc('id')->paginate($perPage)->withQueryString();

        // Cards
        $ativos     = Estagio::where('estado', 'ativo')->count();
        $concluidos = Estagio::where('estado', 'concluido')->count();
        $cancelados = Estagio::where('estado', 'cancelado')->count();
        $pendentes  = Estagio::where('estado', 'pendente')->count();
        $total      = Estagio::count();

        return view('admin.estagios.index', compact(
            'estagios', 'q', 'estado', 'perPage',
            'ativos', 'concluidos', 'cancelados', 'pendentes', 'total'
        ));
    }

    /**
     * Ver detalhe simples (opcional).
     */
    public function show(Estagio $estagio): View
    {
        $estagio->load(['aluno.user','orientador.user','vaga.empresa.user']);
        return view('admin.estagios.show', compact('estagio'));
    }

    /**
     * Mudanças rápidas de estado.
     */
    public function ativar(Estagio $estagio): RedirectResponse
    {
        $estagio->update(['estado' => 'ativo']);
        return back()->with('status', 'Estágio marcado como ativo.');
    }

    public function concluir(Estagio $estagio): RedirectResponse
    {
        $estagio->update(['estado' => 'concluido']);
        return back()->with('status', 'Estágio concluído.');
    }

    public function cancelar(Estagio $estagio): RedirectResponse
    {
        $estagio->update(['estado' => 'cancelado']);
        return back()->with('status', 'Estágio cancelado.');
    }

    public function reabrir(Estagio $estagio): RedirectResponse
    {
        $estagio->update(['estado' => 'ativo']);
        return back()->with('status', 'Estágio reaberto como ativo.');
    }
}
