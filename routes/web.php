<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
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

Route::get('/', [AuthController::class, 'show']);
Route::post('/', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:web,pegawai'], function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/pegawai', [PegawaiController::class, 'show'])->name('pegawai');
    Route::post('/pegawai', [PegawaiController::class, 'store'])->name('tambah-pegawai');
    Route::put('/pegawai/{id}', [PegawaiController::class, 'editPegawai'])->name('edit-pegawai');
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'hapusPegawai'])->name('hapus-pegawai');
    Route::get('/absensi', [AbsensiController::class, 'show'])->name('absensi');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('tambah-absensi');
    Route::delete('/absensi/{id}', [AbsensiController::class, 'delete'])->name('hapus-absen');
});
