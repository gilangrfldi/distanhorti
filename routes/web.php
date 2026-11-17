<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendaRapatController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\RapatUserController;
use App\Http\Controllers\TemuUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// User
Route::get('/', function () {
    return view('user.berandaUser.index');
})->name('berandaUser');
Route::get('/rapatUser', [RapatUserController::class, 'rapatUser'])->name('rapatUser');
Route::get('rapat/{agendaRapat}/absensi', [AbsensiController::class, 'create'])->name('absensiUser.create');
Route::post('rapat/{agendaRapat}/absensi', [AbsensiController::class, 'store'])->name('absensiUser.store');
Route::get('rapat/{agendaRapat}/qr-code', [QRCodeController::class, 'generateQRCode'])->name('absensiUser.qr-code');
Route::get('rapat/{agendaRapat}/qr-code/download', [QRCodeController::class, 'downloadQRCode'])->name('public.absensi.qr-code.download');
Route::get('/janji-temu', [TemuUserController::class, 'create'])->name('temuUser.create');
Route::post('/janji-temu', [TemuUserController::class, 'store'])->name('temuUser.store');
Route::get('/janji-temu/fetch', [TemuUserController::class, 'fetchData'])->name('temuUser.fetch');

Route::get('/tentang', function () {
    return view('user.tentangUser.index');
})->name('public.tentang');

// Admin Login
Route::get('/login', [AdminController::class, 'showLoginForm'])->name('loginAdmin');
Route::get('/admin', [AdminController::class, 'showLoginForm'])->name('loginAdmin.form');
Route::post('/admin', [AdminController::class, 'login'])->name('loginAdmin.submit');

Route::middleware('admin.auth')->prefix('admin')->group(function () {
    Route::post('/logout', [AdminController::class, 'logout'])->name('logoutAdmin');
    Route::get('/berandaAdmin', [AdminController::class, 'beranda'])->name('berandaAdmin');

    Route::resource('rapatAdmin', AgendaRapatController::class)
        ->except(['show'])
        ->names('admin.rapatAdmin');
    Route::get('fetch-agenda-rapat', [AgendaRapatController::class, 'fetchDataAdmin'])->name('agenda-rapat.fetch');
    Route::get('rapatAdmin/{agendaRapat}/absensi', [AgendaRapatController::class, 'showAbsensi'])->name('rapatAdmin.absensi');
    Route::delete('absensi/{absensi}', [AbsensiController::class, 'destroy'])->name('absensiAdmin.destroy');

    Route::get('temuAdmin', [TemuUserController::class, 'index'])->name('temuAdmin.index');
    Route::get('fetch-janji-temu', [TemuUserController::class, 'fetchDataAdmin'])->name('temuAdmin.fetch');
    Route::delete('janji-temu/{janjiTemu}', [TemuUserController::class, 'destroy'])->name('temuAdmin.destroy');

    Route::resource('penggunaAdmin', UserController::class)->names('admin.penggunaAdmin');
});
