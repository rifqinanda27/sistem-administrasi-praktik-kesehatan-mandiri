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
                                            <tr>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="align-middle">
                                                <td>1</td>
                                                <td>RM00001</td>
                                                <td>Januar Rifqi</td>
                                                <td>17-08-1945</td>
                                                <td>Laki-Laki</td>
                                                <td>3374023344563331</td>
                                                <td>Ngesrep</td>
                                                <td>098765432123</td>
                                                <td>4-12-2025</td>
                                                <td><a href="dokter-umum-perlutindakan"><span class="badge bg-danger">Perlu Tindakan</span></a></td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td>2</td>
                                                <td>RM00002</td>
                                                <td>Ilham Indra</td>
                                                <td>17-08-1945</td>
                                                <td>Laki-Laki</td>
                                                <td>3374023344563331</td>
                                                <td>Ngesrep</td>
                                                <td>098765432123</td>
                                                <td>4-12-2025</td>
                                                <td><a href="dokter-umum-perlutindakan"><span class="badge bg-danger">Perlu Tindakan</span></a></td>
                                                
                                            </tr>
                                            <tr class="align-middle">
                                                <td>3</td>
                                                <td>RM00003</td>
                                                <td>Ammar Luqman</td>
                                                <td>17-08-1945</td>
                                                <td>Laki-Laki</td>
                                                <td>3374023344563331</td>
                                                <td>Ngesrep</td>
                                                <td>098765432123</td>
                                                <td>4-12-2025</td>
                                                <td><span class="badge bg-success">Diberi Resep</span></td>
                                                
                                            </tr>
                                            <tr class="align-middle">
                                                <td>4</td>
                                                <td>RM00004</td>
                                                <td>Challista</td>
                                                <td>17-08-1945</td>
                                                <td>Perempuan</td>
                                                <td>3374023344563331</td>
                                                <td>Ngesrep</td>
                                                <td>098765432123</td>
                                                <td>4-12-2025</td>
                                                <td><span class="badge bg-success">Diberi Resep</span></td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td>5</td>
                                                <td>RM00005</td>
                                                <td>Riskiana</td>
                                                <td>17-08-1945</td>
                                                <td>Perempuan</td>
                                                <td>3374023344563331</td>
                                                <td>Ngesrep</td>
                                                <td>098765432123</td>
                                                <td>4-12-2025</td>
                                                <td><span class="badge bg-success">Diberi Resep</span></td>
                                            </tr>
                                            <!-- Add more rows as needed -->
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

