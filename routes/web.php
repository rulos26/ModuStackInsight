<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DocumentUploadComponent;

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



Route::middleware(['auth'])->group(function () {
    Route::get('/documents/upload', [App\Http\Controllers\DocumentController::class, 'showUploadForm'])->name('documents.upload');
    Route::post('/documents/upload', [App\Http\Controllers\DocumentController::class, 'upload']);
    Route::get('/documents', [App\Http\Controllers\DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/{document}', [App\Http\Controllers\DocumentController::class, 'show'])->name('documents.show');
});

