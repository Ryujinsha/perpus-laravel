<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PetugasController;

Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'gaslogin']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('login');
Route::get('/buku', [BukuController::class, 'index'])->middleware('login');
Route::post('/buku/store', [BukuController::class, 'store'])->middleware('login');
Route::get('/buku/delete/{id}', [BukuController::class, 'delete'])->middleware('login');
Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->middleware('login');
Route::post('/buku/update/{id}', [BukuController::class, 'update'])->middleware('login');
Route::get('/buku/search', [BukuController::class, 'search'])->middleware('login');

Route::get('/petugas', [PetugasController::class, 'index'])->middleware('login');
Route::post('/petugas/store', [PetugasController::class, 'store'])->middleware('login');
Route::get('/petugas/delete/{id}', [PetugasController::class, 'delete'])->middleware('login');
Route::get('/petugas/edit/{id}', [PetugasController::class, 'edit'])->middleware('login');
Route::post('/petugas/update/{id}', [PetugasController::class, 'update'])->middleware('login');
Route::get('/petugas/search', [PetugasController::class, 'search'])->middleware('login');
