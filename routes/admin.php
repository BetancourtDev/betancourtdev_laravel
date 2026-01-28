<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\ProfileController;


Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/leads', [LeadController::class, 'index'])
            ->name('leads.index');

        Route::get('/leads/{lead}', [LeadController::class, 'show'])
            ->name('leads.show');

        Route::patch('/leads/{lead}/status', [LeadController::class, 'updateStatus'])
            ->name('leads.status');

        Route::patch('/leads/{lead}/contacted', [LeadController::class, 'markContacted'])
            ->name('leads.contacted');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
