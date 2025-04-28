@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <!-- Ikon User -->
                        <span class="fas fa-user-injured mr-2" style="font-size: 24px;"></span>
                        <!-- Judul -->
                        <h4 class="m-0">Daftar Pasien</h4>
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

    
    <div class="row mb-4">
        <!-- total pasien -->
            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box">
                  <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-gear-fill"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Pasien</span>
                    <span class="info-box-number">
                      10
                      <small>%</small>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

        <!-- Card Pasien Laki-Laki -->
         <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box">
                  <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-gear-fill"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Pasien Laki-Laki</span>
                    <span class="info-box-number">
                      10
                      <small>%</small>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

        <!-- Card Pasien Perempuan -->
            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box">
                  <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-gear-fill"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Pasien Perempuan</span>
                    <span class="info-box-number">
                      10
                      <small>%</small>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
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
                                                <th style="width: 10px">#</th>
                                                <th>Nomor Rekam Medis</th>
                                                <th>Nama</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Nomor KTP</th>
                                                <th>Alamat</th>
                                                <th>No. Telp</th>
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

