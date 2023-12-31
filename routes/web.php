<?php

use App\Http\Controllers\Administrator\DashboardController;
use App\Http\Controllers\Administrator\PermohonanController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Applicant\AjuanMerkController;
use App\Http\Controllers\Applicant\PengajuanBaruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

// {{ homepage & dashboard routes }}
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'get_data'])->name('get_data');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// {{ announcement route }}
Route::get('/announcement', [AnnouncementController::class, 'get_announcement'])->name('get_announcement');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// {{ administrator routes }}

Route::name('admin.')
    ->middleware(['role:admin'])
    ->prefix('admin')
    ->group(function () {
        // {{ announcement routes for admin }}
        Route::get('announcement', [AnnouncementController::class, 'index'])->name('announcement.index');
        Route::get('generate-announcement', [AnnouncementController::class, 'generate'])->name('announcement.generate');
        Route::post('announcement', [AnnouncementController::class, 'store'])->name('announcement.store');
        Route::put('announcement/{announcement}', [AnnouncementController::class, 'update'])->name('announcement.update');
        Route::delete('announcement/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');

        // {{ daftar pengguna routes }}
        Route::get('daftar-pengguna', [DashboardController::class, 'daftar_pengguna'])->name('daftar-pengguna.index');
        Route::get('daftar-pengguna/{user}', [DashboardController::class, 'detail_pengguna'])->name('daftar-pengguna.detail');
        Route::delete('daftar-pengguna/{user}', [DashboardController::class, 'destroy'])->name('daftar-pengguna.destroy');
        Route::post('daftar-pengguna', [DashboardController::class, 'grant_admin_role'])->name('daftar-pengguna.grant');
        Route::post('store-admin', [DashboardController::class, 'store'])->name('new-admin.store');

        Route::get('daftar-permohonan', [PermohonanController::class, 'index'])->name('daftar-permohonan.index');
        Route::get('detail/{brand}', [PermohonanController::class, 'detail'])->name('daftar-permohonan.detail');
        Route::post('detail/{brand}', [PermohonanController::class, 'store'])->name('daftar-permohonan.detail.store');
});

// {{-- ------- --}}

// {{ applicant routes }}
Route::name('applicant.')
    ->middleware(['role:applicant'])
    ->prefix('applicant')
    ->group(function () {
        Route::get('ajuan-merk', [AjuanMerkController::class, 'index'])->name('ajuan-merk.index');
        Route::post('data-pdki', [PengajuanBaruController::class, 'get_data_pdki'])->name('ajuan-merk.pdki');
        Route::resource('pengajuan-baru', PengajuanBaruController::class);
});
// {{-- ------- --}}

require __DIR__.'/auth.php';
