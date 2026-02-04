<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LeadController;

// Agregamos un middleware de 'admin' o un 'can:access-admin'
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Usamos Route::controller para no repetir LeadController::class
        Route::controller(LeadController::class)->prefix('leads')->name('leads.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{lead}', 'show')->name('show');
            Route::patch('/{lead}/status', 'updateStatus')->name('status');
            Route::patch('/{lead}/contacted', 'markContacted')->name('contacted');
        });
    });
