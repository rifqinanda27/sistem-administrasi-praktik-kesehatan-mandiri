@extends('layouts.app')
@section('title', 'Daftar Pasien')
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
                        <h4 class="m-3">Daftar Pasien</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- Breadcrumb bisa ditambahkan di sini jika diperlukan -->
                    </ol>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <!-- Total Pasien -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box bg-white">
                    <span class="info-box-icon custom-icon bg-primary-dark">
                        <i class="fas fa-user"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pasien</span>
                        <span class="info-box-number">{{ count($pasien->items()) }}</span>
                    </div>
                </div>
            </div>
    
            <!-- Pasien Laki-Laki -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box bg-white">
                    <span class="info-box-icon custom-icon bg-blue-light">
                        <i class="far fa-user"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Laki-Laki</span>
                        <span class="info-box-number">{{ collect($pasien->items())->where('jenis_kelamin', 'laki-laki')->count() }}</span>
                    </div>
                </div>
            </div>
    
            <!-- Pasien Perempuan -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box bg-white">
                    <span class="info-box-icon custom-icon bg-pink">
                        <i class="far fa-user"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Perempuan</span>
                        <span class="info-box-number">{{ collect($pasien->items())->where('jenis_kelamin', 'perempuan')->count() }}</span>
                    </div>
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
                                <div class="col-6"></div>
                                <div class="col-6">
                                    <form id="search-form" method="GET" action="{{ route('pasien.index') }}">
                                        <div class="input-group mb-3">
                                            <input type="text" name="search" id="search-input" value="{{ $search }}" class="form-control" placeholder="Cari pasien...">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Cari</button>
                                                @if(request()->has('search') && request()->get('search') !== '')
                                                    <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Clear</a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <th style="width: 10px">#</th>
                                        <th>Nama</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Nomor KTP</th>
                                        <th>Alamat</th>
                                        <th>No. Telp</th>
                                        <th>Status</th> <!-- Tambahkan kolom Status -->
                                        <th>Aksi</th> <!-- Kolom Aksi dengan tombol -->
                                    </thead>
                                    <tbody>
                                        @foreach ($pasien as $index => $p)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $p['nama_lengkap'] }}</td>
                                                <td>{{ \Carbon\Carbon::parse($p['tanggal_lahir'])->format('d-m-Y') }}</td>
                                                <td>{{ ucfirst($p['jenis_kelamin']) }}</td>
                                                <td>{{ $p['no_ktp'] }}</td>
                                                <td>{{ $p['alamat'] }}</td>
                                                <td>{{ $p['telepon'] }}</td>
                                                <td>{{ $p['status_aktif'] ? 'Pasien Aktif' : 'Tidak Aktif' }}</td>
                                                <td>
                                                    <!-- <button class="btn btn-sm btn-outline-primary px-4" onclick="window.location.href='rekam-medis/{{ $pasien['id_pasien'] }}'">
                                                        <span class="fas fa-eye" style="font-size: 20px;"></span>
                                                    </button> -->
                                                    <button class="btn btn-sm custom-outline-btn px-4" onclick="window.location.href='rekam-medis/{{ $p['id_pasien'] }}'">
                                                        <span class="fas fa-eye eye-icon"></span>
                                                    </button>




                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $pasien->appends(['search' => $search])->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

