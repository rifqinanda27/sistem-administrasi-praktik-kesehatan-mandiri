<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class KunjunganExports implements FromCollection, WithHeadings
{
    protected Collection $data;

    public function __construct(array $data)
    {
        // Pastikan data jadi Collection
        $this->data = collect($data);
    }

    public function collection(): Collection
    {
        return $this->data->map(function ($item) {
            return [
                'id_kunjungan'     => $item['id_kunjungan'] ?? '',
                'nama_pasien'      => $item['pasien']['nama_lengkap'] ?? '',
                'nama_dokter'      => $item['dokter']['name'] ?? '',
                'tanggal_kunjungan'=> $item['tanggal_kunjungan'] ?? '',
                'tipe_kunjungan'   => $item['tipe_kunjungan'] ?? '',
                'status_kunjungan' => $item['status_kunjungan'] ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID Kunjungan',
            'Nama Pasien',
            'Nama Dokter',
            'Tanggal Kunjungan',
            'Tipe Kunjungan',
            'Status Kunjungan',
        ];
    }
}
