<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AboutController;

// Redirect halaman utama ke arsip surat
Route::get('/', function () {
    return redirect()->route('surat.index');
});

// Routes untuk Arsip Surat
Route::resource('surat', SuratController::class);

Route::get('/surat/view-pdf/{id}', [SuratController::class, 'showPdf'])->name('surat.view-pdf');

Route::get('surat/{surat}/unduh', [SuratController::class, 'unduh'])->name('surat.unduh');

// Routes untuk Kategori Surat
Route::resource('kategori', KategoriController::class);

// Route untuk Halaman About
Route::get('/about', [AboutController::class, 'index'])->name('about.index');