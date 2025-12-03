<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruMateriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\TugasSiswaController;
use Illuminate\Support\Facades\Route;

Route::get('login', LoginController::class)->name('login');
Route::post('login', [LoginController::class, 'checkLogin'])->name('login.check');
Route::get('logout',[LoginController::class,'logout'])->name('auth.logout');

//authenticated guarded
Route::middleware('authenticated')->group(function () {
    Route::get('/', DashboardController::class)->name('home');
    Route::middleware('authenticated:siswa')->group(function () {
        Route::get('/siswa/materi', [MateriController::class, 'showMateri'])->name('siswa.materi');
        Route::get('/siswa/tugas', TugasSiswaController::class)->name('siswa.tugas');
        Route::get('/siswa/materi/{id}', [MateriController::class, 'view'])->name('siswa.materi.view');
    });
    Route::middleware('authenticated:guru')->group(function () {
        Route::get('/guru/materi/{kelas_kode?}', [GuruMateriController::class, 'materi'])->name('guru.materi');
        Route::get('/guru/materi/{kelas_kode?}/tambah-materi', [GuruMateriController::class, 'tambahMateri'])->name('guru.materi.tambah');
    });
});
