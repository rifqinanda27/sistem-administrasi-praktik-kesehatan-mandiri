<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Rujukan Laboratorium</title>
    <style>
        /* Atur tampilan untuk layar dan cetak */
        @media print {
            @page {
                size: A4 portrait; /* Bisa juga "Folio" jika printer support F4 */
                margin: 20mm;
            }
            body {
                margin: 0;
                font-family: Arial, sans-serif;
                font-size: 12px;
            }
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 20mm;
        }

        .header, .footer {
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
            margin-top: 15px;
            border-collapse: collapse;
        }

        .content td {
            padding: 4px;
            vertical-align: top;
        }

        .checkbox {
            display: inline-block;
            width: 13px;
            height: 13px;
            border: 1px solid #000;
            margin-right: 5px;
        }

        .signature {
            margin-top: 60px;
            text-align: right;
        }
        .main-content {
            margin-left: 20px; /* Ubah ke 100px atau sesuai kebutuhan */
        }

    </style>
</head>
<body>

    <div class="header">
        <table>
            <tr>
                <td width="15%"><img src="{{ asset('dist/img/logo-polines.png') }}" alt="Polines Logo"></td>
                <td style="text-align:center;">
                    <strong>
                        PEMERINTAH KOTA SEMARANG<br>
                        DINAS KESEHATAN<br>
                        PBL HEALTHCARE<br>
                        KECAMATAN TEMBALANG
                    </strong><br>
                    Jl. Prof. Soedarto, Tembalang, Kec. Tembalang<br>
                    E-Mail: <span style="color:blue">pusk.healtcare@gmail.com</span> &nbsp; Kode Pos: 50275
                </td>
            </tr>
        </table>
    </div>

    <div class="judul" style="margin-left: 105px;">
        SURAT RUJUKAN LABORATORIUM
    </div>

<!-- Bagian yang ingin digeser ke kanan -->
    <div class="main-content">
        <table class="content">
            <tr><td width="30%">Nama</td><td>: ..........................................................</td></tr>
            <tr><td>Umur</td><td>: ..........................................................</td></tr>
            <tr><td>Rekam Medik</td><td>: ..........................................................</td></tr>
            <tr><td>Jenis Kelamin</td><td>: ..........................................................</td></tr>
            <tr><td>Tempat/Tgl Lahir</td><td>: ..........................................................</td></tr>
            <tr><td>Alamat</td><td>: ..........................................................</td></tr>
            <tr><td>Diagnosa Medik</td><td>: ..........................................................</td></tr>
            <tr><td>Keluhan Pasien</td><td>: ..........................................................</td></tr>
        </table>

        <br>
        <strong>Jenis Pemeriksaan:</strong><br>
        <table>
            <tr>
                <td><div class="checkbox"></div> Hematologi</td>
                <td><div class="checkbox"></div> Kimia Darah</td>
            </tr>
            <tr>
                <td><div class="checkbox"></div> Imunoserology</td>
                <td><div class="checkbox"></div> Urinalisa</td>
            </tr>
            <tr>
                <td><div class="checkbox"></div> Lain-lain</td>
            </tr>
        </table>
    </div>


    <div class="signature">
        KOTA SEMARANG, ....................<br>
        Rujukan Dokter<br><br><br>
        <strong>Januar</strong><br>
        NIP. 19910624 201903 1 001
    </div>

</body>
</html>
