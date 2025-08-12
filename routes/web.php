<?php

use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/', fn() => view('dashboard'));
    Route::get('/dashboard', fn() => view('dashboard'));
    Route::get('/profile', App\Http\Controllers\ProfileController::class)->name('profile');
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('roles', App\Http\Controllers\RoleAndPermissionController::class);
    Route::resource('events', App\Http\Controllers\EventController::class);
    Route::get('/participants/search', [ParticipantController::class, 'searchCallsign'])->name('participants.search');
    Route::post('/participants', [ParticipantController::class, 'store'])->name('participants.store');
    Route::get('/events/{event}/participants', [ParticipantController::class, 'getParticipants'])->name('events.participants');
    Route::delete('/participants/{id}', [ParticipantController::class, 'destroy'])->name('participants.destroy');
});
