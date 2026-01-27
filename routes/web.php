<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CookieConsentController;

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
