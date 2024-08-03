<?php

use App\Http\Controllers\KaprodiController;
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

// Rute untuk dosen
Route::prefix('kaprodi/dosen')->name('kaprodi.dosen.')->group(function () {
    Route::get('/', [KaprodiController::class, 'indexDosen'])->name('index');
    Route::get('/create', [KaprodiController::class, 'createDosen'])->name('create');
    Route::post('/store', [KaprodiController::class, 'storeDosen'])->name('store');
    Route::get('/{dosen}/edit', [KaprodiController::class, 'editDosen'])->name('edit');
    Route::put('/{dosen}', [KaprodiController::class, 'updateDosen'])->name('update');
    Route::delete('/{dosen}', [KaprodiController::class, 'destroyDosen'])->name('destroy');
});

// Rute untuk kelas
Route::prefix('kaprodi/kelas')->name('kaprodi.kelas.')->group(function () {
    Route::get('/', [KaprodiController::class, 'indexKelas'])->name('index');
    Route::get('/create', [KaprodiController::class, 'createKelas'])->name('create');
    Route::post('/store', [KaprodiController::class, 'storeKelas'])->name('store');
    Route::get('/{kelas}/edit', [KaprodiController::class, 'editKelas'])->name('edit');
    Route::put('/{kelas}', [KaprodiController::class, 'updateKelas'])->name('update');
    Route::delete('/{kelas}', [KaprodiController::class, 'destroyKelas'])->name('destroy');
    Route::post('/{kelas}/plot', [KaprodiController::class, 'plotMahasiswaDosen'])->name('plot');
});
