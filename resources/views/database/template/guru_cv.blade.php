<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Guru</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">


    <style>
        /* Existing styles */
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            border-radius: 10px;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .title h1 {
            margin: 0;
            font-size: 24px;
            color: #004085;
        }

        .title h3 {
            margin: 5px 0;
            font-size: 18px;
            color: #666;
        }

        .profile {
            display: table;
            width: 100%;
            margin-top: 20px;
        }

        .biodata {
            display: table-cell;
            width: 60%;
            vertical-align: top;
        }

        .profile-img {
            display: table-cell;
            width: 40%;
            padding-left: 20px;
            vertical-align: top;
            text-align: center;
        }

        .profile-img img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .biodata table {
            width: 100%;
            border-collapse: collapse;
        }

        .biodata table th,
        .biodata table td {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .biodata table th {
            width: 150px;
            color: #004085;
            text-align: left;
            font-weight: 700;
        }

        .biodata table td {
            color: #333;
        }

        .biodata table tr:last-child th,
        .biodata table tr:last-child td {
            border-bottom: none;
        }

        /* Print styles */
        @media print {
            body {
                font-family: 'Roboto', Arial, sans-serif;
                background-color: #ffffff;
                margin: 0;
                padding: 0;
            }

            .container {
                padding: 10px;
                border: none;
                border-radius: 0;
            }

            .title {
                text-align: center;
                margin-bottom: 10px;
            }

            .title h1 {
                font-size: 20px;
            }

            .title h3 {
                font-size: 16px;
            }

            .profile {
                display: block;
                width: 100%;
                margin-top: 10px;
            }

            .biodata,
            .profile-img {
                display: block;
                width: 100%;
            }

            .profile-img {
                padding-left: 0;
                text-align: center;
            }

            .profile-img img {
                max-width: 80%;
                height: auto;
            }

            .biodata table th,
            .biodata table td {
                padding: 4px 0;
                border-bottom: 1px solid #ddd;
            }

            .biodata table th {
                width: auto;
                color: #004085;
                font-weight: bold;
            }

            .biodata table td {
                color: #333;
            }

            .biodata table tr:last-child th,
            .biodata table tr:last-child td {
                border-bottom: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">
            <h1>BIODATA GURU</h1>
            <h3>SMK TI BAZMA KABUPATEN BOGOR</h3>
        </div>
        <div class="profile">
            <div class="biodata">
                <table>
                    <tr>
                        <th>Nama</th>
                        <td>: {{ $guru->nama . ', ' . $guru->gelar }}</td>
                    </tr>
                    <tr>
                        <th>Tempat, Tanggal Lahir</th>
                        <td>: {{ $guru->tempat_tanggal_lahir }},
                            {{ \Carbon\Carbon::parse($guru->tanggal_lahir)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Handphone</th>
                        <td>: {{ $guru->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>: {{ $guru->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <td>: {{ $guru->agama }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{ $guru->email }}</td>
                    </tr>
                    <tr>
                        <th>Lulusan Perguruan</th>
                        <td>: {{ $guru->nama_lulusan_pt }}</td>
                    </tr>
                    <tr>
                        <th>Jurusan</th>
                        <td>: {{ $guru->nama_jurusan_pt }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Rekening</th>
                        <td>: {{ $guru->no_rekening }}</td>
                    </tr>
                    <tr>
                        <th>Nomor NIK</th>
                        <td>: {{ $guru->no_nik }}</td>
                    </tr>
                    <tr>
                        <th>Nomor GTK</th>
                        <td>: {{ $guru->no_gtk }}</td>
                    </tr>
                    <tr>
                        <th>Nomor NUPTK</th>
                        <td>: {{ $guru->no_nuptk }}</td>
                    </tr>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <td>: {{ $guru->mapel }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>: {{ \Carbon\Carbon::parse($guru->tanggal_masuk)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Keluar</th>
                        <td>: {{ $guru->tanggal_keluar ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status Kepegawaian</th>
                        <td>: {{ $guru->status_kepegawaian }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>: {{ str_replace('==', '', $guru->alamat) }}</td>
                    </tr>
                </table>
            </div>
            <div class="profile-img">
                <?php
                $path = public_path($guru->foto);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                ?>
                <img src="{{ $base64 }}" alt="Profile Image">
            </div>
        </div>
    </div>
</body>

</html>