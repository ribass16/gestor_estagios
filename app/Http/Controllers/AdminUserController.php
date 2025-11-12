<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function impersonate(User $user, Request $request)
    {
        $admin = Auth::user();
        if ($admin->user_type !== 'admin') abort(403);

        $request->session()->put('impersonate_admin_id', $admin->id);
        Auth::login($user);

        return redirect('/')->with('success', "A atuar como {$user->name} ({$user->user_type}).");
    }

    public function stopImpersonate(Request $request)
    {
        $adminId = $request->session()->pull('impersonate_admin_id');
        if ($adminId) {
            Auth::loginUsingId($adminId);
            return redirect()->route('admin.dashboard')->with('success', 'Voltaste ao modo admin.');
        }
        return redirect('/')->with('success', 'Sessão normal.');
    }
}
