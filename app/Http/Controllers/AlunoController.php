<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlunoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('aluno.dashboard', compact('user'));
    }
}
