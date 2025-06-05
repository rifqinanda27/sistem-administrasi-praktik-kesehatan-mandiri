@extends('layouts.app')

@section('title', 'Daftar Kunjungan')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <!-- Ikon User -->
                        <span class="fas fa-user-injured mr-1" style="font-size: 29px;"></span>
                        <!-- Judul -->
                        <h4 class="m-3">Daftar Kunjungan</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- Breadcrumb bisa ditambahkan di sini jika diperlukan -->
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <form id="search-form" method="GET" action="{{ route('kunjungan.index') }}">
                                        <div class="input-group mb-3">
                                            <input type="text" name="search" id="search-input" value="{{ $search }}" class="form-control" placeholder="Cari kunjungan...">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Cari</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <div class="card-tools">
                                        <a href="{{ route('kunjungan.create') }}" class="btn btn-primary"><span class="fas fa-user-plus"></span> Tambah Kunjungan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <th style="width: 10px">#</th>
                                    <th>Nama</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Tipe Kunjungan</th>
                                    <th>Tipe Penjamin</th>
                                    <th>Status</th> <!-- Tambahkan kolom Status -->
                                    <th>Aksi</th> <!-- Kolom Aksi dengan tombol -->
                                </thead>
                                <tbody>
                                    @foreach ($kunjungan as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item['pasien']['nama_lengkap'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item['tanggal_kunjungan'])->format('d-m-Y') }}</td>
                                            <td>{{ $item['tipe_kunjungan'] }}</td>
                                            <td>{{ $item['penjamin']['nama'] }}</td>
                                            <td>{{ $item['status_kunjungan'] }}</td>
                                            <td>
                                                @if($item['status_kunjungan'] != 'selesai')
                                                    <button class="btn btn-danger">Batal</button>
                                                @else
                                                    <p class="btn btn-success">Selesai</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $kunjungan->appends(['search' => $search])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
@push('js')
    <script>
        $('.toast').toast('show')
        $(document).ready(function() {
            $('#datatable-main-kunjungan').DataTable();
        });
    </script>
@endpush

