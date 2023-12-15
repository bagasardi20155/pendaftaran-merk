<?php

use App\Http\Controllers\Applicant\AjuanMerkController;
use App\Http\Controllers\Applicant\PengajuanBaruController;
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

Route::get('/', function () {
    return view('welcome');
});

$active = 'dashboard';
Route::get('/dashboard', function () use($active) {
    return view('dashboard', compact('active'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// {{ administrator routes }}

// Route::name('admin')
//     ->prefix('admin')
//     ->group(['middleware' => 'role:admin'], function () {
//         Route::get('permohonan', [AjuanMerkController::class, 'index'])->name('permohonan.index');
// });

// {{-- ------- --}}

// {{ applicant routes }}
Route::name('applicant.')
    ->middleware(['role:applicant'])
    ->prefix('applicant')
    ->group(function () {
        Route::get('ajuan-merk', [AjuanMerkController::class, 'index'])->name('ajuan-merk.index');
        Route::resource('pengajuan-baru', PengajuanBaruController::class);
});
// {{-- ------- --}}

require __DIR__.'/auth.php';
