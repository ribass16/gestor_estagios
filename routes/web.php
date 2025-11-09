<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\OrientadorController;
use App\Http\Controllers\CandidaturaController;
use App\Http\Controllers\EmpresaCandidaturaController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\EmpresaRegisterController;
use App\Http\Controllers\AdminEmpresaController;
use App\Http\Controllers\AdminOrientadorController;
use App\Http\Controllers\OrientadorRegisterController;
use App\Http\Controllers\AlunoOrientadorController;

// ====================== HOME ======================

Route::get('/', function () {
    if (Auth::check()) {
        switch (Auth::user()->user_type) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'aluno':
                return redirect()->route('aluno.dashboard');
            case 'empresa':
                return redirect()->route('empresa.dashboard');
            case 'orientador':
                return redirect()->route('orientador.dashboard');
        }
    }

    return view('welcome');
});

// ====================== AUTH DEFAULT (BREEZE) ======================

require __DIR__.'/auth.php';

// ====================== REGISTO PÚBLICO EMPRESA & ORIENTADOR ======================

Route::middleware('guest')->group(function () {
    Route::get('/registar-empresa', [EmpresaRegisterController::class, 'create'])
        ->name('empresa.register.create');
    Route::post('/registar-empresa', [EmpresaRegisterController::class, 'store'])
        ->name('empresa.register.store');

    Route::get('/registar-orientador', [OrientadorRegisterController::class, 'create'])
        ->name('orientador.register.create');
    Route::post('/registar-orientador', [OrientadorRegisterController::class, 'store'])
        ->name('orientador.register.store');
});

// ====================== VAGAS VISÍVEIS (ALUNO / QUALQUER AUTENTICADO) ======================

Route::get('/vagas', [VagaController::class, 'index'])->name('vagas.index');

Route::get('/vagas/{vaga}', [VagaController::class, 'show'])
    ->name('vagas.show')
    ->whereNumber('vaga'); // garante que 'create' não cai aqui

// ====================== ADMIN ======================

Route::middleware(['auth', 'user_type:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Empresas
    Route::get('/admin/empresas', [AdminEmpresaController::class, 'index'])->name('admin.empresas.index');
    Route::post('/admin/empresas/{empresa}/aprovar', [AdminEmpresaController::class, 'aprovar'])->name('admin.empresas.aprovar');
    Route::post('/admin/empresas/{empresa}/rejeitar', [AdminEmpresaController::class, 'rejeitar'])->name('admin.empresas.rejeitar');

    // Orientadores
    Route::get('/admin/orientadores', [AdminOrientadorController::class, 'index'])->name('admin.orientadores.index');
    Route::get('/admin/orientadores/create', [AdminOrientadorController::class, 'create'])->name('admin.orientadores.create');
    Route::post('/admin/orientadores', [AdminOrientadorController::class, 'store'])->name('admin.orientadores.store');
    Route::post('/admin/orientadores/{orientador}/aprovar', [AdminOrientadorController::class, 'aprovar'])->name('admin.orientadores.aprovar');
    Route::post('/admin/orientadores/{orientador}/rejeitar', [AdminOrientadorController::class, 'rejeitar'])->name('admin.orientadores.rejeitar');
});

// ====================== ALUNO ======================

Route::middleware(['auth', 'user_type:aluno'])->group(function () {
    Route::get('/aluno', [AlunoController::class, 'index'])->name('aluno.dashboard');

    Route::get('/candidaturas', [CandidaturaController::class, 'index'])->name('candidaturas.index');
    Route::post('/candidatar/{vaga}', [CandidaturaController::class, 'store'])->name('candidaturas.store');
    Route::delete('/candidaturas/{id}', [CandidaturaController::class, 'destroy'])->name('candidaturas.destroy');

    Route::get('/candidaturas/{candidatura}/orientador', [AlunoOrientadorController::class, 'create'])
        ->name('aluno.candidaturas.orientador.create');
    Route::post('/candidaturas/{candidatura}/orientador', [AlunoOrientadorController::class, 'store'])
        ->name('aluno.candidaturas.orientador.store');
});

// ====================== EMPRESA ======================

Route::middleware(['auth', 'user_type:empresa'])->group(function () {
    Route::get('/empresa', [EmpresaController::class, 'index'])->name('empresa.dashboard');

    // gestão de vagas (apenas empresa)
    Route::get('/vagas/create', [VagaController::class, 'create'])->name('vagas.create');
    Route::post('/vagas', [VagaController::class, 'store'])->name('vagas.store');
    Route::get('/vagas/{vaga}/edit', [VagaController::class, 'edit'])->name('vagas.edit');
    Route::put('/vagas/{vaga}', [VagaController::class, 'update'])->name('vagas.update');
    Route::delete('/vagas/{vaga}', [VagaController::class, 'destroy'])->name('vagas.destroy');

    // candidaturas às vagas da empresa
    Route::get('/empresa/candidaturas', [EmpresaCandidaturaController::class, 'index'])->name('empresa.candidaturas.index');
    Route::post('/empresa/candidaturas/{id}/aceitar', [EmpresaCandidaturaController::class, 'aceitar'])->name('empresa.candidaturas.aceitar');
    Route::post('/empresa/candidaturas/{id}/recusar', [EmpresaCandidaturaController::class, 'recusar'])->name('empresa.candidaturas.recusar');
});

// ====================== ORIENTADOR ======================

Route::middleware(['auth', 'user_type:orientador'])->group(function () {
    Route::get('/orientador', [OrientadorController::class, 'index'])->name('orientador.dashboard');
});

// ====================== FORCE LOGOUT (DEV) ======================

Route::get('/force-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});
