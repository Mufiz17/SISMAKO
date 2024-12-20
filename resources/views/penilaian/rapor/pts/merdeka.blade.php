<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Card</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.5;
            font-size: 13px;
            /* Adjusted for F4 size */
        }

        .dnone {
            display: none;
        }

        .head tr,
        .head td {
            border: none;
            font-weight: bold
        }

        .p {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .p h2 {
            margin: 0;
        }

        .p img {
            height: 120px;
        }

        .student-info {
            margin-bottom: 20px;
        }

        .student-info span {
            display: inline-block;
            width: 220px;
        }

        .main-content {
            display: flex;
            justify-content: space-between;
            max-width: 97%;
        }

        .rapor {
            border: none
        }

        .group {
            margin: 0;
            padding-top: 5px;
            vertical-align: top;
            border: none;
        }

        table.group,
        table.attendance,
        table.achievements {
            width: 100%;
            border-collapse: collapse;
        }

        table.attendance th,
        table.attendance td,
        table.achievements th,
        table.achievements td {
            padding: 2px 4px;
            margin: 0;
            font-size: 12px;
        }

        table.attendance th,
        table.achievements th {
            font-weight: bold;
        }

        .achievements th,
        .achievements td {
            text-align: left;
        }

        .achievements td.text-center {
            text-align: center;
        }

        .border {
            border: none;
            vertical-align: top;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #0288D1;
            padding: 5px;
        }

        th {
            background-color: #0288D1;
            font-weight: normal;
            color: #fff;
        }

        .guide {
            vertical-align: top;
            border: none;
        }

        .kkm,
        .grade,
        .predicate {
            text-align: center;
        }

        .rating-scale,
        .attendance {
            width: 100%;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
        }

        .group-header {
            background-color: #0288D1;
            color: #fff;
            width: 100%
        }

        .gh-header {
            width: 75%;
        }

        .gh-width {
            text-align: center;
        }

        .rating-scale p,
        .attendance p {
            margin: 5px 0;
        }

        table.note {
            font-size: 8px;
            /* Mengecilkan ukuran font */
            width: 98%;
            /* Atur lebar tabel sesuai kebutuhan */
        }

        table.note td {
            padding: 5px;
            /* Mengecilkan padding untuk sel */
        }


        .signature {
            width: 100%;
        }

        .signature tr td {
            text-align: center;
            border: none;
        }

        .right-signature,
        .left-signature {
            width: 30%
        }

        td.name {
            text-decoration: underline;
        }
    </style>

</head>

<body>
    <div class="report-card">
        <table class="head" style="margin-left: 10px;">
            <tr>
                <td>
                    <span>LAPORAN HASIL PENILAIAN TENGAH SEMESTER {{$rpts->semester}}<br>TAHUN
                        AJARAN {{$rpts->tahun_ajaran}}</span>
                </td>
                <td>
                    <?php
        $path = public_path('dist/img/logo/Logo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>
                <img src="{{ $base64 }}" alt="Profile Image" style="width: 200px;">
            </td>
            </tr>
        </table>

        <div class="student-info" style="font-size: 13px; margin-left: 10px;">
            <p><span>Nama Peserta Didik</span> : {{$rpts->nama}}</p>
            <p><span>Kelas</span> : {{$rpts->kelas}}</p>
        </div>

        @php
        $i = 1;
        @endphp
        <table class="group" style="padding: 0; margin:0; width: 100%;">
            <tr>
                <td style="vertical-align: top; border: none; padding: 0; margin: 0;">
                    <table class="attendance" style="font-size: 10px; width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="padding: 2px; width: 7%; text-align: center;">No</th>
                                <th style="padding: 2px; width: 60%;">Mata Pelajaran</th>
                                <th style="padding: 2px; width: 11%;">KKM</th>
                                <th style="padding: 2px; width: 11%;">Nilai</th>
                                <th style="padding: 2px; width: 11%;">Predikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($rpts->pai))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Pendidikan Agama dan Budi Pekerti</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->pai }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->pai >= 93 && $rpts->pai <= 100) A @elseif ($rpts->pai >= 84 &&
                                        $rpts->pai <= 92) B @elseif ($rpts->pai >= 75 && $rpts->pai <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif

                            @if (!empty($rpts->pkn))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Pendidikan Pancasila dan Kewarganegaraan</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->pkn }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->pkn >= 93 && $rpts->pkn <= 100) A @elseif ($rpts->pkn >= 84 &&
                                        $rpts->pkn <= 92) B @elseif ($rpts->pkn >= 75 && $rpts->pkn <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif

                            @if (!empty($rpts->indo))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Bahasa Indonesia</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->indo }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->indo >= 93 && $rpts->indo <= 100) A @elseif ($rpts->indo >= 84 &&
                                        $rpts->indo <= 92) B @elseif ($rpts->indo >= 75 && $rpts->indo <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif

                            @if (!empty($rpts->mtk))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Matematika</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->mtk }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->mtk >= 93 && $rpts->mtk <= 100) A @elseif ($rpts->mtk >= 84 &&
                                        $rpts->mtk <= 92) B @elseif ($rpts->mtk >= 75 && $rpts->mtk <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif

                            @if (!empty($rpts->sejindo))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Sejarah Indonesia</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->sejindo }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->sejindo >= 93 && $rpts->sejindo <= 100) A @elseif ($rpts->sejindo >= 84
                                        && $rpts->sejindo <= 92) B @elseif ($rpts->sejindo >= 75 && $rpts->sejindo <=
                                                83) C @else D @endif </td>
                            </tr>
                            @endif

                            @if (!empty($rpts->bhs_asing))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Bahasa Inggris</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->bhs_asing }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->bhs_asing >= 93 && $rpts->bhs_asing <= 100) A @elseif ($rpts->bhs_asing
                                        >= 84 && $rpts->bhs_asing <= 92) B @elseif ($rpts->bhs_asing >= 75 &&
                                            $rpts->bhs_asing <= 83) C @else D @endif </td>
                            </tr>
                            @endif

                            @if (!empty($rpts->sbd))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Seni Budaya</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->sbd }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->sbd >= 93 && $rpts->sbd <= 100) A @elseif ($rpts->sbd >= 84 &&
                                        $rpts->sbd <= 92) B @elseif ($rpts->sbd >= 75 && $rpts->sbd <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif

                            @if (!empty($rpts->pjok))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Pendidikan Jasmani, Olahraga, dan Kesehatan</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->pjok }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->pjok >= 93 && $rpts->pjok <= 100) A @elseif ($rpts->pjok >= 84 &&
                                        $rpts->pjok <= 92) B @elseif ($rpts->pjok >= 75 && $rpts->pjok <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif

                            @if (!empty($rpts->simdig))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Informatika</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->simdig }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->simdig >= 93 && $rpts->simdig <= 100) A @elseif ($rpts->simdig >= 84 &&
                                        $rpts->simdig <= 92) B @elseif ($rpts->simdig >= 75 && $rpts->simdig <= 83) C
                                                @else D @endif </td>
                            </tr>
                            @endif
                            @if (!empty($rpts->fis))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Ilmu Pengetahuan Alam dan Sosial</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->fis }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->fis >= 93 && $rpts->fis <= 100) A @elseif ($rpts->fis >= 84 &&
                                        $rpts->fis <= 92) B @elseif ($rpts->fis >= 75 && $rpts->fis <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif
                            @if (!empty($rpts->kim))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Dasar Dasar Program Keahlian</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->kim }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->kim >= 93 && $rpts->kim <= 100) A @elseif ($rpts->kim >= 84 &&
                                        $rpts->kim <= 92) B @elseif ($rpts->kim >= 75 && $rpts->kim <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif
                            @if (!empty($rpts->sis_kom))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Sistem Komputer</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->sis_kom }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->sis_kom >= 93 && $rpts->sis_kom <= 100) A @elseif ($rpts->sis_kom >= 84
                                        && $rpts->sis_kom <= 92) B @elseif ($rpts->sis_kom >= 75 && $rpts->sis_kom <=
                                                83) C @else D @endif </td>
                            </tr>
                            @endif
                            @if (!empty($rpts->komjar))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Komputer dan Jaringan Dasar</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->komjar }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->komjar >= 93 && $rpts->komjar <= 100) A @elseif ($rpts->komjar >= 84 &&
                                        $rpts->komjar <= 92) B @elseif ($rpts->komjar >= 75 && $rpts->komjar <= 83) C
                                                @else D @endif </td>
                            </tr>
                            @endif
                            @if (!empty($rpts->progdas))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Pemrograman Dasar</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->progdas }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->progdas >= 93 && $rpts->progdas <= 100) A @elseif ($rpts->progdas >= 84
                                        && $rpts->progdas <= 92) B @elseif ($rpts->progdas >= 75 && $rpts->progdas <=
                                                83) C @else D @endif </td>
                            </tr>
                            @endif
                            @if (!empty($rpts->ddg))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Dasar Desain Grafis</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->ddg }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->ddg >= 93 && $rpts->ddg <= 100) A @elseif ($rpts->ddg >= 84 &&
                                        $rpts->ddg <= 92) B @elseif ($rpts->ddg >= 75 && $rpts->ddg <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif
                            @if (!empty($rpts->iaas))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Infrastruktur Komputasi Awan</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->iaas }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->iaas >= 93 && $rpts->iaas <= 100) A @elseif ($rpts->iaas >= 84 &&
                                        $rpts->iaas <= 92) B @elseif ($rpts->iaas >= 75 && $rpts->iaas <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif
                            @if (!empty($rpts->paas))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Platform Komputasi Awan</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->paas }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->paas >= 93 && $rpts->paas <= 100) A @elseif ($rpts->paas >= 84 &&
                                        $rpts->paas <= 92) B @elseif ($rpts->paas >= 75 && $rpts->paas <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif
                            @if (!empty($rpts->saas))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Layanan Komputasi Awan</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->saas }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->saas >= 93 && $rpts->saas <= 100) A @elseif ($rpts->saas >= 84 &&
                                        $rpts->saas <= 92) B @elseif ($rpts->saas >= 75 && $rpts->saas <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif
                            @if (!empty($rpts->siot))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Sistem Internet of Things</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->siot }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->siot >= 93 && $rpts->siot <= 100) A @elseif ($rpts->siot >= 84 &&
                                        $rpts->siot <= 92) B @elseif ($rpts->siot >= 75 && $rpts->siot <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif
                            @if (!empty($rpts->skj))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Sistem Keamanan Jaringan</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->skj }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->skj >= 93 && $rpts->skj <= 100) A @elseif ($rpts->skj >= 84 &&
                                        $rpts->skj <= 92) B @elseif ($rpts->skj >= 75 && $rpts->skj <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif
                            @if (!empty($rpts->pkk))
                            <tr>
                                <td style="padding: 2px;  text-align: center;">{{ $i++ }}</td>
                                <td style="padding: 2px;">Produk Kreatif dan Kewirausahaan</td>
                                <td class="kkm" style="padding: 2px;">75</td>
                                <td class="grade" style="padding: 2px;">{{ $rpts->pkk }}</td>
                                <td class="predicate" style="padding: 2px;">
                                    @if ($rpts->pkk >= 93 && $rpts->pkk <= 100) A @elseif ($rpts->pkk >= 84 &&
                                        $rpts->pkk <= 92) B @elseif ($rpts->pkk >= 75 && $rpts->pkk <= 83) C @else D
                                                @endif </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </td>
                <td style="vertical-align: top; border: none; padding: 5px;">
                    <table class="achievements" style="font-size: 10px; width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th colspan="3" style="padding: 2px; text-align:center;"><strong>Rentang
                                        Predikat</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 20%; text-align:center; padding: 2px;">A</td>
                                <td style="width: 55%; padding: 2px;">Amat Baik</td>
                                <td style="width: 25%; text-align:center; padding: 2px;">93-100</td>
                            </tr>
                            <tr>
                                <td style="width: 20%; text-align:center; padding: 2px;">B</td>
                                <td style="width: 55%; padding: 2px;">Baik</td>
                                <td style="width: 25%; text-align:center; padding: 2px;">84-92</td>
                            </tr>
                            <tr>
                                <td style="width: 20%; text-align:center; padding: 2px;">C</td>
                                <td style="width: 55%; padding: 2px;">Cukup</td>
                                <td style="width: 25%; text-align:center; padding: 2px;">75-83</td>
                            </tr>
                            <tr>
                                <td style="width: 20%; text-align:center; padding: 2px;">D</td>
                                <td style="width: 55%; padding: 2px;">Perlu dimaksimalkan</td>
                                <td style="width: 25%; text-align:center; padding: 2px;">0-74</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="achievements" style="font-size: 10px; width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th colspan="2" style="padding: 2px; text-align:center;"><strong>Kehadiran</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 75%; padding: 2px;">Total Pertemuan</td>
                                <td style="width: 25%; text-align:center; padding: 2px;">{{ $rpts->kehadiran }}</td>
                            </tr>
                            <tr>
                                <td style="width: 75%; padding: 2px;">Sakit</td>
                                <td style="width: 25%; text-align:center; padding: 2px;">{{ $rpts->sakit }}</td>
                            </tr>
                            <tr>
                                <td style="width: 75%; padding: 2px;">Izin</td>
                                <td style="width: 25%; text-align:center; padding: 2px;">{{ $rpts->izin }}</td>
                            </tr>
                            <tr>
                                <td style="width: 75%; padding: 2px;">Alpha</td>
                                <td style="width: 25%; text-align:center; padding: 2px;">{{ $rpts->alpha }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>

        <table class="note" style="margin-left: 10px;">
            <thead>
                <tr class="dnone">
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="group-header">
                    <td colspan="1" style="font-size: 13px"><strong>Catatan</strong></td>
                </tr>
                <tr style="font-size: 13px;">
                    <td>{{ $rpts->note }}</td>
                </tr>
            </tbody>
        </table>

        <table class="signature">
            <tr>
                <td>Mengetahui,</td>
                <td></td>
                <td>
                    Bogor, {{ \Carbon\Carbon::parse($rpts->released)->translatedFormat('d F Y') }}
                </td>

            </tr>
            <tr>
                <td class='right-signature'>Kepala Sekolah,</td>
                <td class="center-signature"></td>
                <td class='left-signature'>Wali Kelas</td>
            </tr>
            <tr>
                <td><br><br><br><br></td>
                <td><br><br><br><br></td>
            </tr>
            <tr>
                <td class="name">{{ $rpts->hmaster }}</td>
                <td></td>
                <td class="name">{{ $rpts->wname }}</td>
            </tr>
            <tr>
                <td>NIK. {{ $rpts->hmnip }}</td>
                <td></td>
                <td>NIK. {{ $rpts->nip }}</td>
            </tr>
        </table>
    </div>
    </div>

</body>

</html>
