<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NhanVienController;

Route::get('/', function () {
    return view('welcome');
});

// Web Routes for NhanVien
Route::get('/nhanvien', [NhanVienController::class, 'index'])->name('nhanvien.index');
Route::get('/nhanvien/create', [NhanVienController::class, 'create'])->name('nhanvien.create');
Route::post('/nhanvien', [NhanVienController::class, 'store'])->name('nhanvien.store');
Route::get('/nhanvien/{id}', [NhanVienController::class, 'show'])->name('nhanvien.show');
Route::get('/nhanvien/{id}/edit', [NhanVienController::class, 'edit'])->name('nhanvien.edit');
Route::put('/nhanvien/{id}', [NhanVienController::class, 'update'])->name('nhanvien.update');
Route::delete('/nhanvien/{id}', [NhanVienController::class, 'destroy'])->name('nhanvien.destroy');