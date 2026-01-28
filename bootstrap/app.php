<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route; // Importante añadir esta línea

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        // Aquí registras tus archivos personalizados
        then: function () {
            // Rutas de Autenticación (Breeze)
            Route::middleware('web')
                ->group(base_path('routes/auth.php'));

            // Rutas del Panel Administrativo (CRM)
            Route::middleware(['web', 'auth', 'verified'])
                ->prefix('admin') // Todas las URLs empezarán con /admin/
                ->name('admin.')   // Los nombres de ruta serán admin.nombre
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Configuraciones globales de middleware si las necesitas
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
