<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'show'])->name('dashboard');
Route::get('/pegawai', [PegawaiController::class, 'show'])->name('pegawai');
Route::post('/pegawai', [PegawaiController::class, 'store'])->name('tambah-pegawai');
Route::delete('/pegawai/{id}', [PegawaiController::class, 'hapusPegawai'])->name('hapus-pegawai');
