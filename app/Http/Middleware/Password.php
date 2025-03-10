<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class Password
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $protectedRoutes = [
            'dashboard',
            'penilaian',
            'administrasi',
            'finance',
            'sarpras',
            'jamaah.index',
            'inbox.index',
            'patroli.asrama.index',
            'lab.index',
            'ortu.edit',
            'rapor',
            'rpts',
            'rasrama',
            'pat',
            'pts',
            'pas',
            'panitia',
            'pkl',
            // 'average',
            // 'average.create',
            // 'average.perform',
            // 'average.edit',
            // 'average.update',
            // 'average.destroy',
            // 'rapor.create',
            // 'rapor.perform',
            // 'rapor.edit',
            // 'rapor.update',
            // 'rapor.delete',
            // 'rapor.pdf',
            // 'rpts.create',
            // 'rpts.perform',
            // 'rpts.edit',
            // 'rpts.update',
            // 'rpts.delete',
            // 'rpts.pdf',
            // 'rasrama.create',
            // 'rasrama.perform',
            // 'rasrama.edit',
            // 'rasrama.update',
            // 'rasrama.delete',
            // 'rasrama.pdf',
            // 'pas.create',
            // 'pas.perform',
            // 'pas.edit',
            // 'pas.update',
            // 'pas.delete',
            // 'pas.download',
            // 'pat.create',
            // 'pat.perform',
            // 'pat.edit',
            // 'pat.update',
            // 'pat.delete',
            // 'pat.download',
            // 'pts.create',
            // 'pts.perform',
            // 'pts.edit',
            // 'pts.update',
            // 'pts.delete',
            // 'pts.download',
            // 'panitia.create',
            // 'panitia.perform',
            // 'panitia.edit',
            // 'panitia.update',
            // 'panitia.delete',
            // 'panitia.download',
            // 'school-purchases.index',
            // 'good-items-school',
            // 'damaged-items-school',
            // 'school-purchases.store',
            // 'school-purchases.download',
            // 'school-purchases.create',
            // 'school-purchases.edit',
            // 'school-purchases.update',
            // 'school-purchases.destroy',
            // 'school-purchases.print',
            // 'damaged-items-school.getDamaged',
            // 'damaged-items-school.edit',
            // 'damaged-items-school.damaged',
            // 'dorm-purchases.index',
            // 'good-items-dorm',
            // 'damaged-items-dorm',
            // 'dorm-purchases.store',
            // 'dorm-purchases.download',
            // 'dorm-purchases.create',
            // 'dorm-purchases.edit',
            // 'dorm-purchases.update',
            // 'dorm-purchases.destroy',
            // 'dorm-purchases.print',
            // 'damaged-items-dorm.getDamaged',
            // 'damaged-items-dorm.edit',
            // 'damaged-items-dorm.damaged',
            // 'pkl.sekolah.index',
            // 'pkl.sekolah.create',
            // 'pkl.sekolah.store',
            // 'pkl.sekolah.edit',
            // 'pkl.sekolah.update',
            // 'pkl.sekolah.destroy',
            // 'pkl.siswa.index',
            // 'pkl.siswa.create',
            // 'pkl.siswa.store',
            // 'pkl.siswa.edit',
            // 'pkl.siswa.update',
            // 'pkl.siswa.destroy',
            // 'guru.index',
            // 'guru.create',
            // 'guru.edit',
            // 'guru.update',
            // 'guru.store',
            // 'guru.destroy',
            // 'guru.download',
            // 'guru.exportPdf',
            // 'guru.download.file',
            // 'tendik.index',
            // 'tendik.create',
            // 'tendik.edit',
            // 'tendik.store',
            // 'tendik.destroy',
            // 'tendik.update',
            // 'tendik.exportPdf',
            // 'prestasi.index',
            // 'prestasi.create',
            // 'prestasi.store',
            // 'prestasi.edit',
            // 'prestasi.update',
            // 'prestasi.destroy',
            // 'prestasi.exportPdf',
            // 'siswa.index',
            // 'siswa.create',
            // 'siswa.store',
            // 'siswa.edit',
            // 'siswa.update',
            // 'siswa.destroy',
            // 'siswa.exportPdf',
            // 'mutasi.index',
            // 'mutasi.create',
            // 'mutasi.store',
            // 'mutasi.edit',
            // 'mutasi.update',
            // 'mutasi.destroy',
            // 'mutasi.export',
            // 'kelulusan.index',
            // 'kelulusan.create',
            // 'kelulusan.store',
            // 'kelulusan.edit',
            // 'kelulusan.update',
            // 'kelulusan.destroy',
            // 'kelulusan.export.data',
            // 'kelulusan.export',
            // 'kelas.index',
            // 'kelas.store',
            // 'kelas.edit',
            // 'kelas.update',
            // 'kelas.destroy',
            // 'kelas.export.data',
            // 'kelas.export',
            // 'kelas.upgrade',
            // 'kelas.create',
            // 'punishment.index',
            // 'punishment.create',
            // 'punishment.store',
            // 'punishment.edit',
            // 'punishment.update',
            // 'punishment.destroy',
            // 'punishment.export',
            // 'file.guru',
            // 'file.tendik',
            // 'file.siswa',
            // 'file.pkl.sekolah',
            // 'file.siswa.sekolah',
            // 'tahfidz',
            // 'tahfidz.create',
            // 'tahfidz.perform',
            // 'tahfidz.edit',
            // 'tahfidz.update',
            // 'tahfidz.delete',
            // 'tahsin',
            // 'tahsin.create',
            // 'tahsin.perform',
            // 'tahsin.edit',
            // 'tahsin.update',
            // 'tahsin.delete',
            // 'sertifikat',
            // 'sertifikat.create',
            // 'sertifikat.perform',
            // 'sertifikat.edit',
            // 'sertifikat.update',
            // 'sertifikat.delete',
            // 'pelatihan.index',
            // 'pelatihan.create',
            // 'pelatihan.store',
            // 'pelatihan.edit',
            // 'pelatihan.update',
            // 'pelatihan.delete',
            // 'lomba.index',
            // 'lomba.create',
            // 'lomba.store',
            // 'lomba.edit',
            // 'lomba.update',
            // 'lomba.delete',
            // 'eventual.index',
            // 'eventual.create',
            // 'eventual.store',
            // 'eventual.edit',
            // 'eventual.update',
            // 'eventual.delete',
            // 'akhlak.index',
            // 'akhlak.create',
            // 'akhlak.store',
            // 'akhlak.edit',
            // 'akhlak.update',
            // 'akhlak.delete',
            // 'fiqih.index',
            // 'fiqih.create',
            // 'fiqih.store',
            // 'fiqih.edit',
            // 'fiqih.update',
            // 'fiqih.delete',
            // 'tafsir.index',
            // 'tafsir.create',
            // 'tafsir.store',
            // 'tafsir.edit',
            // 'tafsir.update',
            // 'tafsir.delete',
            // 'tajwid.index',
            // 'tajwid.create',
            // 'tajwid.store',
            // 'tajwid.edit',
            // 'tajwid.update',
            // 'tajwid.delete',
            // 'lab.create',
            // 'lab.store',
            // 'lab.edit',
            // 'lab.update',
            // 'lab.delete',
            // 'alumni',
            // 'alumni.create',
            // 'ortu',
            // 'ortu.create',
            // 'dinas',
            // 'dinas.create',
            // 'industri',
            // 'industri.create',
            // 'tamu',
            // 'tamu.create',
            // 'kunjungan.export',
            // 'kunjungan.industri.update',
            // 'kunjungan.store',
            // 'kunjungan.update',
            // 'kunjungan.industri.delete',
            // 'progres-siswa.index',
            // 'pdf',
            // 'inbox.store',
            // 'inbox.edit',
            // 'inbox.download',
            // 'inbox.update',
            // 'inbox.pdf',
            // 'inbox.destroy',
            // 'outbox.store',
            // 'outbox.edit',
            // 'outbox.download',
            // 'outbox.update',
            // 'outbox.destroy',
            // 'sp.store',
            // 'sp.edit',
            // 'sp.download',
            // 'sp.update',
            // 'sp.destroy',
            // 'no_surat.store',
            // 'no_surat.edit',
            // 'no_surat.download',
            // 'no_surat.update',
            // 'no_surat.destroy',
            // 'notulensi.store',
            // 'notulensi.edit',
            // 'notulensi.download',
            // 'notulensi.download_dokumentasi',
            // 'notulensi.update',
            // 'notulensi.destroy',
            // 'pengajuan.store',
            // 'pengajuan.edit',
            // 'pengajuan.download',
            // 'pengajuan.update',
            // 'pengajuan.destroy',
            // 'mapel.index',
            // 'mapel.create',
            // 'mapel.store',
            // 'mapel.edit',
            // 'mapel.update',
            // 'mapel.destroy',
            // 'mapel.download',
            // 'kepalaLabKom.index',
            // 'kepalaLabKom.create',
            // 'kepalaLabKom.store',
            // 'kepalaLabKom.edit',
            // 'kepalaLabKom.update',
            // 'kepalaLabKom.destroy',
            // 'kepalaLabKom.download',
            // 'osis.index',
            // 'osis.create',
            // 'osis.store',
            // 'osis.edit',
            // 'osis.update',
            // 'osis.destroy',
            // 'osis.download',
            // 'perpustakaan.index',
            // 'perpustakaan.create',
            // 'perpustakaan.store',
            // 'perpustakaan.edit',
            // 'perpustakaan.update',
            // 'perpustakaan.destroy',
            // 'perpustakaan.download',
            // 'walas.index',
            // 'walas.create',
            // 'walas.store',
            // 'walas.edit',
            // 'walas.update',
            // 'walas.destroy',
            // 'walas.downloadFile',
            // 'waka_kurikulum.index',
            // 'waka_kurikulum.create',
            // 'waka_kurikulum.store',
            // 'waka_kurikulum.edit',
            // 'waka_kurikulum.update',
            // 'waka_kurikulum.destroy',
            // 'waka_kurikulum.exportPDF',
            // 'waka_kurikulum.downloadFile',
            // 'waka_kesiswaan.index',
            // 'waka_kesiswaan.create',
            // 'waka_kesiswaan.store',
            // 'waka_kesiswaan.edit',
            // 'waka_kesiswaan.update',
            // 'waka_kesiswaan.destroy',
            // 'waka_kesiswaan.exportPDF',
            // 'waka_kesiswaan.download',
            // 'kepsek.index',
            // 'kepsek.create',
            // 'kepsek.store',
            // 'kepsek.edit',
            // 'kepsek.update',
            // 'kepsek.destroy',
            // 'kepsek.exportPDF',
            // 'kepsek.download',
            // 'supervisi.index',
            // 'supervisi.create',
            // 'supervisi.store',
            // 'supervisi.edit',
            // 'supervisi.update',
            // 'supervisi.destroy',
            // 'keasramaan',
            // 'quran',
            // 'akademik',
            // 'jurnal',
            // 'kunjungan',

        ];
        $currentRouteName = Route::currentRouteName();
        $currentRouteUri = Route::current()->uri();

        if (!in_array($currentRouteName, $protectedRoutes)) {
            $request->session()->forget('pin');
        } else {
            $pin = $request->session()->get('pin');

            if (!$pin) {
                return redirect()->route('pin', ['redirect_url' => '/' . $currentRouteUri])->with('error', 'Please enter your PIN to access this URL.');
            }
        }
        return $next($request);
    }
}
