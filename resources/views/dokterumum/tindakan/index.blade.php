@extends('layouts.app')

@section('content')
    <!-- <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="row">
                        <span class = "fas fa-home"></span>
                        <h4 class="m-0">Tindakan & Pemeriksaan</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
    </div> -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <!-- Ikon User -->
                        <span class="fas fa-stethoscope" style="font-size: 29px;"></span>
                        <!-- Judul -->
                        <h4 class="m-3">Tindakan & Pemeriksaan</h4>
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
                                            <th>#</th>
                                            <th>Nomor Rekam Medis</th>
                                            <th>Nama</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Nomor KTP</th>
                                            <th>Alamat</th>
                                            <th>No. Telp</th>
                                            <th>Tanggal Tindakan</th>
                                            <th>Status</th>
                                        </thead>
                                        @foreach($pasien as $ps)
                                        <tbody>
                                            <tr class="align-middle">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ps['visit']['pasien']['no_rekam_medis'] ?? '-'}}</td>
                                                <td>{{ $ps['visit']['pasien']['nama_lengkap'] ?? '-' }}</td>
                                                <td>{{ $ps['visit']['pasien']['tanggal_lahir'] ?? '-' }}</td>
                                                <td>{{ $ps['visit']['pasien']['jenis_kelamin'] ?? '-' }}</td>
                                                <td>{{ $ps['visit']['pasien']['no_ktp'] ?? '-' }}</td>
                                                <td>{{ $ps['visit']['pasien']['alamat'] ?? '-' }}</td>
                                                <td>{{ $ps['visit']['pasien']['telepon'] }}</td>
                                                <td>{{ \Carbon\Carbon::parse($ps['created_at'])->format('Y-m-d') }}</td>
                                                <td><a href="dokter-umum-perlutindakan"><span class="badge bg-danger">Perlu Tindakan</span></a></td>
                                            </tr>
                                            <!-- Add more rows as needed -->
                                        </tbody>
                                        @endforeach
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

