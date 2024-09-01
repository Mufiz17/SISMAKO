<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Layout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 5px;
            vertical-align: top;
        }

        .info-table td:first-child {
            width: 50px;
        }

        .photo-box {
            width: 100%;
            height: 100%;
            margin-left: 40px;
            display: inline-block;
        }

        .section {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .section th,
        .section td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        .section th {
            background-color: #d9d9da;
        }

        .tahfidz-section th {
            background-color: #d9d9da;
        }

        .tahsin-section th {
            background-color: #d9d9da;
        }

        .akademik-section th {
            background-color: #d9d9da;
        }

        .jurnal-section th {
            background-color: #d9d9da;
        }

        .certificates {
            padding-top: 10px;
        }

        .certificates td {
            border: none;
        }

        .certificates input[type="checkbox"] {
            margin-right: 10px;
        }

        .jurnal-section {
            margin-top: 20px;
        }

        .jurnal-section th {
            background-color: ;
        }

        .jurnal-section td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>PROGRES PESERTA DIDIK</h2>
            <h3>SMK TI BAZMA</h3>
            <p>Tanggal: {{ \Carbon\Carbon::parse($start_date)->translatedFormat('d F Y') }} -
                {{ \Carbon\Carbon::parse($end_date)->translatedFormat('d F Y') }}</p>
        </div>
        <table class="info-table">
            <tr>
                <td>Nama</td>
                <td>: {{ $siswa->nama }}</td>
                <td rowspan="4">
                    <div class="photo-box">
                        <img src="{{ $siswa->fotoSiswa[0]->path_file }}" alt=""
                            style="height: 140px; border-radius: 10px">
                    </div>
                </td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>: {{ $siswa->nisn }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>: {{ $siswa->dataKelas[0]->kelas }}</td>
            </tr>
            <tr>
                <td>TP</td>
                <td>: {{ $siswa->tahun_pelajaran }}</td>
            </tr>
        </table>
        <table class="section tahfidz-section">
            <thead>
                <tr>
                    <th colspan="6" style="background-color: #A9D08E; text-align: center;">Tahfidz</th>
                </tr>
                <tr>
                    <th style="width: 5%; text-align: center;">No</th>
                    <th style="width: 19%; text-align: center;">Tanggal</th>
                    <th style="width: 19%; text-align: center;">Surat</th>
                    <th style="width: 19%; text-align: center;">Ayat</th>
                    <th style="width: 19%; text-align: center;">Keterangan</th>
                    <th style="width: 19%; text-align: center;">Pengajar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa->tahfidzSiswa as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->surat }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->predikat }}</td>
                        <td>{{ $item->pengajar }}</td>
                @endforeach
            </tbody>
        </table>
        <table class="certificates">
            <tr>
                <td>Sertifikat Juz 30:</td>
                <td>
                    <input type="checkbox"
                        {{ isset($siswa->sertifikatSiswa[0]->juz_30) && !is_null($siswa->sertifikatSiswa[0]->juz_30) ? 'checked' : '' }}>
                </td>
                <td>Sertifikat Juz 29:</td>
                <td>
                    <input type="checkbox"
                        {{ isset($siswa->sertifikatSiswa[0]->juz_29) && !is_null($siswa->sertifikatSiswa[0]->juz_29) ? 'checked' : '' }}>
                </td>
                <td>Sertifikat Juz 28:</td>
                <td>
                    <input type="checkbox"
                        {{ isset($siswa->sertifikatSiswa[0]->juz_28) && !is_null($siswa->sertifikatSiswa[0]->juz_28) ? 'checked' : '' }}>
                </td>
                <td>Sertifikat Juz Umum</td>
                <td>
                    <input type="checkbox"
                        {{ isset($siswa->sertifikatSiswa[0]->juz_umum) && !is_null($siswa->sertifikatSiswa[0]->juz_umum) ? 'checked' : '' }}>
                </td>
            </tr>
        </table>
        <table class="section tahsin-section">
            <thead>
                <tr>
                    <th colspan="6" style="background-color: #FF6666; text-align: center;">Tahsin</th>
                </tr>
                <tr>
                    <th style="width: 5%; text-align: center;">No</th>
                    <th style="width: 19%; text-align: center;">Tanggal</th>
                    <th style="width: 19%; text-align: center;">Surat</th>
                    <th style="width: 19%; text-align: center;">Ayat</th>
                    <th style="width: 19%; text-align: center;">Keterangan</th>
                    <th style="width: 19%; text-align: center;">Pengajar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa->tahsinSiswa as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->surat }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->predikat }}</td>
                        <td>{{ $item->pengajar }}</td>
                @endforeach
            </tbody>
        </table>
        <table class="section akademik-section">
            <thead>
                <tr>
                    <th colspan="4" style="background-color: #BDD7EE; text-align: center;">Akademik</th>
                </tr>
                <tr>
                    <th style="width: 5%; text-align: center;">No</th>
                    <th style="width: 19%; text-align: center;">Tanggal</th>
                    <th>Nama Kegiatan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa->pelatihanSiswa as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->kegiatan }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table id="jurnalTable" class="section jurnal-section">
            <thead>
                <tr>
                    <th colspan="8" style="background-color: #f7caac; text-align: center;">Jurnal Asrama</th>
                </tr>
                <tr>
                    <th colspan="2" style="text-align: center">FIQIH</th>
                    <th colspan="2" style="text-align: center">AKHLAK</th>
                    <th colspan="2" style="text-align: center">TAFSIR</th>
                    <th colspan="2" style="text-align: center">TAJWID</th>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>Materi</td>
                    <td>Tanggal</td>
                    <td>Materi</td>
                    <td>Tanggal</td>
                    <td>Materi</td>
                    <td>Tanggal</td>
                    <td>Materi</td>
                </tr>
            </thead>
            <tbody id="jurnalBody">
                <!-- Rows will be dynamically inserted here -->
            </tbody>
        </table>

    </div>
</body>
<script>
    const data = @json($siswa);
    console.log(data)

    // Convert tajwid object to an array
    const tajwidArray = Object.values(data.jurnalAsramaSiswa.tajwid);

    // Calculate the maximum number of rows needed
    const maxRows = Math.max(
        data.jurnalAsramaSiswa.akhlak.length,
        data.jurnalAsramaSiswa.fiqih.length,
        data.jurnalAsramaSiswa.tafsir.length,
        tajwidArray.length
    );

    // Get the table body element
    const jurnalBody = document.getElementById('jurnalBody');

    // Function to create a table cell with text
    const createCell = (text) => {
        const cell = document.createElement('td');
        cell.innerText = text || '';
        return cell;
    };

    // Populate the table
    for (let i = 0; i < maxRows; i++) {
        const row = document.createElement('tr');

        const fiqih = data.jurnalAsramaSiswa.fiqih[i] || {};
        row.appendChild(createCell(fiqih.tanggal));
        row.appendChild(createCell(fiqih.materi));

        const akhlak = data.jurnalAsramaSiswa.akhlak[i] || {};
        row.appendChild(createCell(akhlak.tanggal));
        row.appendChild(createCell(akhlak.materi));

        const tafsir = data.jurnalAsramaSiswa.tafsir[i] || {};
        row.appendChild(createCell(tafsir.tanggal));
        row.appendChild(createCell(tafsir.materi));

        const tajwid = tajwidArray[i] || {};
        row.appendChild(createCell(tajwid.tanggal));
        row.appendChild(createCell(tajwid.materi));

        jurnalBody.appendChild(row);
    }
</script>

</html>