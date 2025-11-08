<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('dashboards.admin');
    })->name('admin.dashboard');

    Route::get('/aluno', function () {
        return view('dashboards.aluno');
    })->name('aluno.dashboard');

    Route::get('/empresa', function () {
        return view('dashboards.empresa');
    })->name('empresa.dashboard');

    Route::get('/orientador', function () {
        return view('dashboards.orientador');
    })->name('orientador.dashboard');

    // Rotas para empresa gerir candidaturas
    Route::get('/empresa/candidaturas', [App\Http\Controllers\EmpresaCandidaturaController::class, 'index'])->name('empresa.candidaturas');
    Route::post('/empresa/candidaturas/{id}/aceitar', [App\Http\Controllers\EmpresaCandidaturaController::class, 'aceitar'])->name('empresa.candidaturas.aceitar');
    Route::post('/empresa/candidaturas/{id}/recusar', [App\Http\Controllers\EmpresaCandidaturaController::class, 'recusar'])->name('empresa.candidaturas.recusar');

});

use App\Http\Controllers\VagaController;

Route::middleware(['auth'])->group(function () {
    Route::resource('vagas', VagaController::class);
});

use App\Http\Controllers\CandidaturaController;

Route::post('/candidatar/{vaga}', [CandidaturaController::class, 'store'])->name('candidaturas.store');
Route::get('/minhas-candidaturas', [CandidaturaController::class, 'minhasCandidaturas'])->name('candidaturas.minhas');

Route::middleware(['auth'])->group(function () {
    Route::get('/candidaturas', [App\Http\Controllers\CandidaturaController::class, 'index'])
        ->name('candidaturas.index');
});

Route::delete('/candidaturas/{id}', [App\Http\Controllers\CandidaturaController::class, 'destroy'])
    ->name('candidaturas.destroy');

use App\Http\Controllers\EmpresaCandidaturaController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/empresa/candidaturas', [EmpresaCandidaturaController::class, 'index'])->name('empresa.candidaturas.index');
    Route::put('/empresa/candidaturas/{id}', [EmpresaCandidaturaController::class, 'update'])->name('empresa.candidaturas.update');
});



require __DIR__.'/auth.php';
