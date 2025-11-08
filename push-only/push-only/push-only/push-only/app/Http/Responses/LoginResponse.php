<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        switch ($user->user_type) {
            case 'admin':
                $redirect = '/admin/dashboard';
                break;
            case 'aluno':
                $redirect = '/aluno/dashboard';
                break;
            case 'empresa':
                $redirect = '/empresa/dashboard';
                break;
            case 'orientador':
                $redirect = '/orientador/dashboard';
                break;
            default:
                $redirect = '/dashboard';
                break;
        }

        return redirect()->intended($redirect);
    }
}
