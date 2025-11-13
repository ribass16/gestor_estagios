<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Empresa;
use App\Models\Orientador;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'in:aluno,empresa,orientador'],
            // extra campos obrigatórios só se for aluno
            'curso'            => ['required_if:user_type,aluno', 'nullable', 'string', 'max:255'],
            'ano_letivo'       => ['required_if:user_type,aluno', 'nullable', 'string', 'max:255'],
            'numero_estudante' => ['required_if:user_type,aluno', 'nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        // cria perfil consoante o tipo
        switch ($request->user_type) {
            case 'aluno':
                Aluno::create([
                    'user_id'          => $user->id,
                    'curso'            => $request->input('curso'),
                    'ano_letivo'       => $request->input('ano_letivo'),
                    'numero_estudante' => $request->input('numero_estudante'),
                ]);
                break;

            case 'empresa':
                Empresa::create([
                    'user_id' => $user->id,
                    // adiciona aqui campos extra se tiveres
                ]);
                break;

            case 'orientador':
                Orientador::create([
                    'user_id' => $user->id,
                    'estado'  => 'pendente', // por exemplo
                ]);
                break;
        }

        event(new Registered($user));
        Auth::login($user);

        return match ($user->user_type) {
            'aluno'      => redirect()->route('aluno.dashboard'),
            'empresa'    => redirect()->route('empresa.dashboard'),
            'orientador' => redirect()->route('orientador.dashboard'),
            default      => redirect('/'),
        };
    }
}
