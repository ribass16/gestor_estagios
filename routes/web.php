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
});

require __DIR__.'/auth.php';
