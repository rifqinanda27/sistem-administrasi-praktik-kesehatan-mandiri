@extends('layouts.app')
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
                        <span class="info-box-number">{{ count($pasien) }}</span>
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
                        <span class="info-box-number">{{ collect($pasien)->where('jenis_kelamin', 'laki-laki')->count() }}</span>
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
                        <span class="info-box-number">{{ collect($pasien)->where('jenis_kelamin', 'perempuan')->count() }}</span>
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
                            <h3 class="card-title">Data Pasien</h3>
                        </div>
                        <div class="card-body">
                            <table id="datatable-main-pasien" class="table table-bordered table-striped">
                                <thead>
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
                                    @foreach ($pasien as $index => $pasien)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pasien['nama_lengkap'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pasien['tanggal_lahir'])->format('d-m-Y') }}</td>
                                            <td>{{ ucfirst($pasien['jenis_kelamin']) }}</td>
                                            <td>{{ $pasien['no_ktp'] }}</td>
                                            <td>{{ $pasien['alamat'] }}</td>
                                            <td>{{ $pasien['telepon'] }}</td>
                                            <td>{{ $pasien['status_aktif'] ? 'Pasien Aktif' : 'Tidak Aktif' }}</td>
                                            <td>
                                                <!-- <button class="btn btn-sm btn-outline-primary px-4" onclick="window.location.href='rekam-medis/{{ $pasien['id_pasien'] }}'">
                                                    <span class="fas fa-eye" style="font-size: 20px;"></span>
                                                </button> -->
                                                <button class="btn btn-sm custom-outline-btn px-4" onclick="window.location.href='rekam-medis/{{ $pasien['id_pasien'] }}'">
                                                    <span class="fas fa-eye eye-icon"></span>
                                                </button>




                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
            $('#datatable-main-pasien').DataTable();
        });
    </script>
@endpush

