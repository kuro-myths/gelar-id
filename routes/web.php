<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontrollerBeranda;
use App\Http\Controllers\Auth\KontrollerMasuk;
use App\Http\Controllers\Auth\KontrollerDaftar;
use App\Http\Controllers\Pengguna\KontrollerDasbor;
use App\Http\Controllers\Pengguna\KontrollerPertemuan as PertemuanPengguna;
use App\Http\Controllers\Pengguna\KontrollerKuesioner as KuesionerPengguna;
use App\Http\Controllers\Admin\KontrollerAdmin;
use App\Http\Controllers\Admin\KontrollerPertemuan as PertemuanAdmin;
use App\Http\Controllers\Admin\KontrollerKuesioner as KuesionerAdmin;
use App\Http\Controllers\Admin\KontrollerSemester;
use App\Http\Controllers\Admin\KontrollerDiskon;

use App\Http\Controllers\KontrollerAnalisisMinat;
use App\Http\Controllers\KontrollerAI;

// ============ PUBLIK ============
Route::get('/', [KontrollerBeranda::class, 'index'])->name('beranda');
Route::get('/program', [KontrollerBeranda::class, 'program'])->name('program');
Route::get('/program/{program:slug}', [KontrollerBeranda::class, 'detailProgram'])->name('program.detail');
Route::get('/gelar', [KontrollerBeranda::class, 'gelar'])->name('gelar');
Route::get('/gelar/{gelar:kode}', [KontrollerBeranda::class, 'detailGelar'])->name('gelar.detail');
Route::get('/verifikasi', [KontrollerBeranda::class, 'verifikasiSertifikat'])->name('verifikasi');
Route::get('/pengajar', [KontrollerBeranda::class, 'pengajar'])->name('pengajar');
Route::get('/tentang', [KontrollerBeranda::class, 'tentang'])->name('tentang');
Route::get('/statistik', [KontrollerBeranda::class, 'statistik'])->name('statistik');
Route::get('/kelas', [KontrollerBeranda::class, 'kelas'])->name('kelas');
Route::get('/kelas/{kelas:slug}', [KontrollerBeranda::class, 'detailKelas'])->name('kelas.detail');

// Analisis Minat (AI Quiz)
Route::get('/analisis-minat', [\App\Http\Controllers\KontrollerAnalisisMinat::class, 'tampilKuis'])->name('analisis-minat');
Route::post('/analisis-minat/proses', [\App\Http\Controllers\KontrollerAnalisisMinat::class, 'proses'])->name('analisis-minat.proses');
Route::get('/analisis-minat/hasil/{analisis}', [\App\Http\Controllers\KontrollerAnalisisMinat::class, 'hasil'])->name('analisis-minat.hasil');

// Validasi kode diskon (publik/AJAX)
Route::post('/diskon/validasi', [\App\Http\Controllers\Admin\KontrollerDiskon::class, 'validasiKode'])->name('diskon.validasi');

// ============ AUTH ============
Route::middleware('guest')->group(function () {
    Route::get('/masuk', [KontrollerMasuk::class, 'tampilFormMasuk'])->name('masuk');
    Route::post('/masuk', [KontrollerMasuk::class, 'masuk']);
    Route::get('/daftar', [KontrollerDaftar::class, 'tampilFormDaftar'])->name('daftar');
    Route::post('/daftar', [KontrollerDaftar::class, 'daftar']);
    // Google OAuth
    Route::get('/auth/google', [\App\Http\Controllers\Auth\KontrollerGoogle::class, 'redirect'])->name('auth.google');
    Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\KontrollerGoogle::class, 'callback'])->name('auth.google.callback');
});
Route::post('/keluar', [KontrollerMasuk::class, 'keluar'])->name('keluar')->middleware('auth');

// ============ AI ============
Route::post('/ai/chat', [KontrollerAI::class, 'chat'])->name('ai.chat');
Route::post('/onboarding/selesai', [KontrollerAI::class, 'selesaikanOnboarding'])->name('onboarding.selesai');

// ============ PENGGUNA ============
Route::middleware('auth')->prefix('pengguna')->name('pengguna.')->group(function () {

    Route::get('/dasbor', [KontrollerDasbor::class, 'index'])->name('dasbor');
    Route::get('/daftar-ku', [KontrollerDasbor::class, 'daftarKu'])->name('daftar-ku');
    Route::post('/daftar/{program}', [KontrollerDasbor::class, 'daftar'])->name('daftar');
    Route::get('/sertifikat-ku', [KontrollerDasbor::class, 'sertifikatku'])->name('sertifikat-ku');
    Route::get('/kemajuan/{pendaftaran}', [KontrollerDasbor::class, 'kemajuan'])->name('kemajuan');
    Route::post('/kemajuan/{pendaftaran}/sesi/{sesi}', [KontrollerDasbor::class, 'tandaiSesiSelesai'])->name('sesi.selesai');
    Route::get('/profil', [KontrollerDasbor::class, 'profil'])->name('profil');
    Route::put('/profil', [KontrollerDasbor::class, 'perbaruiProfil'])->name('profil.perbarui');

    // Persetujuan pendaftaran
    Route::get('/persetujuan/{pendaftaran}', [\App\Http\Controllers\Pengguna\KontrollerPersetujuan::class, 'tampil'])->name('persetujuan');
    Route::post('/persetujuan/{pendaftaran}', [\App\Http\Controllers\Pengguna\KontrollerPersetujuan::class, 'simpan'])->name('persetujuan.simpan');

    // Pertemuan
    Route::get('/pertemuan', [PertemuanPengguna::class, 'daftar'])->name('pertemuan');
    Route::get('/pertemuan/{pertemuan}', [PertemuanPengguna::class, 'tampil'])->name('pertemuan.tampil');
    Route::post('/pertemuan/{pertemuan}/gabung', [PertemuanPengguna::class, 'gabung'])->name('pertemuan.gabung');
    Route::get('/pertemuan/{pertemuan}/ruangan', [PertemuanPengguna::class, 'ruangan'])->name('pertemuan.ruangan');
    Route::post('/pertemuan/{pertemuan}/keluar', [PertemuanPengguna::class, 'keluar'])->name('pertemuan.keluar');

    // Kuesioner
    Route::get('/kuesioner', [KuesionerPengguna::class, 'daftar'])->name('kuesioner');
    Route::get('/kuesioner/{kuesioner}/isi', [KuesionerPengguna::class, 'isi'])->name('kuesioner.isi');
    Route::post('/kuesioner/{kuesioner}/kirim', [KuesionerPengguna::class, 'kirim'])->name('kuesioner.kirim');
    Route::get('/kuesioner/{kuesioner}/hasil', [KuesionerPengguna::class, 'hasil'])->name('kuesioner.hasil');
});

// ============ ADMIN ============
Route::middleware(['auth', \App\Http\Middleware\MiddlewareAdmin::class])
    ->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dasbor', [KontrollerAdmin::class, 'dasbor'])->name('dasbor');

    // Pengguna
    Route::get('/pengguna', [KontrollerAdmin::class, 'pengguna'])->name('pengguna');
    Route::get('/pengguna/{pengguna}/edit', [KontrollerAdmin::class, 'editPengguna'])->name('pengguna.edit');
    Route::put('/pengguna/{pengguna}', [KontrollerAdmin::class, 'perbaruiPengguna'])->name('pengguna.perbarui');
    Route::delete('/pengguna/{pengguna}', [KontrollerAdmin::class, 'hapusPengguna'])->name('pengguna.hapus');

    // Gelar
    Route::get('/gelar', [KontrollerAdmin::class, 'jenisGelar'])->name('gelar');
    Route::get('/gelar/buat', [KontrollerAdmin::class, 'buatGelar'])->name('gelar.buat');
    Route::post('/gelar', [KontrollerAdmin::class, 'simpanGelar'])->name('gelar.simpan');
    Route::get('/gelar/{gelar}/edit', [KontrollerAdmin::class, 'editGelar'])->name('gelar.edit');
    Route::put('/gelar/{gelar}', [KontrollerAdmin::class, 'perbaruiGelar'])->name('gelar.perbarui');

    // Program
    Route::get('/program', [KontrollerAdmin::class, 'program'])->name('program');
    Route::get('/program/buat', [KontrollerAdmin::class, 'buatProgram'])->name('program.buat');
    Route::post('/program', [KontrollerAdmin::class, 'simpanProgram'])->name('program.simpan');
    Route::get('/program/{program}/edit', [KontrollerAdmin::class, 'editProgram'])->name('program.edit');
    Route::put('/program/{program}', [KontrollerAdmin::class, 'perbaruiProgram'])->name('program.perbarui');

    // Pendaftaran
    Route::get('/pendaftaran', [KontrollerAdmin::class, 'pendaftaran'])->name('pendaftaran');
    Route::put('/pendaftaran/{pendaftaran}', [KontrollerAdmin::class, 'perbaruiPendaftaran'])->name('pendaftaran.perbarui');

    // Sertifikat
    Route::get('/sertifikat', [KontrollerAdmin::class, 'sertifikat'])->name('sertifikat');
    Route::get('/sertifikat/{sertifikat}/cetak', [KontrollerAdmin::class, 'cetakSertifikat'])->name('sertifikat.cetak');

    // Diskon
    Route::get('/diskon', [\App\Http\Controllers\Admin\KontrollerDiskon::class, 'daftar'])->name('diskon');
    Route::get('/diskon/buat', [\App\Http\Controllers\Admin\KontrollerDiskon::class, 'buat'])->name('diskon.buat');
    Route::post('/diskon', [\App\Http\Controllers\Admin\KontrollerDiskon::class, 'simpan'])->name('diskon.simpan');
    Route::get('/diskon/{diskon}/edit', [\App\Http\Controllers\Admin\KontrollerDiskon::class, 'edit'])->name('diskon.edit');
    Route::put('/diskon/{diskon}', [\App\Http\Controllers\Admin\KontrollerDiskon::class, 'perbarui'])->name('diskon.perbarui');
    Route::delete('/diskon/{diskon}', [\App\Http\Controllers\Admin\KontrollerDiskon::class, 'hapus'])->name('diskon.hapus');
    Route::post('/diskon/{diskon}/toggle', [\App\Http\Controllers\Admin\KontrollerDiskon::class, 'toggleAktif'])->name('diskon.toggle');

    // Kemajuan Akademik
    Route::get('/kemajuan', [KontrollerAdmin::class, 'kemajuanAkademik'])->name('kemajuan');

    // Pertemuan
    Route::get('/pertemuan', [PertemuanAdmin::class, 'daftar'])->name('pertemuan');
    Route::get('/pertemuan/buat', [PertemuanAdmin::class, 'buat'])->name('pertemuan.buat');
    Route::post('/pertemuan', [PertemuanAdmin::class, 'simpan'])->name('pertemuan.simpan');
    Route::get('/pertemuan/{pertemuan}', [PertemuanAdmin::class, 'tampil'])->name('pertemuan.tampil');
    Route::get('/pertemuan/{pertemuan}/edit', [PertemuanAdmin::class, 'edit'])->name('pertemuan.edit');
    Route::put('/pertemuan/{pertemuan}', [PertemuanAdmin::class, 'perbarui'])->name('pertemuan.perbarui');
    Route::post('/pertemuan/{pertemuan}/mulai', [PertemuanAdmin::class, 'mulai'])->name('pertemuan.mulai');
    Route::post('/pertemuan/{pertemuan}/selesai', [PertemuanAdmin::class, 'selesai'])->name('pertemuan.selesai');
    Route::delete('/pertemuan/{pertemuan}', [PertemuanAdmin::class, 'hapus'])->name('pertemuan.hapus');
    Route::get('/pertemuan/{pertemuan}/peserta', [PertemuanAdmin::class, 'daftarPeserta'])->name('pertemuan.peserta');
    Route::post('/pertemuan/{pertemuan}/hadir', [PertemuanAdmin::class, 'tandaiHadir'])->name('pertemuan.hadir');

    // Kuesioner
    Route::get('/kuesioner', [KuesionerAdmin::class, 'daftar'])->name('kuesioner');
    Route::get('/kuesioner/buat', [KuesionerAdmin::class, 'buat'])->name('kuesioner.buat');
    Route::post('/kuesioner', [KuesionerAdmin::class, 'simpan'])->name('kuesioner.simpan');
    Route::get('/kuesioner/{kuesioner}', [KuesionerAdmin::class, 'tampil'])->name('kuesioner.tampil');
    Route::get('/kuesioner/{kuesioner}/pertanyaan', [KuesionerAdmin::class, 'pertanyaan'])->name('kuesioner.pertanyaan');
    Route::post('/kuesioner/{kuesioner}/pertanyaan', [KuesionerAdmin::class, 'simpanPertanyaan'])->name('kuesioner.pertanyaan.simpan');
    Route::delete('/pertanyaan/{pertanyaan}', [KuesionerAdmin::class, 'hapusPertanyaan'])->name('pertanyaan.hapus');
    Route::post('/kuesioner/{kuesioner}/toggle', [KuesionerAdmin::class, 'toggleAktif'])->name('kuesioner.toggle');
    Route::delete('/kuesioner/{kuesioner}', [KuesionerAdmin::class, 'hapus'])->name('kuesioner.hapus');
    Route::get('/respons/{respons}', [KuesionerAdmin::class, 'hasilDetail'])->name('respons.detail');

    // Semester & Sesi Belajar
    Route::get('/semester', [KontrollerSemester::class, 'daftar'])->name('semester');
    Route::get('/semester/buat', [KontrollerSemester::class, 'buat'])->name('semester.buat');
    Route::post('/semester', [KontrollerSemester::class, 'simpan'])->name('semester.simpan');
    Route::get('/semester/{semester}', [KontrollerSemester::class, 'tampil'])->name('semester.tampil');
    Route::get('/semester/{semester}/edit', [KontrollerSemester::class, 'edit'])->name('semester.edit');
    Route::put('/semester/{semester}', [KontrollerSemester::class, 'perbarui'])->name('semester.perbarui');
    Route::delete('/semester/{semester}', [KontrollerSemester::class, 'hapus'])->name('semester.hapus');
    Route::get('/semester/{semester}/sesi/buat', [KontrollerSemester::class, 'buatSesi'])->name('semester.sesi.buat');
    Route::post('/semester/{semester}/sesi', [KontrollerSemester::class, 'simpanSesi'])->name('semester.sesi.simpan');
    Route::delete('/sesi/{sesi}', [KontrollerSemester::class, 'hapusSesi'])->name('sesi.hapus');
});
