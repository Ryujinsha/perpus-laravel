<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PetugasController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/mitra', function () {
    return view('mitra');
})->name('mitra');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'gaslogin'])->name('login.process');
});

Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('buku')->name('buku.')->group(function () {
        Route::get('/', [BukuController::class, 'index'])->name('index'); 
        Route::get('/create', [BukuController::class, 'create'])->name('create'); 
        Route::post('/store', [BukuController::class, 'store'])->name('store'); 
        
        Route::get('/edit/{id}', [BukuController::class, 'edit'])->name('edit'); 
        Route::put('/update/{id}', [BukuController::class, 'update'])->name('update'); 
        
        Route::delete('/delete/{id}', [BukuController::class, 'delete'])->name('delete'); 
        Route::get('/search', [BukuController::class, 'search'])->name('search');
    });

    Route::prefix('petugas')->name('petugas.')->group(function () {
        Route::get('/', [PetugasController::class, 'index'])->name('index');
        Route::post('/store', [PetugasController::class, 'store'])->name('store');
        
        Route::get('/edit/{id}', [PetugasController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PetugasController::class, 'update'])->name('update');
        
        Route::delete('/delete/{id}', [PetugasController::class, 'delete'])->name('delete');
        Route::get('/search', [PetugasController::class, 'search'])->name('search');
    });

});