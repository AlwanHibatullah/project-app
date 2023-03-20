<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\BukuIndukController;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\JPelatihanController;
use App\Http\Controllers\KejuruanController;
use App\Http\Controllers\PaketPelatihanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PegumumanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SKKNIController;
use App\Http\Controllers\SubkejuruanController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('paketpelatihan', PaketPelatihanController::class);
        Route::post('/pelatihan-pendaftaran-action', [PaketPelatihanController::class, 'pendaftaran']);
        Route::post('/pelatihan-siswa-action', [PaketPelatihanController::class, 'siswa']);
        Route::get('/pelatihan-siswa-detail/{id}', [PaketPelatihanController::class, 'detail']);
        Route::get('/pelatihan-siswa-detail/{id}/edit', [PaketPelatihanController::class, 'editsiswa']);
        Route::put('/pelatihan-siswa-detail/{id}', [PaketPelatihanController::class, 'updatesiswa']);
        Route::get('/dokumen-siswa/{id}', [PaketPelatihanController::class, 'dokumensiswa']);
        Route::put('/dokumen-siswa', [PaketPelatihanController::class, 'updatedokumensiswa']);
        Route::get('/download-absen-siswa/{id}', [PaketPelatihanController::class, 'downloadabsensiswa']);
        Route::resource('skkni', SKKNIController::class)->except(['show']);
        Route::post('/skkni-tambah', [SKKNIController::class, 'create']);
        Route::resource('profile', ProfileController::class);
});
Route::middleware(['auth','admin'])->group(function () {
    //admin routes
    Route::resource('alumni', AlumniController::class);
    Route::resource('bukuinduk', BukuIndukController::class)->except('destroy');
        Route::post('generate', [BukuIndukController::class, 'generate']);
        Route::post('siswa-action', [BukuIndukController::class, 'action']);
        Route::get('dokumen-edit/{id}', [BukuIndukController::class, 'dokumen']);
        Route::put('dokumen-edit', [BukuIndukController::class, 'dokumen_edit']);
    Route::resource('dana', DanaController::class)->except(['create','show']);
    Route::resource('dashboard', DashboardController::class)->only(['index']);
    Route::resource('dokumentasi', DokumentasiController::class);
    Route::resource('jpelatihan', JPelatihanController::class)->except(['create','show']);
    Route::resource('kejuruan', KejuruanController::class)->except(['create','show']);
    // Route::resource('paketpelatihan', PaketPelatihanController::class);
    //     Route::post('/pelatihan-pendaftaran-action', [PaketPelatihanController::class, 'pendaftaran']);
    //     Route::post('/pelatihan-siswa-action', [PaketPelatihanController::class, 'siswa']);
    //     Route::get('/pelatihan-siswa-detail/{id}', [PaketPelatihanController::class, 'detail']);
    //     Route::get('/pelatihan-siswa-detail/{id}/edit', [PaketPelatihanController::class, 'editsiswa']);
    //     Route::put('/pelatihan-siswa-detail/{id}', [PaketPelatihanController::class, 'updatesiswa']);
    //     Route::get('/dokumen-siswa/{id}', [PaketPelatihanController::class, 'dokumensiswa']);
    //     Route::put('/dokumen-siswa', [PaketPelatihanController::class, 'updatedokumensiswa']);
    //     Route::get('/download-absen-siswa/{id}', [PaketPelatihanController::class, 'downloadabsensiswa']);
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('pengumuman', PegumumanController::class);
    Route::resource('pendaftaran', PendaftaranController::class)->except('destroy');
        Route::post('/pendaftaran-action', [PendaftaranController::class, 'action']);
        Route::get('/dokumen-action/{id}', [PendaftaranController::class, 'dokumen']);
        Route::post('/dokumen-upload', [PendaftaranController::class, 'uploadDokumen']);
    Route::resource('penilaian', PenilaianController::class);
    Route::resource('riwayat', RiwayatController::class)->except('destroy','create','edit');
    Route::resource('subkejuruan', SubkejuruanController::class);
});



