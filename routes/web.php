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
            case 'admin': return redirect()->route('admin.dashboard');
            case 'aluno': return redirect()->route('aluno.dashboard');
            case 'empresa': return redirect()->route('empresa.dashboard');
            case 'orientador': return redirect()->route('orientador.dashboard');
        }
    }
    return view('welcome');
});

// ====================== AUTH DEFAULT (BREEZE) ======================

require __DIR__ . '/auth.php';

// ====================== REGISTO PÚBLICO (EMPRESA & ORIENTADOR) ======================

Route::middleware('guest')->group(function () {
    Route::get('/registar-empresa', [EmpresaRegisterController::class, 'create'])->name('empresa.register.create');
    Route::post('/registar-empresa', [EmpresaRegisterController::class, 'store'])->name('empresa.register.store');

    Route::get('/registar-orientador', [OrientadorRegisterController::class, 'create'])->name('orientador.register.create');
    Route::post('/registar-orientador', [OrientadorRegisterController::class, 'store'])->name('orientador.register.store');
});

// ====================== VAGAS VISÍVEIS (GERAL / ALUNO) ======================

Route::get('/vagas', [VagaController::class, 'index'])->name('vagas.index');
Route::get('/vagas/{vaga}', [VagaController::class, 'show'])
    ->name('vagas.show')
    ->whereNumber('vaga');

// ====================== ADMIN ======================
Route::middleware(['auth', 'user_type:admin'])->group(function () {
    Route::get('/admin', [\App\Http\Controllers\AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Empresas
    Route::get('/admin/empresas', [\App\Http\Controllers\AdminEmpresaController::class, 'index'])->name('admin.empresas.index');
    Route::post('/admin/empresas/{empresa}/aprovar', [\App\Http\Controllers\AdminEmpresaController::class, 'aprovar'])->name('admin.empresas.aprovar');
    Route::post('/admin/empresas/{empresa}/rejeitar', [\App\Http\Controllers\AdminEmpresaController::class, 'rejeitar'])->name('admin.empresas.rejeitar');
    Route::get('/admin/empresas/export/csv', [\App\Http\Controllers\AdminEmpresaController::class, 'exportCsv'])->name('admin.empresas.export.csv');

    Route::get('/admin/empresas', [\App\Http\Controllers\AdminEmpresaController::class, 'index'])->name('admin.empresas.index');
    Route::get('/admin/empresas/create', [\App\Http\Controllers\AdminEmpresaController::class, 'create'])->name('admin.empresas.create');
    Route::post('/admin/empresas', [\App\Http\Controllers\AdminEmpresaController::class, 'store'])->name('admin.empresas.store');
    Route::get('/admin/empresas/{empresa}/edit', [\App\Http\Controllers\AdminEmpresaController::class, 'edit'])->name('admin.empresas.edit');
    Route::put('/admin/empresas/{empresa}', [\App\Http\Controllers\AdminEmpresaController::class, 'update'])->name('admin.empresas.update');
    Route::delete('/admin/empresas/{empresa}', [\App\Http\Controllers\AdminEmpresaController::class, 'destroy'])->name('admin.empresas.destroy');
    Route::post('/admin/empresas/{empresa}/aprovar', [\App\Http\Controllers\AdminEmpresaController::class, 'aprovar'])->name('admin.empresas.aprovar');
    Route::post('/admin/empresas/{empresa}/rejeitar', [\App\Http\Controllers\AdminEmpresaController::class, 'rejeitar'])->name('admin.empresas.rejeitar');


    // Alunos (ex: só listagem e pesquisa – replica o padrão)
    Route::get('/admin/alunos', [\App\Http\Controllers\AdminAlunoController::class, 'index'])->name('admin.alunos.index');

    Route::get('/admin/alunos',                [\App\Http\Controllers\AdminAlunoController::class, 'index'])->name('admin.alunos.index');
    Route::get('/admin/alunos/create',         [\App\Http\Controllers\AdminAlunoController::class, 'create'])->name('admin.alunos.create');
    Route::post('/admin/alunos',               [\App\Http\Controllers\AdminAlunoController::class, 'store'])->name('admin.alunos.store');
    Route::get('/admin/alunos/{aluno}/edit',   [\App\Http\Controllers\AdminAlunoController::class, 'edit'])->name('admin.alunos.edit');
    Route::put('/admin/alunos/{aluno}',        [\App\Http\Controllers\AdminAlunoController::class, 'update'])->name('admin.alunos.update');
    Route::delete('/admin/alunos/{aluno}',     [\App\Http\Controllers\AdminAlunoController::class, 'destroy'])->name('admin.alunos.destroy');

    // Orientadores
    Route::get('/admin/orientadores', [AdminOrientadorController::class, 'index'])->name('admin.orientadores.index');
    Route::get('/admin/orientadores/create', [AdminOrientadorController::class, 'create'])->name('admin.orientadores.create');
    Route::post('/admin/orientadores', [AdminOrientadorController::class, 'store'])->name('admin.orientadores.store');
    Route::get('/admin/orientadores/{orientador}/edit', [AdminOrientadorController::class, 'edit'])->name('admin.orientadores.edit');
    Route::put('/admin/orientadores/{orientador}', [AdminOrientadorController::class, 'update'])->name('admin.orientadores.update');
    Route::delete('/admin/orientadores/{orientador}', [AdminOrientadorController::class, 'destroy'])->name('admin.orientadores.destroy');

    Route::post('/admin/orientadores/{orientador}/aprovar', [AdminOrientadorController::class, 'aprovar'])->name('admin.orientadores.aprovar');
    Route::post('/admin/orientadores/{orientador}/rejeitar', [AdminOrientadorController::class, 'rejeitar'])->name('admin.orientadores.rejeitar');


    // Vagas
    Route::get('/admin/vagas', [\App\Http\Controllers\AdminVagaController::class, 'index'])->name('admin.vagas.index');
    Route::get('/admin/vagas/{vaga}', [\App\Http\Controllers\AdminVagaController::class, 'show'])->name('admin.vagas.show');
    Route::post('/admin/vagas/{vaga}/fechar', [\App\Http\Controllers\AdminVagaController::class, 'fechar'])->name('admin.vagas.fechar');
    Route::post('/admin/vagas/{vaga}/abrir',  [\App\Http\Controllers\AdminVagaController::class, 'abrir'])->name('admin.vagas.abrir');


    // Candidaturas
    Route::get('/admin/candidaturas', [\App\Http\Controllers\AdminCandidaturaController::class, 'index'])->name('admin.candidaturas.index');

    // Estágios
    Route::get('/admin/estagios', [\App\Http\Controllers\AdminEstagioController::class, 'index'])
        ->name('admin.estagios.index');
    Route::get('/admin/estagios/{estagio}', [\App\Http\Controllers\AdminEstagioController::class, 'show'])
        ->name('admin.estagios.show');

    Route::post('/admin/estagios/{estagio}/ativar',   [\App\Http\Controllers\AdminEstagioController::class, 'ativar'])->name('admin.estagios.ativar');
    Route::post('/admin/estagios/{estagio}/concluir', [\App\Http\Controllers\AdminEstagioController::class, 'concluir'])->name('admin.estagios.concluir');
    Route::post('/admin/estagios/{estagio}/cancelar', [\App\Http\Controllers\AdminEstagioController::class, 'cancelar'])->name('admin.estagios.cancelar');
    Route::post('/admin/estagios/{estagio}/reabrir',  [\App\Http\Controllers\AdminEstagioController::class, 'reabrir'])->name('admin.estagios.reabrir');

    // Impersonate (entrar como utilizador e voltar)
    Route::post('/admin/impersonate/{user}', [\App\Http\Controllers\AdminUserController::class, 'impersonate'])->name('admin.impersonate');
    Route::post('/admin/impersonate/stop', [\App\Http\Controllers\AdminUserController::class, 'stopImpersonate'])->name('admin.impersonate.stop');
});


// ====================== ALUNO ======================

Route::middleware(['auth', 'user_type:aluno'])->group(function () {
    Route::get('/aluno', [AlunoController::class, 'index'])->name('aluno.dashboard');

    // Candidaturas
    Route::get('/candidaturas', [CandidaturaController::class, 'index'])->name('candidaturas.index');
    Route::post('/candidatar/{vaga}', [CandidaturaController::class, 'store'])->name('candidaturas.store');
    Route::delete('/candidaturas/{id}', [CandidaturaController::class, 'destroy'])->name('candidaturas.destroy');

    // Escolher Orientador
    Route::get('/candidaturas/{candidatura}/orientador', [AlunoOrientadorController::class, 'create'])
        ->name('aluno.candidaturas.orientador.create');
    Route::post('/candidaturas/{candidatura}/orientador', [AlunoOrientadorController::class, 'store'])
        ->name('aluno.candidaturas.orientador.store');

    // Perfil
    Route::get('/aluno/perfil', [AlunoController::class, 'perfil'])->name('aluno.perfil');
    Route::get('/aluno/perfil/editar', [AlunoController::class, 'editarPerfil'])->name('aluno.perfil.editar');
    Route::post('/aluno/perfil/atualizar', [AlunoController::class, 'atualizarPerfil'])->name('aluno.perfil.atualizar');
});

// ====================== EMPRESA ======================

Route::middleware(['auth', 'user_type:empresa'])->group(function () {
    Route::get('/empresa', [EmpresaController::class, 'index'])->name('empresa.dashboard');

    // Gestão de vagas
    Route::get('/vagas/create', [VagaController::class, 'create'])->name('vagas.create');
    Route::post('/vagas', [VagaController::class, 'store'])->name('vagas.store');
    Route::get('/vagas/{vaga}/edit', [VagaController::class, 'edit'])->name('vagas.edit');
    Route::put('/vagas/{vaga}', [VagaController::class, 'update'])->name('vagas.update');
    Route::delete('/vagas/{vaga}', [VagaController::class, 'destroy'])->name('vagas.destroy');

    // Candidaturas recebidas
    Route::get('/empresa/candidaturas', [EmpresaCandidaturaController::class, 'index'])->name('empresa.candidaturas.index');
    Route::post('/empresa/candidaturas/{id}/aceitar', [EmpresaCandidaturaController::class, 'aceitar'])->name('empresa.candidaturas.aceitar');
    Route::post('/empresa/candidaturas/{id}/recusar', [EmpresaCandidaturaController::class, 'recusar'])->name('empresa.candidaturas.recusar');


    // Perfil da Empresa
    Route::get('/empresa/perfil', [EmpresaController::class, 'perfil'])->name('empresa.perfil');
    Route::get('/empresa/perfil/editar', [EmpresaController::class, 'editarPerfil'])->name('empresa.perfil.editar');
    Route::post('/empresa/perfil/atualizar', [EmpresaController::class, 'atualizarPerfil'])->name('empresa.perfil.atualizar');

    // Perfil do Responsável
    Route::get('/empresa/responsavel', [EmpresaController::class, 'perfilResponsavel'])->name('empresa.responsavel');
    Route::get('/empresa/responsavel/editar', [EmpresaController::class, 'editarResponsavel'])->name('empresa.responsavel.editar');
    Route::post('/empresa/responsavel/atualizar', [EmpresaController::class, 'atualizarResponsavel'])->name('empresa.responsavel.atualizar');

});

// ====================== ORIENTADOR ======================

Route::middleware(['auth', 'user_type:orientador'])->group(function () {
    Route::get('/orientador', [OrientadorController::class, 'index'])->name('orientador.dashboard');

    // Perfil
    Route::get('/orientador/perfil', [OrientadorController::class, 'perfil'])->name('orientador.perfil');
    Route::get('/orientador/perfil/editar', [OrientadorController::class, 'editarPerfil'])->name('orientador.perfil.editar');
    Route::post('/orientador/perfil/atualizar', [OrientadorController::class, 'atualizarPerfil'])->name('orientador.perfil.atualizar');
});

// ====================== FORCE LOGOUT (DEV) ======================

Route::get('/force-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});
