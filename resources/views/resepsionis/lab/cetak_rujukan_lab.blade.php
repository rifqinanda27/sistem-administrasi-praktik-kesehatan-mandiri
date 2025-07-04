<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Rujukan Laboratorium</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20mm;
        }

        .header {
            text-align: center;
        }

        .header img {
            width: 95px;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
            text-decoration: underline;
            font-size: 16px;
        }

        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .content td {
            padding: 5px;
            vertical-align: top;
        }

        .checkbox {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid #000;
            margin-right: 5px;
        }

        .signature {
            margin-top: 60px;
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="header">
        <table>
            <tr>
                <td width="15%">
                    <!-- <img src="{{ asset('storage/logo/' . $pengaturan->logo) }}" alt="Logo"> -->
                    @php
                        $logoPath = public_path('storage/logo/' . $pengaturan->logo);
                    @endphp
                    <img src="file://{{ $logoPath }}" alt="Logo" width="100">

                </td>
                <td style="text-align:center;">
                    <strong>
                        {!! nl2br(e($pengaturan->kop_surat)) !!}
                    </strong>
                    <br>
                    <!-- Jl. Prof. Soedarto, Tembalang, Kec. Tembalang<br> -->
                     {{ $pengaturan->alamat }}<br>
                    E-Mail: <span style="color:blue">{{ $pengaturan->email }}</span> &nbsp; Kode Pos: {{ $pengaturan->kode_pos }}
                </td>
            </tr>
        </table>
    </div>

    <div class="judul">
        SURAT RUJUKAN LABORATORIUM
    </div>

    <table class="content">
        <tr><td width="30%">Nama</td><td>: {{ $pasien->kunjungan->pasien->nama_lengkap }}</td></tr>
        <tr><td>Umur</td><td>: {{ \Carbon\Carbon::parse($pasien->kunjungan->pasien->tanggal_lahir)->age }}</td></tr>
        <tr><td>Rekam Medik</td><td>: {{ $pasien->no_rekam_medis }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ $pasien->kunjungan->pasien->jenis_kelamin }}</td></tr>
        <tr><td>Tanggal Lahir</td><td>: {{ $pasien->kunjungan->pasien->tanggal_lahir }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $pasien->kunjungan->pasien->alamat }}</td></tr>
        <tr><td>Diagnosa Medik</td><td>: {{ $pasien->diagnosa_sementara }}</td></tr>
        <tr><td>Keluhan Pasien</td><td>: {{ $pasien->keluhan_utama }}</td></tr>
    </table>

    <br>
    <strong>Jenis Pemeriksaan:</strong><br>
    <p>{{ $permintaan_lab->jenis_pemeriksaan_lab->nama_pemeriksaan }}</p>

    <div class="signature">
        KOTA {{ $pengaturan->kota }}, {{ now()->format('d-m-Y') }}<br>
        Rujukan Dokter<br><br><br>
        <strong>{{ $pasien->kunjungan->dokter->name }}</strong><br>
        NIP. {{ $pasien->kunjungan->dokter->dokter_detail->dokter_nip }}
    </div>

</body>
</html>
