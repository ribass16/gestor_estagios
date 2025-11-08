<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Mostra o formulário de login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Processa o login e redireciona conforme o tipo de utilizador.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('As credenciais inseridas não estão corretas.'),
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        switch ($user->user_type) {
            case 'admin':
                return redirect()->intended('/admin');
            case 'aluno':
                return redirect()->intended('/aluno');
            case 'empresa':
                return redirect()->intended('/empresa');
            case 'orientador':
                return redirect()->intended('/orientador');
            default:
                return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Faz logout do utilizador.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
