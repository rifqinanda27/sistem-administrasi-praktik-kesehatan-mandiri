@extends('layouts.app')

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
    </div>

    <div class="row mb-4" style="margin-left: 10px;"> <!-- Menambahkan margin kiri pada row -->
        <!-- Total Pasien -->
        <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
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
        <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
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
        <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
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


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <!-- <h5 class="m-0">Judul Section</h5> -->
                             <!-- search bar -->
                            <div class="input-group mb-3" style="max-width: 400px;">
                                <input type="text" class="form-control" placeholder="cari nomor atau nama calon pasien.." aria-label="Cari pasien" aria-describedby="basic-addon2">
                                <button class="btn btn-outline-secondary" type="button" id="basic-addon2">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                        <!-- tabel -->


                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Data Pasien</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th style="width: 10px">#</th>
                                            <th>Nomor Rekam Medis</th>
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
                                                <tr class="align-middle">
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $pasien['no_rekam_medis'] }}</td>
                                                    <td>{{ $pasien['nama_lengkap'] }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($pasien['tanggal_lahir'])->format('d-m-Y') }}</td>
                                                    <td>{{ ucfirst($pasien['jenis_kelamin']) }}</td>
                                                    <td>{{ $pasien['no_ktp'] }}</td>
                                                    <td>{{ $pasien['alamat'] }}</td>
                                                    <td>{{ $pasien['telepon'] }}</td>
                                                    <td>{{ $pasien['status_aktif'] ? 'Pasien Aktif' : 'Tidak Aktif' }}</td>
                                                    <td>
                                                        <button class="btn btn-secondary" onclick="window.location.href='rekam-medis/{{ $pasien['id_pasien'] }}'">Lihat</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-end">
                                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                                    </ul>
                                </div>
                            </div>




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
    </script>
@endpush

