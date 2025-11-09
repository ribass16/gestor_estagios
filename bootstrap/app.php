<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Http\Middleware\UserTypeMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',   // vamos já garantir que este existe
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // Alias para poderes usar 'user_type:admin' nas rotas
        $middleware->alias([
            'user_type' => UserTypeMiddleware::class,
        ]);

        // Se no teu app.php original já havia mais config aqui, manténs e só juntas este alias.
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
