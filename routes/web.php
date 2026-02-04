<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CookieConsentController;
use App\Http\Controllers\ProfileController;

// --- Rutas Públicas (Landing) ---
Route::get('/', [LandingController::class, 'home'])->name('home');
Route::get('/servicios', [LandingController::class, 'services'])->name('services');
Route::get('/proyectos', [LandingController::class, 'projects'])->name('projects');
Route::get('/contacto', [LandingController::class, 'contact'])->name('contact');

Route::post('/contacto', [ContactController::class, 'send'])
    ->middleware(['throttle:contact'])
    ->name('contact.send');


// --- Legal ---
Route::view('/politica-privacidad', 'legal.privacy')->name('privacy');
Route::get('/cookies', fn() => view('legal.cookies'))->name('cookies');

Route::post('/cookie/accept', [CookieConsentController::class, 'accept'])->name('cookie.accept');
Route::post('/cookie/reject', [CookieConsentController::class, 'reject'])->name('cookie.reject');

// --- Rutas Protegidas (Usuarios Autenticados) ---
Route::middleware('auth')->group(function () {

    // Dashboard con redirección lógica
    Route::get('/dashboard', function () {
        // Si tienes roles, podrías hacer: if(auth()->user()->isAdmin()) ...
        return redirect()->route('admin.leads.index');
    })->name('dashboard');

    // Perfil (Ahora sí protegido)
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
