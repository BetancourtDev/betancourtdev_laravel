<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CookieConsentController;
use App\Http\Controllers\ProfileController;

Route::get('/', [LandingController::class, 'home'])->name('home');
Route::get('/servicios', [LandingController::class, 'services'])->name('services');
Route::get('/proyectos', [LandingController::class, 'projects'])->name('projects');
Route::get('/contacto', [LandingController::class, 'contact'])->name('contact');

Route::post('/contacto', [ContactController::class, 'send'])
    ->middleware(['throttle:contact'])
    ->name('contact.send');

Route::view('/politica-privacidad', 'legal.privacy')->name('privacy');
Route::get('/cookies', fn() => view('legal.cookies'))->name('cookies');

Route::post('/cookie/accept', [CookieConsentController::class, 'accept'])->name('cookie.accept');
Route::post('/cookie/reject', [CookieConsentController::class, 'reject'])->name('cookie.reject');

Route::get('/dashboard', function () {
    return redirect()->route('admin.leads.index');
})->middleware(['auth'])->name('dashboard');


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__ . '/admin.php';
