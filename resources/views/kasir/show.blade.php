@extends('layouts.app')
@section('title', 'Detail Pembayaran')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h4 class="m-0">
                    <i class="fas fa-file-invoice-dollar me-2"></i> Detail Pembayaran
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <div class="card shadow-sm card-outline">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Rincian Pembayaran</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 200px;">Nama Pasien</th>
                        <td>{{ $pembayaran['kunjungan']['pasien']['nama_lengkap'] }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pembayaran</th>
                        <td>{{ \Carbon\Carbon::parse($pembayaran['tanggal_pembayaran'])->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td>{{ ucfirst($pembayaran['metode_pembayaran']) }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-{{ $pembayaran['status'] == 'belum_dibayar' ? 'warning' : 'success' }}">
                                {{ ucwords(str_replace('_', ' ', $pembayaran['status'])) }}
                            </span>
                        </td>
                    </tr>
                </table>

                <hr>

                <div class="row mb-3">
                    <!-- form untuk ubah metode pembayaran bisa ditambahkan di sini jika dibutuhkan -->
                </div>

                <h6 class="mt-4">Detail Biaya</h6>
                <table class="table table-striped table-bordered mt-2">
                    <thead class="table-primary">
                        <tr>
                            <th>Jenis Biaya</th>
                            <th>Keterangan</th>
                            <th class="text-end">Jumlah (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayaran['detail_pembayaran'] as $detail)
                            <tr>
                                <td>{{ ucfirst($detail['jenis_biaya']) }}</td>
                                <td>{{ $detail['keterangan'] }}</td>
                                <td class="text-end">{{ number_format($detail['jumlah'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    @php
                        $total = collect($pembayaran['detail_pembayaran'])->sum('jumlah');
                    @endphp
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-end">Total</th>
                            <th class="text-end text-success">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row m-2 mb-3">
                <div class="col-md-6">
                    <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <form action="{{ route('pembayaran.update', $pembayaran['id_pembayaran']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">
                            Verifikasi Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('.toast').toast('show');
        $('#datatable-main-instruksi').DataTable();
    });
</script>
@endpush
