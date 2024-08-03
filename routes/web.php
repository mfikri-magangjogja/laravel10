<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RequestEditController;
use App\Models\RequestEdit;
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
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Rute untuk dosen
Route::prefix('kaprodi/dosen')->name('kaprodi.dosen.')->middleware('auth')->group(function () {
    Route::get('/', [KaprodiController::class, 'indexDosen'])->name('index');
    Route::get('/create', [KaprodiController::class, 'createDosen'])->name('create');
    Route::post('/store', [KaprodiController::class, 'storeDosen'])->name('store');
    Route::get('/{dosen}/edit', [KaprodiController::class, 'editDosen'])->name('edit');
    Route::put('/{dosen}', [KaprodiController::class, 'updateDosen'])->name('update');
    Route::delete('/{dosen}', [KaprodiController::class, 'destroyDosen'])->name('destroy');
});

// Rute untuk kelas
Route::prefix('kaprodi/kelas')->name('kaprodi.kelas.')->middleware('auth')->group(function () {
    Route::get('/', [KaprodiController::class, 'indexKelas'])->name('index');
    Route::get('/create', [KaprodiController::class, 'createKelas'])->name('create');
    Route::post('/store', [KaprodiController::class, 'storeKelas'])->name('store');
    Route::get('/{kelas}/edit', [KaprodiController::class, 'editKelas'])->name('edit');
    Route::put('/{kelas}', [KaprodiController::class, 'updateKelas'])->name('update');
    Route::delete('/{kelas}', [KaprodiController::class, 'destroyKelas'])->name('destroy');
    Route::get('/{kelas}/mahasiswa', [KaprodiController::class, 'showMahasiswa'])->name('showMahasiswa');
    Route::post('/{kelas}/add-mahasiswa', [KaprodiController::class, 'addMahasiswaToKelas'])->name('addMahasiswaToKelas');
});

// Rute untuk mahasiswa
Route::prefix('dosen/mahasiswa')->name('dosen.mahasiswa.')->middleware('auth')->group(function () {
    Route::get('/', [DosenController::class, 'indexMahasiswa'])->name('index');
    Route::get('/create', [DosenController::class, 'createMahasiswa'])->name('create');
    Route::post('/store', [DosenController::class, 'storeMahasiswa'])->name('store');
    Route::get('/{mahasiswa}/edit', [DosenController::class, 'editMahasiswa'])->name('edit');
    Route::put('/{mahasiswa}', [DosenController::class, 'updateMahasiswa'])->name('update');
    Route::delete('/{mahasiswa}', [DosenController::class, 'destroyMahasiswa'])->name('destroy');
});

// Rute untuk permintaan edit
Route::prefix('dosen/request-edit')->name('dosen.request_edit.')->middleware('auth')->group(function () {
    Route::get('/', [DosenController::class, 'indexRequestEdit'])->name('index');
    Route::get('/{requestEdit}/edit', [DosenController::class, 'editRequestEdit'])->name('edit');
    Route::put('/{requestEdit}/approve', [DosenController::class, 'approveRequestEdit'])->name('approve');
    Route::put('/{requestEdit}/reject', [DosenController::class, 'rejectRequestEdit'])->name('reject');
});

// Rute untuk mahasiswa
Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('auth')->group(function () {
    Route::get('/show', [MahasiswaController::class, 'show'])->name('show');
    Route::get('/request-edit', [MahasiswaController::class, 'requestEdit'])->name('request_edit');
    Route::post('/request-edit', [MahasiswaController::class, 'storeRequestEdit'])->name('store_request_edit');
});

// Rute untuk permintaan edit oleh dosen
Route::prefix('dosen/request-edit')->name('dosen.request_edit.')->middleware('auth')->group(function () {
    Route::get('/', [RequestEditController::class, 'indexForDosen'])->name('index');
    Route::get('/{requestEdit}/edit', [RequestEditController::class, 'edit'])->name('edit');
    Route::put('/{requestEdit}/approve', [RequestEditController::class, 'approve'])->name('approve');
    Route::put('/{requestEdit}/reject', [RequestEditController::class, 'reject'])->name('reject');
});

// Rute untuk permintaan edit oleh kaprodi
Route::prefix('kaprodi/request-edit')->name('kaprodi.request_edit.')->middleware('auth')->group(function () {
    Route::get('/', [RequestEditController::class, 'indexForKaprodi'])->name('index');
});
// Rute untuk manajemen kelas
Route::prefix('kelas')->name('kelas.')->middleware('auth')->group(function () {
    Route::get('/', [KelasController::class, 'index'])->name('index');
    Route::get('/create', [KelasController::class, 'create'])->name('create');
    Route::post('/store', [KelasController::class, 'store'])->name('store');
    Route::get('/{kelas}/edit', [KelasController::class, 'edit'])->name('edit');
    Route::put('/{kelas}', [KelasController::class, 'update'])->name('update');
    Route::delete('/{kelas}', [KelasController::class, 'destroy'])->name('destroy');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
