<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('superadmin')) {
            return view('dashboards.superadmin');
        } elseif ($user->hasRole('admin')) {
            return view('dashboards.admin');
        } elseif ($user->hasRole('evaluador')) {
            return view('dashboards.evaluador');
        }

        abort(403); // Si no tiene rol válido
    })->name('dashboard');
});
