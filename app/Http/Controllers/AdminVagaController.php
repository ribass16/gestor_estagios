<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminVagaController extends Controller
{
    /**
     * Lista com pesquisa/estado/paginação + contagens.
     */
    public function index(Request $request)
    {
        $q        = trim((string) $request->input('q', ''));
        $estado   = $request->input('estado', '');          // '', 'aberta', 'fechada'
        $perPage  = (int) $request->input('per_page', 12);  // 👈 aqui
        $perPage  = in_array($perPage, [10,12,15,25,50]) ? $perPage : 12;

        $query = Vaga::with('empresa.user');

        if ($q !== '') {
            $query->where(function($qb) use ($q) {
                $qb->where('titulo', 'like', "%{$q}%")
                ->orWhereHas('empresa', fn($e) => $e->where('nome', 'like', "%{$q}%"));
            });
        }

        if (in_array($estado, ['aberta','fechada'])) {
            $query->where('estado', $estado);
        }

        $vagas    = $query->orderByDesc('id')->paginate($perPage)->withQueryString();
        $abertas  = Vaga::where('estado', 'aberta')->count();
        $fechadas = Vaga::where('estado', 'fechada')->count();
        $total    = Vaga::count();

        return view('admin.vagas.index', compact(
            'vagas','q','estado','perPage', // 👈 enviar $perPage
            'abertas','fechadas','total'
        ));
    }


    /**
     * INSPECIONAR: detalhes da vaga, empresa e candidaturas.
     */
    public function show(Vaga $vaga): View
    {
        $vaga->load([
            'empresa.user',
            'candidaturas.aluno.user',
        ]);

        return view('admin.vagas.show', compact('vaga'));
    }

    /**
     * Fechar vaga (admin).
     */
    public function fechar(Vaga $vaga): RedirectResponse
    {
        $vaga->update(['estado' => 'fechada']);
        return back()->with('status', 'Vaga fechada.');
    }

    /**
     * Abrir vaga (admin).
     */
    public function abrir(Vaga $vaga): RedirectResponse
    {
        $vaga->update(['estado' => 'aberta']);
        return back()->with('status', 'Vaga aberta.');
    }
}
