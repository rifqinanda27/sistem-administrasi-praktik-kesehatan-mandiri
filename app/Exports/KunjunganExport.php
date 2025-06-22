<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KunjunganExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        // data harus collection
        $this->data = collect($data);
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'No. RM'        => $item['catatan_medis']['no_rekam_medis'] ?? '-',
                'Nama Pasien'   => $item['pasien']['nama_lengkap'] ?? '-',
                'Tanggal Lahir' => $item['pasien']['tanggal_lahir'] ?? '-',
                'Jenis Kelamin' => $item['pasien']['jenis_kelamin'] ?? '-',
                'Alamat'        => $item['pasien']['alamat'] ?? '-',
                'Telepon'       => $item['pasien']['telepon'] ?? '-',
                'Dokter'        => $item['dokter']['name'] ?? '-',
                'Tanggal Kunjungan' => $item['tanggal_kunjungan'] ?? '-',
                'Penjamin'      => $item['penjamin']['nama'] ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No. RM',
            'Nama Pasien',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat',
            'Telepon',
            'Dokter',
            'Tanggal Kunjungan',
            'Penjamin',
        ];
    }
}
