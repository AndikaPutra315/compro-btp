<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProjectDocumentController;
use App\Http\Controllers\Admin\CompanyPhotoController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\OrganizationController;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/home', function () {
    return auth()->check() ? redirect()->route('admin.dashboard') : redirect()->route('home');
});
Route::get('/produk', [LandingController::class, 'allProducts'])->name('produk.all');

// Auth Routes (Standar untuk menghindari error 'Route [login] not defined')
Route::middleware('guest')->group(function () {
    Route::get('/portal-admin', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/portal-admin', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});

Route::prefix('ruang-manajemen')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('produk', ProductController::class);
    Route::resource('kategori', CategoryController::class);
    Route::resource('dokumentasi', ProjectDocumentController::class);
    Route::resource('foto-tentang', CompanyPhotoController::class);
    Route::resource('klien', ClientController::class);
    Route::resource('organisasi', OrganizationController::class);
    Route::get('ganti-password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('ganti-password', [PasswordController::class, 'update'])->name('password.update');

    // Khusus Super Admin: Manajemen Akun Admin
    Route::middleware('superadmin')->group(function () {
        Route::resource('kelola-admin', AdminUserController::class);
        Route::post('kelola-admin/{admin}/reset-password', [AdminUserController::class, 'resetPassword'])->name('kelola-admin.reset-password');
    });
});
