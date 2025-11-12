<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminAlunoController extends Controller
{
    public function index(Request $request): View
    {
        $q = $request->input('q');

        $alunos = Aluno::with('user')
            ->when($q, function ($query) use ($q) {
                $query->whereHas('user', function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%");
                })->orWhere('numero_estudante', 'like', "%{$q}%")
                  ->orWhere('curso', 'like', "%{$q}%");
            })
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view('admin.alunos.index', compact('alunos', 'q'));
    }

    public function edit(Aluno $aluno): View
    {
        $aluno->load('user');
        return view('admin.alunos.edit', compact('aluno'));
    }

    public function update(Request $request, Aluno $aluno): RedirectResponse
    {
        $request->validate([
            'name'             => ['required','string','max:255'],
            'email'            => ['required','email','max:255'],
            'curso'            => ['nullable','string','max:255'],
            'ano_letivo'       => ['nullable','string','max:255'],
            'numero_estudante' => ['nullable','string','max:255'],
        ]);

        // Atualiza o user
        $aluno->user->name  = $request->name;
        $aluno->user->email = $request->email;
        $aluno->user->save();

        // Atualiza o perfil aluno
        $aluno->update($request->only('curso','ano_letivo','numero_estudante'));

        return redirect()->route('admin.alunos.index')->with('status', 'Aluno atualizado com sucesso.');
    }

    public function destroy(Aluno $aluno): RedirectResponse
    {
        // Se quiseres apagar o user também (cascata), garante FK ON DELETE CASCADE,
        // ou então apaga manualmente:
        /** @var User $user */
        $user = $aluno->user;
        $aluno->delete();
        if ($user) {
            $user->delete();
        }

        return back()->with('status', 'Aluno apagado.');
    }
}
