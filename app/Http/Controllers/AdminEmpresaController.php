<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminEmpresaController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->input('q'));

        $baseQuery = Empresa::with('user');

        if ($q !== '') {
            $baseQuery->where(function ($qb) use ($q) {
                $qb->where('nome', 'like', "%{$q}%")
                   ->orWhere('email_contacto', 'like', "%{$q}%")
                   ->orWhere('nif', 'like', "%{$q}%")
                   ->orWhere('setor', 'like', "%{$q}%")
                   ->orWhere('responsavel_nome', 'like', "%{$q}%")
                   ->orWhere('responsavel_email', 'like', "%{$q}%");
            });
        }

        $pendentesCount  = Empresa::where('estado', 'pendente')->count();
        $aprovadasCount  = Empresa::whereIn('estado', ['aprovada','aprovado'])->count();
        $rejeitadasCount = Empresa::where('estado', 'rejeitada')->count();

        $empresas = $baseQuery->orderByDesc('id')->paginate(12)->withQueryString();

        return view('admin.empresas.index', compact(
            'empresas','q','pendentesCount','aprovadasCount','rejeitadasCount'
        ));
    }

    public function create(): View
    {
        return view('admin.empresas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // LOGIN (responsável)
            'responsavel_nome'      => ['required','string','max:255'],
            'responsavel_email'     => ['required','email','max:255','unique:users,email'],
            'password'              => ['required','string','min:8','confirmed'],

            // EMPRESA
            'nome'                  => ['required','string','max:255'],
            'nif'                   => ['nullable','string','max:32'],
            'email_contacto'        => ['nullable','email','max:255'],
            'telemovel'             => ['nullable','string','max:50'],
            'morada'                => ['nullable','string','max:255'],
            'website'               => ['nullable','string','max:255'],
            'setor'                 => ['nullable','string','max:255'],
            'descricao'             => ['nullable','string'],
            'aceita_estagios'       => ['nullable','boolean'],
            'estado'                => ['required','in:pendente,aprovada,rejeitada'],

            // Se quiseres permitir override no form de responsável (secção em baixo)
            'responsavel_telemovel' => ['nullable','string','max:50'],
        ]);

        // 1) User = responsável
        $user = User::create([
            'name'      => $request->responsavel_nome,
            'email'     => $request->responsavel_email,
            'password'  => Hash::make($request->password),
            'user_type' => 'empresa',
        ]);

        // 2) Empresa
        Empresa::create([
            'user_id'               => $user->id,
            'nome'                  => $request->nome,
            'nif'                   => $request->nif,
            'email_contacto'        => $request->email_contacto,
            'telemovel'             => $request->telemovel,
            'morada'                => $request->morada,
            'website'               => $request->website,
            'setor'                 => $request->setor,
            'descricao'             => $request->descricao,
            'aceita_estagios'       => (bool) $request->aceita_estagios,
            'estado'                => $request->estado,

            'responsavel_nome'      => $request->responsavel_nome,
            'responsavel_email'     => $request->responsavel_email,
            'responsavel_telemovel' => $request->responsavel_telemovel,
        ]);

        return redirect()->route('admin.empresas.index')
            ->with('status','Empresa criada com sucesso.');
    }

    public function edit(Empresa $empresa): View
    {
        $empresa->load('user');
        return view('admin.empresas.edit', compact('empresa'));
    }

    public function update(Request $request, Empresa $empresa): RedirectResponse
    {
        $request->validate([
            // LOGIN (responsável)
            'responsavel_nome'      => ['required','string','max:255'],
            'responsavel_email'     => ['required','email','max:255','unique:users,email,'.$empresa->user_id],
            'password'              => ['nullable','string','min:8','confirmed'],

            // EMPRESA
            'nome'                  => ['required','string','max:255'],
            'nif'                   => ['nullable','string','max:32'],
            'email_contacto'        => ['nullable','email','max:255'],
            'telemovel'             => ['nullable','string','max:50'],
            'morada'                => ['nullable','string','max:255'],
            'website'               => ['nullable','string','max:255'],
            'setor'                 => ['nullable','string','max:255'],
            'descricao'             => ['nullable','string'],
            'aceita_estagios'       => ['nullable','boolean'],
            'estado'                => ['required','in:pendente,aprovada,rejeitada'],

            'responsavel_telemovel' => ['nullable','string','max:50'],
        ]);

        // atualizar user (login)
        if ($empresa->user) {
            $empresa->user->name  = $request->responsavel_nome;
            $empresa->user->email = $request->responsavel_email;
            if ($request->filled('password')) {
                $empresa->user->password = Hash::make($request->password);
            }
            $empresa->user->save();
        }

        // atualizar empresa
        $empresa->update([
            'nome'                  => $request->nome,
            'nif'                   => $request->nif,
            'email_contacto'        => $request->email_contacto,
            'telemovel'             => $request->telemovel,
            'morada'                => $request->morada,
            'website'               => $request->website,
            'setor'                 => $request->setor,
            'descricao'             => $request->descricao,
            'aceita_estagios'       => (bool) $request->aceita_estagios,
            'estado'                => $request->estado,

            'responsavel_nome'      => $request->responsavel_nome,
            'responsavel_email'     => $request->responsavel_email,
            'responsavel_telemovel' => $request->responsavel_telemovel,
        ]);

        return redirect()->route('admin.empresas.index')->with('status','Empresa atualizada.');
    }

    public function aprovar(Empresa $empresa): RedirectResponse
    {
        $empresa->update(['estado' => 'aprovada']);
        return back()->with('status','Empresa aprovada com sucesso.');
    }

    public function rejeitar(Empresa $empresa): RedirectResponse
    {
        $empresa->update(['estado' => 'rejeitada']);
        return back()->with('status','Empresa rejeitada.');
    }

    public function destroy(Empresa $empresa): RedirectResponse
    {
        $user = $empresa->user;
        $empresa->delete();
        if ($user) $user->delete();
        return back()->with('status','Empresa removida.');
    }
}
