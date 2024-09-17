<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\database\ZipController;
use App\Http\Controllers\database\GuruController;
use App\Http\Controllers\penilaian\PasController;
use App\Http\Controllers\penilaian\PatController;
use App\Http\Controllers\penilaian\PtsController;
use App\Http\Controllers\database\SiswaController;
use App\Http\Controllers\keasramaan\LabController;
use App\Http\Controllers\penilaian\RptsController;
use App\Http\Controllers\database\TendikController;
use App\Http\Controllers\penilaian\RaporController;
use App\Http\Controllers\database\DatabaseDashboard;
use App\Http\Controllers\keasramaan\fiqihController;
use App\Http\Controllers\keasramaan\lombaController;
use App\Http\Controllers\administrasi\OsisController;
use App\Http\Controllers\keasramaan\akhlakController;
use App\Http\Controllers\keasramaan\tafsirController;
use App\Http\Controllers\keasramaan\tahsinController;
use App\Http\Controllers\keasramaan\tajwidController;
use App\Http\Controllers\penilaian\AverageController;
use App\Http\Controllers\penilaian\PanitiaController;
use App\Http\Controllers\administrasi\MapelController;
use App\Http\Controllers\database\DataKelasController;
use App\Http\Controllers\keasramaan\tahfidzController;
use App\Http\Controllers\administrasi\KepsekController;
use App\Http\Controllers\database\DataMutasiController;
use App\Http\Controllers\database\PunishmentController;
use App\Http\Controllers\keasramaan\eventualController;
use App\Http\Controllers\korespondensi\indexController;
use App\Http\Controllers\keasramaan\pelatihanController;
use App\Http\Controllers\sarpras\DormPurchaseController;
use App\Http\Controllers\database\DataPrestasiController;
use App\Http\Controllers\keasramaan\sertifikatController;
use App\Http\Controllers\administrasi\SupervisiController;
use App\Http\Controllers\administrasi\WaliKelasController;
use App\Http\Controllers\database\DataKelulusanController;
use App\Http\Controllers\keasramaan\JamaahSiswaController;
use App\Http\Controllers\sarpras\SchoolPurchaseController;
use App\Http\Controllers\keasramaan\ProgresSiswaController;
use App\Http\Controllers\korespondensi\NotulensiController;
use App\Http\Controllers\keasramaan\PatroliAsramaController;
use App\Http\Controllers\korespondensi\NomorSuratController;
use App\Http\Controllers\korespondensi\SuratMasukController;
use App\Http\Controllers\administrasi\KepalaLabkomController;
use App\Http\Controllers\administrasi\PerpustakaanController;
use App\Http\Controllers\korespondensi\GeneratePdfController;
use App\Http\Controllers\korespondensi\suratKeluarController;
use App\Http\Controllers\administrasi\WakaKesiswaanController;
use App\Http\Controllers\administrasi\WakaKurikulumController;
use App\Http\Controllers\korespondensi\SuratPengajuanController;
use App\Http\Controllers\database\PklAdministrasiSiswaController;
use App\Http\Controllers\korespondensi\SuratPeringatanController;
use App\Http\Controllers\database\PklAdministrasiSekolahController;

Route::get('/smktibazma.sch.id', function () {
    return view('progres');
});
Route::view('sekolah-keasramaan/al-quran', 'keasramaan.quran.quran')->name('quran');
Route::view('sekolah-keasramaan/akademik', 'keasramaan.akademik.akademik')->name('akademik');
Route::view('sekolah-keasramaan/jurnal-asrama', 'keasramaan.jurnal.jurnal')->name('jurnal');

Route::middleware('password')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('database', [DatabaseDashboard::class, 'index'])->name('dashboard');
    Route::get('/korespondensi', [indexController::class, 'index'])->name('inbox.index');
    Route::view('penilaian', 'home.penilaian')->name('penilaian');
    Route::view('administrasi', 'home.administrasiKeguruan')->name('administrasi');
    Route::view('finance', 'home.finance')->name('finance');
    Route::view('sekolah-keasramaan', 'home.keasramaan')->name('keasramaan');
    Route::view('sarpras', 'home.sarpras')->name('sarpras');
    Route::view('pkl', '.database.database.pkl.pkl')->name('pkl');
    Route::get('/pin', [App\Http\Controllers\PasswordController::class, 'index'])->name('pin');
    Route::get('/change-password-sismako', [App\Http\Controllers\PasswordController::class, 'editPw'])->name('pw.edit');
    Route::post('/pin', [App\Http\Controllers\PasswordController::class, 'checkPw'])->name('checkPw');
    Route::put('/change-password', [App\Http\Controllers\PasswordController::class, 'updatePassword'])->name('password.update');
    Route::get('/jamaah', [App\Http\Controllers\keasramaan\JamaahSiswaController::class, 'index'])->name('jamaah.index');
    Route::get('/patroli/asrama', [App\Http\Controllers\keasramaan\PatroliAsramaController::class, 'index'])->name('patroli.asrama.index');
    Route::get('/sekolah-keasramaan/akses-lab',[App\Http\Controllers\keasramaan\LabController::class, 'index'])->name('lab.index');
});

Route::view('created-by', 'home.createdBy')->name('created-by');

// Penilaian Controller Routes
Route::controller(AverageController::class)->group(function () {
    Route::get('/penilaian/rapor/rerata', 'index')->name('average');
    Route::get('/penilaian/rapor/rerata/create', 'create')->name('average.create');
    Route::post('/penilaian/rapor/rerata/store', 'store')->name('average.perform');
    Route::get('/penilaian/rapor/rerata/edit/{id}', 'edit')->name('average.edit');
    Route::post('/penilaian/rapor/rerata/update/{id}', 'update')->name('average.update');
    Route::delete('/penilaian/rapor/rerata/delete/{id}', 'destroy')->name('average.destroy');
});
Route::controller(RaporController::class)->group(function () {
    Route::get('/penilaian/rapor', 'index')->name('rapor');
    Route::get('/penilaian/rapor/create', 'create')->name('rapor.create');
    Route::post('/penilaian/rapor/store', 'store')->name('rapor.perform');
    Route::get('/penilaian/rapor/edit/{id}', 'edit')->name('rapor.edit');
    Route::put('/penilaian/rapor/update/{id}', 'update')->name('rapor.update');
    Route::delete('/penilaian/rapor/delete/{id}', 'destroy')->name('rapor.delete');
    Route::get('/penilaian/rapor/pdf/{id}', 'pdf')->name('rapor.pdf');
});
Route::controller(RptsController::class)->group(function () {
    Route::get('/penilaian/rpts', 'index')->name('rpts');
    Route::get('/penilaian/rpts/create', 'create')->name('rpts.create');
    Route::post('/penilaian/rpts/store', 'store')->name('rpts.perform');
    Route::get('/penilaian/rpts/edit/{id}', 'edit')->name('rpts.edit');
    Route::put('/penilaian/rpts/update/{id}', 'update')->name('rpts.update');
    Route::delete('/penilaian/rpts/delete/{id}', 'destroy')->name('rpts.delete');
    Route::get('/penilaian/rpts/pdf/{id}', 'pdf')->name('rpts.pdf');
});

Route::controller(PasController::class)->group(function () {
    Route::get('/penilaian/pas', 'index')->name('pas');
    Route::get('/penilaian/pas/create', 'create')->name('pas.create');
    Route::post('/penilaian/pas/store', 'store')->name('pas.perform');
    Route::get('/penilaian/pas/edit/{id}', 'edit')->name('pas.edit');
    Route::put('/penilaian/pas/update/{id}', 'update')->name('pas.update');
    Route::delete('/penilaian/pas/delete/{id}', 'destroy')->name('pas.delete');
    Route::get('/penilaian/pas/download/{id}', 'download')->name('pas.download');
});

Route::controller(PatController::class)->group(function () {
    Route::get('/penilaian/pat', 'index')->name('pat');
    Route::get('/penilaian/pat/create', 'create')->name('pat.create');
    Route::post('/penilaian/pat/store', 'store')->name('pat.perform');
    Route::get('/penilaian/pat/edit/{id}', 'edit')->name('pat.edit');
    Route::put('/penilaian/pat/update/{id}', 'update')->name('pat.update');
    Route::delete('/penilaian/pat/delete/{id}', 'destroy')->name('pat.delete');
    Route::get('/penilaian/pat/download/{id}', 'download')->name('pat.download');
});

Route::controller(PtsController::class)->group(function () {
    Route::get('/penilaian/pts', 'index')->name('pts');
    Route::get('/penilaian/pts/create', 'create')->name('pts.create');
    Route::post('/penilaian/pts/store', 'store')->name('pts.perform');
    Route::get('/penilaian/pts/edit/{id}', 'edit')->name('pts.edit');
    Route::put('/penilaian/pts/update/{id}', 'update')->name('pts.update');
    Route::delete('/penilaian/pts/delete/{id}', 'destroy')->name('pts.delete');
    Route::get('/penilaian/pts/download/{id}', 'download')->name('pts.download');
});

Route::controller(PanitiaController::class)->group(function () {
    Route::get('/penilaian/panitia', 'index')->name('panitia');
    Route::get('/penilaian/panitia/create', 'create')->name('panitia.create');
    Route::post('/penilaian/panitia/store', 'store')->name('panitia.perform');
    Route::get('/penilaian/panitia/edit/{id}', 'edit')->name('panitia.edit');
    Route::put('/penilaian/panitia/update/{id}', 'update')->name('panitia.update');
    Route::delete('/penilaian/panitia/delete/{id}', 'destroy')->name('panitia.delete');
    Route::get('/penilaian/panitia/download/{id}', 'download')->name('panitia.download');
});



// Sarpras
Route::controller(SchoolPurchaseController::class)->group(function () {
    Route::get('/sarpas/school-purchase', 'index')->name('school-purchases.index');
    Route::get('/sarpas/good-items-school', 'goodItems')->name('good-items-school');
    Route::get('/sarpas/damaged-items-school', 'damagedItems')->name('damaged-items-school');

    Route::post('/sarpas/school-purchase', 'store')->name('school-purchases.store');
    Route::get('/sarpas/school-purchases/{id}/download', 'download')->name('school-purchases.download');

    Route::get('/sarpas/school-purchases/create', 'create')->name('school-purchases.create');
    Route::get('/sarpas/school-purchases/{id}/edit', 'edit')->name('school-purchases.edit');
    Route::put('/sarpas/school-purchases/{id}', 'update')->name('school-purchases.update');
    Route::delete('/sarpas/school-purchases/{id}', 'destroy')->name('school-purchases.destroy');
    Route::get('/sarpas/school-purchases/print', 'print')->name('school-purchases.print');

    Route::get('/sarpas/damaged-items-school/{$id}', 'getDamaged')->name('damaged-items-school.getDamaged');
    Route::get('/sarpas/damaged-items-school/{id}/edit', 'edit')->name('damaged-items-school.edit');
    // Route::get('/items/{id}', 'show')->name('items.show');
    Route::put('/sarpas/damaged-items-school/{id}', 'damaged')->name('damaged-items-school.damaged');
});

Route::controller(DormPurchaseController::class)->group(function () {
    Route::get('/sarpas/dorm-purchase', 'index')->name('dorm-purchases.index');
    Route::get('/sarpas/good-items-dorm', 'goodItems')->name('good-items-dorm');
    Route::get('/sarpas/damaged-items-dorm', 'damagedItems')->name('damaged-items-dorm');

    Route::post('/sarpas/dorm-purchase', 'store')->name('dorm-purchases.store');
    Route::get('/sarpas/dorm-purchases/{id}/download', 'download')->name('dorm-purchases.download');

    Route::get('/sarpas/dorm-purchases/create', 'create')->name('dorm-purchases.create');
    Route::get('/sarpas/dorm-purchases/{id}/edit', 'edit')->name('dorm-purchases.edit');
    Route::put('/sarpas/dorm-purchases/{id}', 'update')->name('dorm-purchases.update');
    Route::delete('/sarpas/dorm-purchases/{id}', 'destroy')->name('dorm-purchases.destroy');
    Route::get('/sarpas/dorm-purchases/print', 'print')->name('dorm-purchases.print');

    Route::get('/sarpas/damaged-items-dorm/{$id}', 'getDamaged')->name('damaged-items-dorm.getDamaged');
    Route::get('/sarpas/damaged-items-dorm/{id}/edit', 'edit')->name('damaged-items-dorm.edit');
    // Route::get('/items/{id}', 'show')->name('items.show');
    Route::put('/sarpas/damaged-items-dorm/{id}', 'damaged')->name('damaged-items-dorm.damaged');
});

Route::get('sarpas/zip-file', [SchoolPurchaseController::class, 'zip']);





// Database
Route::controller(PklAdministrasiSekolahController::class)->group(function () {
    Route::get('pkl/adm-sekolah', 'index')->name('pkl.sekolah.index');
    Route::get('pkl/adm-sekolah/create', 'create')->name('pkl.sekolah.create');
    Route::post('pkl/adm-sklh/create/data', 'store')->name('pkl.sekolah.store');
    Route::get('pkl/adm-sekolah/edit/{id}', 'edit')->name('pkl.sekolah.edit');
    Route::post('pkl/adm-sekolah/update/{id}', 'update')->name('pkl.sekolah.update');
    Route::delete('pkl/adm-sekolah/delete/{id}', 'destroy')->name('pkl.sekolah.destroy');
});

Route::controller(PklAdministrasiSiswaController::class)->group(function () {
    Route::get('pkl/adm-siswa', 'index')->name('pkl.siswa.index');
    Route::get('pkl/adm-siswa/create', 'create')->name('pkl.siswa.create');
    Route::post('pkl/adm-siswa/create/data', 'store')->name('pkl.siswa.store');
    Route::get('pkl/adm-siswa/edit/{id}', 'edit')->name('pkl.siswa.edit');
    Route::post('pkl/adm-siswa/update/{id}', 'update')->name('pkl.siswa.update');
    Route::delete('pkl/adm-siswa/delete/{id}', 'destroy')->name('pkl.siswa.destroy');
});

Route::controller(GuruController::class)->group(function () {
    Route::get('/guru', 'index')->name('guru.index');
    Route::get('/guru/create', 'create')->name('guru.create');
    Route::get('/guru/edit/{id}', 'edit')->name('guru.edit');
    Route::post('/guru/update/{id}', 'update')->name('guru.update');
    Route::post('/guru/create/data', 'store')->name('guru.store');
    Route::delete('/guru/delete/{id}', 'destroy')->name('guru.destroy');
    Route::get('/guru/download/{id}', 'download')->name('guru.download');
    Route::get('/guru/{id}/export-pdf', 'exportPdf')->name('guru.exportPdf');
    Route::get('/guru/{id}/download', 'downloadFile')->name('guru.download.file');
});

Route::controller(TendikController::class)->group(function () {
    Route::get('/tendik', 'index')->name('tendik.index');
    Route::get('/tendik/create', 'create')->name('tendik.create');
    Route::get('/tendik/edit/{id}', 'edit')->name('tendik.edit');
    Route::post('/tendik/create/data', 'store')->name('tendik.store');
    Route::delete('/tendik/delete/{id}', 'destroy')->name('tendik.destroy');
    Route::put('/tendik/update/{id}', 'update')->name('tendik.update');
    Route::get('/tendik/{id}/export-pdf', 'exportPdf')->name('tendik.exportPdf');
});

Route::controller(DataPrestasiController::class)->group(function () {
    Route::get('/data-prestasi', 'index')->name('prestasi.index');
    Route::get('/data-prestasi/create', 'create')->name('prestasi.create');
    Route::post('/data-prestasi/create/data', 'store')->name('prestasi.store');
    Route::get('/data-prestasi/edit/{id}', 'edit')->name('prestasi.edit');
    Route::post('/data-prestasi/update/{id}', 'update')->name('prestasi.update');
    Route::delete('/data-prestasi/delete/{id}', 'destroy')->name('prestasi.destroy');
    Route::get('/data-prestasi/export-pdf', [DataPrestasiController::class, 'exportPdf'])->name('prestasi.exportPdf');
});

Route::controller(SiswaController::class)->group(function () {
    Route::get('/siswa', 'index')->name('siswa.index');
    Route::get('/siswa/create', 'create')->name('siswa.create');
    Route::post('/siswa/create/data', 'store')->name('siswa.store');
    Route::get('/siswa/edit/{id}', 'edit')->name('siswa.edit');
    Route::post('/siswa/update/{id}', 'update')->name('siswa.update');
    Route::delete('/siswa/delete/{id}', 'destroy')->name('siswa.destroy');
    Route::get('/siswa/{id}/export-pdf', 'exportPdf')->name('siswa.exportPdf');
});

Route::controller(DataMutasiController::class)->group(function () {
    Route::get('/data-mutasi', 'index')->name('mutasi.index');
    Route::get('/data-mutasi/create', 'create')->name('mutasi.create');
    Route::post('/data-mutasi/create/data', 'store')->name('mutasi.store');
    Route::get('/data-mutasi/edit/{id}', 'edit')->name('mutasi.edit');
    Route::put('/data-mutasi/update/{id}', 'update')->name('mutasi.update');
    Route::delete('/mutasi/{id}', 'destroy')->name('mutasi.destroy');
    Route::get('/mutasi/export', 'exportPdf')->name('mutasi.export');
});

Route::controller(DataKelulusanController::class)->group(function () {
    Route::get('/kelulusan', 'index')->name('kelulusan.index');
    Route::get('/kelulusan/create', 'create')->name('kelulusan.create');
    Route::post('/kelulusan/create/data', 'store')->name('kelulusan.store');
    Route::get('/kelulusan/edit/{id}', 'edit')->name('kelulusan.edit');
    Route::post('/kelulusan/update/{id}', 'update')->name('kelulusan.update');
    Route::delete('/kelulusan/delete/{id}', 'destroy')->name('kelulusan.destroy');
    Route::get('/kelulusan/export/{id}', 'exportPdfCv')->name('kelulusan.export.data');
    Route::get('/kelulusan/export-pdf', 'exportPdf')->name('kelulusan.export');
});

Route::controller(DataKelasController::class)->group(function () {
    Route::post('/kelas/create/data', 'store')->name('kelas.store');
    Route::get('/kelas/edit/{id}', 'edit')->name('kelas.edit');
    Route::put('/kelas/update/{id}', 'update')->name('kelas.update');
    Route::delete('/kelas/delete/{id}', 'destroy')->name('kelas.destroy');
    Route::get('/kelas/export/{id}', 'exportPdfCv')->name('kelas.export.data');
    Route::get('/kelas/export-pdf', 'exportPdf')->name('kelas.export');
    Route::get('/kelas/upgrade', 'upgrade')->name('kelas.upgrade');
});
Route::get('/kelas', [DataKelasController::class, 'index'])->name('kelas.index');

Route::get('/api/siswa', [PunishmentController::class, 'getSiswaByAngkatan']);
Route::get('/api/siswa', [DataKelasController::class, 'getSiswaByAngkatan']);
Route::get('/api/siswa-lulus/', [DataKelasController::class, 'getSiswaLulusByAngkatan']);
Route::get('/api/siswa/kelas', [DataKelasController::class, 'getSiswaByKelas']);

Route::get('/kelas/create', [DataKelasController::class, 'create'])->name('kelas.create');

Route::get('/zip-file', [ZipController::class, 'zipFile']);
Route::get('/zip-file/guru/{nama}', [ZipController::class, 'zipFileGuru'])->name('file.guru');
Route::get('/zip-file/tendik/{nama}', [ZipController::class, 'zipFileTendik'])->name('file.tendik');
Route::get('/zip-file/siswa/{nama}', [ZipController::class, 'zipFileSiswa'])->name('file.siswa');
Route::get('/zip-file/pkl/sekolah/{id}', [ZipController::class, 'zipFilePklSekolah'])->name('file.pkl.sekolah');
Route::get('/zip-file/pkl/siswa/{id}', [ZipController::class, 'zipFilePklSiswa'])->name('file.siswa.sekolah');

Route::controller(PunishmentController::class)->group(function () {
    Route::get('/punishment', 'index')->name('punishment.index');
    Route::get('/punishment/create', 'create')->name('punishment.create');
    Route::post('/punishment/create/data', 'store')->name('punishment.store');
    Route::get('/punishment/{id}/edit', [PunishmentController::class, 'edit'])->name('punishment.edit');
    Route::put('/punishment/{id}', [PunishmentController::class, 'update'])->name('punishment.update');
    Route::delete('/punishment/delete/{id}', 'destroy')->name('punishment.destroy');
    Route::get('/punishment/export-pdf', 'exportPdf')->name('punishment.export');
});

Route::get('/kelas/export', [DataKelasController::class, 'exportPdf'])->name('kelas.export');





// keasramaan
Route::controller(JamaahSiswaController::class)->group(function () {
    Route::get('/jamaah/create', 'create')->name('jamaah.create');
    Route::post('/jamaah/create/data', 'store')->name('jamaah.store');
    Route::get('jamaah/{tanggal}/{kelas}/{sholat}/edit/{id}', [JamaahSiswaController::class, 'edit'])->name('jamaah.edit');
    Route::put('/jamaah/{id}', [JamaahSiswaController::class, 'update'])->name('jamaah.update');
    Route::delete('/jamaah/delete/{id}', 'destroy')->name('jamaah.destroy');
    Route::get('/jamaah/export-pdf', 'exportPdf')->name('jamaah.export');
    Route::put('/jamaah/{tanggal}/{kelas}/{sholat}/{id}', [JamaahSiswaController::class, 'update'])->name('jamaah.update');
    Route::get('/jamaah/{tanggal}/{kelas}/{sholat}/export-pdf/sholat', [JamaahSiswaController::class, 'exportPdfPerSholat'])->name('jamaah.exportPdf');
    Route::get('/jamaah/{tanggal}/{kelas}/export-pdf/hari', [JamaahSiswaController::class, 'exportPdfPerHari'])->name('jamaah.exportPdf.hari');
    Route::get('/jamaah/export-pdf-range/{start_date}/{end_date}/{kelas}', [JamaahSiswaController::class, 'exportPdfPerRange'])->name('jamaah.exportPdf.range');
});

Route::controller(PatroliAsramaController::class)->group(function () {
    Route::get('/patroli/asrama/create', 'create')->name('patroli.asrama.create');
    Route::get('/patroli/asrama/{id}/edit', [PatroliAsramaController::class, 'edit'])->name('patroli.asrama.edit');
    Route::post('/patroli/asrama/create/data', 'store')->name('patroli.asrama.store');
    Route::put('/patroli/asrama/{id}', [PatroliAsramaController::class, 'update'])->name('patroli.asrama.update');
    Route::delete('/patroli/delete/{id}', 'destroy')->name('patroli.asrama.destroy');
    Route::get('/patroli/export-pdf', 'exportPdf')->name('patroli.asrama.export');
});

//clear
Route::controller(tahfidzController::class)->group(function () {
    Route::get('/sekolah-keasramaan/al-quran/tahfidz', 'index')->name('tahfidz');   
    Route::get('/sekolah-keasramaan/al-quran/tahfidz/create', 'create')->name('tahfidz.create');
    Route::post('/sekolah-keasramaan/al-quran/tahfidz/store', 'store')->name('tahfidz.perform');
    Route::get('/sekolah-keasramaan/al-quran/tahfidz/edit/{id}', 'edit')->name('tahfidz.edit');
    Route::put('/sekolah-keasramaan/al-quran/tahfidz/update/{id}', 'update')->name('tahfidz.update');
    Route::delete('/sekolah-keasramaan/al-quran/tahfidz/delete/{id}', 'destroy')->name('tahfidz.delete');
});

//clear
Route::controller(tahsinController::class)->group(function () {
    Route::get('/sekolah-keasramaan/al-quran/tahsin', 'index')->name('tahsin');
    Route::get('/sekolah-keasramaan/al-quran/tahsin/create', 'create')->name('tahsin.create');
    Route::post('/sekolah-keasramaan/al-quran/tahsin/store', 'store')->name('tahsin.perform');
    Route::get('/sekolah-keasramaan/al-quran/tahsin/edit/{id}', 'edit')->name('tahsin.edit');
    Route::put('/sekolah-keasramaan/al-quran/tahsin/update/{id}', 'update')->name('tahsin.update');
    Route::delete('/sekolah-keasramaan/al-quran/tahsin/delete/{id}', 'destroy')->name('tahsin.delete');
});

//clear
Route::controller(sertifikatController::class)->group(function () {
    Route::get('/sekolah-keasramaan/al-quran/sertif', 'index')->name('sertifikat');
    Route::get('/sekolah-keasramaan/al-quran/sertif/create', 'create')->name('sertifikat.create');
    Route::post('/sekolah-keasramaan/al-quran/sertif/store', 'store')->name('sertifikat.perform');
    Route::get('/sekolah-keasramaan/al-quran/sertif/edit/{id}', 'edit')->name('sertifikat.edit');
    Route::put('/sekolah-keasramaan/al-quran/sertif/update/{id}', 'update')->name('sertifikat.update');
    Route::delete('/sekolah-keasramaan/al-quran/sertif/delete/{id}', 'destroy')->name('sertifikat.delete');
});

Route::controller(pelatihanController::class)->group(function () {
    Route::get('/sekolah-keasramaan/akademik/pelatihan', 'index')->name('pelatihan.index');
    Route::get('/sekolah-keasramaan/akademik/pelatihan/create', 'create')->name('pelatihan.create');
    Route::post('/sekolah-keasramaan/akademik/pelatihan/store', 'store')->name('pelatihan.store');
    Route::get('/sekolah-keasramaan/akademik/pelatihan/edit/{id}', 'edit')->name('pelatihan.edit');
    Route::put('/sekolah-keasramaan/akademik/pelatihan/update/{id}', 'update')->name('pelatihan.update');
    Route::delete('/sekolah-keasramaan/akademik/pelatihan/delete/{id}', 'destroy')->name('pelatihan.delete');
});

Route::controller(lombaController::class)->group(function () {
    Route::get('/sekolah-keasramaan/akademik/lomba', 'index')->name('lomba.index');
    Route::get('/sekolah-keasramaan/akademik/lomba/create', 'create')->name('lomba.create');
    Route::post('/sekolah-keasramaan/akademik/lomba/store', 'store')->name('lomba.store');
    Route::get('/sekolah-keasramaan/akademik/lomba/edit/{id}', 'edit')->name('lomba.edit');
    Route::put('/sekolah-keasramaan/akademik/lomba/update/{id}', 'update')->name('lomba.update');
    Route::delete('/sekolah-keasramaan/akademik/lomba/delete/{id}', 'destroy')->name('lomba.delete');
});

Route::controller(eventualController::class)->group(function () {
    Route::get('/sekolah-keasramaan/akademik/eventual', 'index')->name('eventual.index');
    Route::get('/sekolah-keasramaan/akademik/eventual/create', 'create')->name('eventual.create');
    Route::post('/sekolah-keasramaan/akademik/eventual/store', 'store')->name('eventual.store');
    Route::get('/sekolah-keasramaan/akademik/eventual/edit/{id}', 'edit')->name('eventual.edit');
    Route::put('/sekolah-keasramaan/akademik/eventual/update/{id}', 'update')->name('eventual.update');
    Route::delete('/sekolah-keasramaan/akademik/eventual/delete/{id}', 'destroy')->name('eventual.delete');
});

Route::controller(akhlakController::class)->group(function () {
    Route::get('/sekolah-keasramaan/jurnal-asrama/akhlak', 'index')->name('akhlak.index');
    Route::get('/sekolah-keasramaan/jurnal-asrama/akhlak/create', 'create')->name('akhlak.create');
    Route::post('/sekolah-keasramaan/jurnal-asrama/akhlak/store', 'store')->name('akhlak.store');
    Route::get('/sekolah-keasramaan/jurnal-asrama/akhlak/edit/{id}', 'edit')->name('akhlak.edit');
    Route::put('/sekolah-keasramaan/jurnal-asrama/akhlak/update/{id}', 'update')->name('akhlak.update');
    Route::delete('/sekolah-keasramaan/jurnal-asrama/akhlak/delete/{id}', 'destroy')->name('akhlak.delete');
});

Route::controller(fiqihController::class)->group(function () {
    Route::get('/sekolah-keasramaan/jurnal-asrama/fiqih', 'index')->name('fiqih.index');
    Route::get('/sekolah-keasramaan/jurnal-asrama/fiqih/create', 'create')->name('fiqih.create');
    Route::post('/sekolah-keasramaan/jurnal-asrama/fiqih/store', 'store')->name('fiqih.store');
    Route::get('/sekolah-keasramaan/jurnal-asrama/fiqih/edit/{id}', 'edit')->name('fiqih.edit');
    Route::put('/sekolah-keasramaan/jurnal-asrama/fiqih/update/{id}', 'update')->name('fiqih.update');
    Route::delete('/sekolah-keasramaan/jurnal-asrama/fiqih/delete/{id}', 'destroy')->name('fiqih.delete');
});

Route::controller(tafsirController::class)->group(function () {
    Route::get('/sekolah-keasramaan/jurnal-asrama/tafsir', 'index')->name('tafsir.index');
    Route::get('/sekolah-keasramaan/jurnal-asrama/tafsir/create', 'create')->name('tafsir.create');
    Route::post('/sekolah-keasramaan/jurnal-asrama/tafsir/store', 'store')->name('tafsir.store');
    Route::get('/sekolah-keasramaan/jurnal-asrama/tafsir/edit/{id}', 'edit')->name('tafsir.edit');
    Route::put('/sekolah-keasramaan/jurnal-asrama/tafsir/update/{id}', 'update')->name('tafsir.update');
    Route::delete('/sekolah-keasramaan/jurnal-asrama/tafsir/delete/{id}', 'destroy')->name('tafsir.delete');
});

Route::controller(tajwidController::class)->group(function () {
    Route::get('/sekolah-keasramaan/jurnal-asrama/tajwid', 'index')->name('tajwid.index');
    Route::get('/sekolah-keasramaan/jurnal-asrama/tajwid/create', 'create')->name('tajwid.create');
    Route::post('/sekolah-keasramaan/jurnal-asrama/tajwid/store', 'store')->name('tajwid.store');
    Route::get('/sekolah-keasramaan/jurnal-asrama/tajwid/edit/{id}', 'edit')->name('tajwid.edit');
    Route::put('/sekolah-keasramaan/jurnal-asrama/tajwid/update/{id}', 'update')->name('tajwid.update');
    Route::delete('/sekolah-keasramaan/jurnal-asrama/tajwid/delete/{id}', 'destroy')->name('tajwid.delete');
});

Route::controller(LabController::class)->group(function () {
    Route::get('/sekolah-keasramaan/akses-lab/create', 'create')->name('lab.create');
    Route::post('/sekolah-keasramaan/akses-lab/store', 'store')->name('lab.store');
    Route::get('/sekolah-keasramaan/akses-lab/edit', 'edit')->name('lab.edit');
    Route::put('/sekolah-keasramaan/akses-lab/update', 'update')->name('lab.update');
    Route::delete('/sekolah-keasramaan/akses-lab/delete', 'destroy')->name('lab.delete');
});

Route::get('/progres-siswa/{nisn}', [ProgresSiswaController::class, 'index'])->name('progres-siswa.index');




// korespondensi
Route::get('/pdf/{model}', [GeneratePdfController::class, 'generatepdf'])->name('pdf');

Route::controller(GuruController::class)->group(function () {
    Route::get('/guru', 'index')->name('guru.index');
    Route::get('/guru/create', 'create')->name('guru.create');
    Route::post('/guru/create/data', 'store')->name('guru.store');
    Route::delete('/guru/delete/{id}', 'destroy')->name('guru.destory');
});

Route::controller(SuratMasukController::class)->group(function () {
    // Route::get('/inbox', 'index')->name('inbox.index');
    Route::post('/korespondensi', 'store')->name('inbox.store');
    Route::get('/korespondensi/{id}/edit', 'edit')->name('inbox.edit');
    Route::get('/korespondensi/{id}/download', 'download')->name('inbox.download');
    Route::put('/korespondensi/{id}', 'update')->name('inbox.update');
    Route::get('korespondensi/pdf', 'generatepdf')->name('inbox.pdf');
    Route::delete('/korespondensi/delete/{id}', 'destroy')->name('inbox.destroy');
});

Route::controller(suratKeluarController::class)->group(function () {
    Route::post('/outbox', 'store')->name('outbox.store');
    Route::get('/outbox/{id}/edit', 'edit')->name('outbox.edit');
    Route::get('/outbox/{id}/download', 'download')->name('outbox.download');
    Route::put('/outbox/{id}', 'update')->name('outbox.update');
    Route::delete('/outbox/delete/{id}', 'destroy')->name('outbox.destroy');
});

Route::controller(SuratPeringatanController::class)->group(function () {
    Route::post('/sp', 'store')->name('sp.store');
    Route::get('/sp/{id}/edit', 'edit')->name('sp.edit');
    route::get('/sp/{id}/download', 'download')->name('sp.download');
    Route::put('/sp/{id}', 'update')->name('sp.update');
    Route::delete('/sp/delete/{id}', 'destroy')->name('sp.destroy');
});

Route::controller(NomorSuratController::class)->group(function () {
    Route::post('/no_surat', 'store')->name('no_surat.store');
    Route::get('/no_surat/{id}/edit', 'edit')->name('no_surat.edit');
    Route::put('/no_surat/{id}', 'update')->name('no_surat.update');
    Route::delete('/no_surat/delete/{id}', 'destroy')->name('no_surat.destroy');
});

Route::controller(NotulensiController::class)->group(function () {
    Route::post('/notulensi', 'store')->name('notulensi.store');
    Route::get('/notulensi/{id}/edit', 'edit')->name('notulensi.edit');
    Route::get('/notulensi/{id}/downloadSurat', 'downloadSurat')->name('notulensi.download');
    Route::get('/notulensi/{id}/downloadDokumentasi', 'downloadDokumentasi')->name('notulensi.download_dokumentasi');
    Route::put('/notulensi/{id}', 'update')->name('notulensi.update');
    Route::delete('/notulensi/delete/{id}', 'destroy')->name('notulensi.destroy');
});

Route::controller(SuratPengajuanController::class)->group(function () {
    Route::post('/pengajuan', 'store')->name('pengajuan.store');
    Route::get('/pengajuan/{id}/edit', 'edit')->name('pengajuan.edit');
    Route::get('/pengajuan/{id}/download', 'download')->name('pengajuan.download');
    Route::put('/pengajuan/{id}', 'update')->name('pengajuan.update');
    Route::delete('/pengajuan/delete/{id}', 'destroy')->name('pengajuan.destroy');
});





// Administrasi
// Routes for Mapel
Route::prefix('administrasi-keguruan/mapel')->group(function () {
    Route::get('/', [MapelController::class, 'index'])->name('mapel.index');
    Route::get('/create', [MapelController::class, 'create'])->name('mapel.create');
    Route::post('/', [MapelController::class, 'store'])->name('mapel.store');
    Route::get('/{id}/edit', [MapelController::class, 'edit'])->name('mapel.edit');
    Route::put('/{id}', [MapelController::class, 'update'])->name('mapel.update');
    Route::delete('/{id}', [MapelController::class, 'destroy'])->name('mapel.destroy');
    Route::get('/{id}/download', [MapelController::class, 'downloadFiles'])->name('mapel.download');
});

// Routes for Kepala Lab Kom
Route::prefix('administrasi-keguruan/kepalaLabKom')->group(function () {
    Route::get('/', [KepalaLabkomController::class, 'index'])->name('kepalaLabKom.index');
    Route::get('/create', [KepalaLabkomController::class, 'create'])->name('kepalaLabKom.create');
    Route::post('/', [KepalaLabkomController::class, 'store'])->name('kepalaLabKom.store');
    Route::get('/{id}/edit', [KepalaLabkomController::class, 'edit'])->name('kepalaLabKom.edit');
    Route::put('/{id}', [KepalaLabkomController::class, 'update'])->name('kepalaLabKom.update');
    Route::delete('/{id}', [KepalaLabkomController::class, 'destroy'])->name('kepalaLabKom.destroy');
    Route::get('/{id}/download', [KepalaLabkomController::class, 'downloadFiles'])->name('kepalaLabKom.download');
});

// Routes for OSIS
Route::prefix('administrasi-keguruan/osis')->group(function () {
    Route::get('/', [OsisController::class, 'index'])->name('osis.index');
    Route::get('/create', [OsisController::class, 'create'])->name('osis.create');
    Route::post('/', [OsisController::class, 'store'])->name('osis.store');
    Route::get('/{id}/edit', [OsisController::class, 'edit'])->name('osis.edit');
    Route::put('/{id}', [OsisController::class, 'update'])->name('osis.update');
    Route::delete('/{id}', [OsisController::class, 'destroy'])->name('osis.destroy');
    Route::get('/{id}/download', [OsisController::class, 'downloadFiles'])->name('osis.download');
});

// Routes for Perpustakaan
Route::prefix('administrasi-keguruan/perpustakaan')->group(function () {
    Route::get('/', [PerpustakaanController::class, 'index'])->name('perpustakaan.index');
    Route::get('/create', [PerpustakaanController::class, 'create'])->name('perpustakaan.create');
    Route::post('/', [PerpustakaanController::class, 'store'])->name('perpustakaan.store');
    Route::get('/{id}/edit', [PerpustakaanController::class, 'edit'])->name('perpustakaan.edit');
    Route::put('/{id}', [PerpustakaanController::class, 'update'])->name('perpustakaan.update');
    Route::delete('/{id}', [PerpustakaanController::class, 'destroy'])->name('perpustakaan.destroy');
    Route::get('/{id}/download', [PerpustakaanController::class, 'downloadFiles'])->name('perpustakaan.download');
});

// Routes for Walas
Route::prefix('administrasi-keguruan/walas')->group(function () {
    Route::get('/', [WaliKelasController::class, 'index'])->name('walas.index');
    Route::get('/create', [WaliKelasController::class, 'create'])->name('walas.create');
    Route::post('/', [WaliKelasController::class, 'store'])->name('walas.store');
    Route::get('/{id}/edit', [WaliKelasController::class, 'edit'])->name('walas.edit');
    Route::put('/{id}', [WaliKelasController::class, 'update'])->name('walas.update');
    Route::delete('/{id}', [WaliKelasController::class, 'destroy'])->name('walas.destroy');
    Route::get('/download/{id}', [WaliKelasController::class, 'downloadFile'])->name('walas.downloadFile');
});

// Routes for Waka Kurikulum
Route::prefix('administrasi-keguruan/waka-kurikulum')->group(function () {
    Route::get('/', [WakaKurikulumController::class, 'index'])->name('waka_kurikulum.index');
    Route::get('/create', [WakaKurikulumController::class, 'create'])->name('waka_kurikulum.create');
    Route::post('/', [WakaKurikulumController::class, 'store'])->name('waka_kurikulum.store');
    Route::get('/{wakaKurikulum}/edit', [WakaKurikulumController::class, 'edit'])->name('waka_kurikulum.edit');
    Route::put('/{wakaKurikulum}', [WakaKurikulumController::class, 'update'])->name('waka_kurikulum.update');
    Route::delete('/{wakaKurikulum}', [WakaKurikulumController::class, 'destroy'])->name('waka_kurikulum.destroy');
    Route::get('/exportPDF/{id}', [WakaKurikulumController::class, 'exportPDF'])->name('waka_kurikulum.exportPDF');
    Route::get('/download/{id}', [WakaKurikulumController::class, 'downloadFile'])->name('waka_kurikulum.downloadFile');
});

// Routes for Waka Kesiswaan
Route::prefix('administrasi-keguruan/waka-kesiswaan')->group(function () {
    Route::get('/', [WakaKesiswaanController::class, 'index'])->name('waka_kesiswaan.index');
    Route::get('/create', [WakaKesiswaanController::class, 'create'])->name('waka_kesiswaan.create');
    Route::post('/', [WakaKesiswaanController::class, 'store'])->name('waka_kesiswaan.store');
    Route::get('/{id}/edit', [WakaKesiswaanController::class, 'edit'])->name('waka_kesiswaan.edit');
    Route::put('/{id}', [WakaKesiswaanController::class, 'update'])->name('waka_kesiswaan.update');
    Route::delete('/{id}', [WakaKesiswaanController::class, 'destroy'])->name('waka_kesiswaan.destroy');
    Route::get('/exportPDF/{id}', [WakaKesiswaanController::class, 'exportPDF'])->name('waka_kesiswaan.exportPDF');
    Route::get('/{id}/download', [WakaKesiswaanController::class, 'downloadFiles'])->name('waka_kesiswaan.download');
});

// Routes for Kepsek
Route::prefix('administrasi-keguruan/kepsek')->group(function () {
    Route::get('/', [KepsekController::class, 'index'])->name('kepsek.index');
    Route::get('/create', [KepsekController::class, 'create'])->name('kepsek.create');
    Route::post('/', [KepsekController::class, 'store'])->name('kepsek.store');
    Route::get('/{id}/edit', [KepsekController::class, 'edit'])->name('kepsek.edit');
    Route::put('/{id}', [KepsekController::class, 'update'])->name('kepsek.update');
    Route::delete('/{id}', [KepsekController::class, 'destroy'])->name('kepsek.destroy');
    Route::get('/exportPDF/{id}', [KepsekController::class, 'exportPDF'])->name('kepsek.exportPDF');
    Route::get('/download/{id}', [KepsekController::class, 'downloadFiles'])->name('kepsek.download');
});

// Routes for Supervisi
Route::prefix('administrasi-keguruan/supervisi')->group(function () {
    Route::get('/', [SupervisiController::class, 'index'])->name('supervisi.index');
    Route::get('/create', [SupervisiController::class, 'create'])->name('supervisi.create');
    Route::post('/', [SupervisiController::class, 'store'])->name('supervisi.store');
    Route::get('/{id}/edit', [SupervisiController::class, 'edit'])->name('supervisi.edit');
    Route::put('/{id}', [SupervisiController::class, 'update'])->name('supervisi.update');
    Route::delete('/{id}', [SupervisiController::class, 'destroy'])->name('supervisi.destroy');
});
