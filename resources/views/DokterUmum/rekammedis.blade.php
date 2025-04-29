@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <!-- Ikon User -->

                        <button onclick="history.back()" style="background: none; border: none; cursor: pointer; font-size: 29px;">
                            <span class="fas fa-chevron-left" style="font-size: 30px;"></span>
                        </button>


                        <!-- Judul -->
                        <h4 class="m-3">Rekam Medis</h4>
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
    
    <!-- Header with back button -->
    <!-- <div class="bg-white border-bottom p-2">
        <a href="#" class="text-dark text-decoration-none">
            <i class="fas fa-chevron-left"></i>
            <span class="h5 mb-0 ms-2">Rekam Medis Pasien</span>
        </a>
    </div> -->

    
    <!-- Patient Identity Section -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Identitas Pasien</h5>
                        </div>
                        <div class="card-body">
                            
                            
                            <!-- Patient Identity Section -->
                            <div class="bg-white border-bottom p-3">
                                <!-- <h6 class="text-dark mb-3">Identitas Pasien</h6> -->
                             
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex mb-2">
                                            <div style="width: 150px;">Nama Pasien</div>
                                            <div>= Januar Rifqi</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div style="width: 150px;">Tanggal Lahir</div>
                                            <div>= 17-08-1945</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div style="width: 150px;">Jenis Kelamin</div>
                                            <div>= Laki-Laki</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div style="width: 150px;">No KTP</div>
                                            <div>= 3374023344563331</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex mb-2">
                                            <div style="width: 180px;">Nomor Rekam Medis</div>
                                            <div>= RM00001</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div style="width: 180px;">Tanggal Pemeriksaan</div>
                                            <div>= 4/12/2025</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div style="width: 180px;">Alamat</div>
                                            <div>= Ngesrep</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div style="width: 180px;">No Telepon</div>
                                            <div>= 098765432123</div>
                                        </div>
                                    </div>
                                </div>
   

                            </div>


                            
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Navigation - tabel -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            
    
    
                            <!-- Tab Navigation - Simple style -->
                            <div class="row g-0 border-bottom">
                                <div class="col-4 p-0">
                                    <button class="btn btn-light w-100 rounded-0 border-0 py-3 active" id="visits-tab">Riwayat Kunjungan</button>
                                </div>
                                <div class="col-4 p-0">
                                    <button class="btn btn-light w-100 rounded-0 border-0 py-3" id="medications-tab">Riwayat Obat</button>
                                </div>
                                <div class="col-4 p-0">
                                    <button class="btn btn-light w-100 rounded-0 border-0 py-3" id="labs-tab">Riwayat Lab</button>
                                </div>
                            </div>
    
                            <!-- Visits History Tab Content -->
                            <div id="visits-content" class="tab-content active">
                                <div class="table-responsive">
                                    <table class="table table-bordered m-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="py-3">Tanggal Kunjungan</th>
                                                <th class="py-3">Jenis Kunjungan</th>
                                                <th class="py-3">Cara Bayar</th>
                                                <th class="py-3">Bidan</th>
                                                <th class="py-3">Dokter</th>
                                                <th class="py-3">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="py-3">04 Desember 2025</td>
                                                <td class="py-3">Kunjungan Sakit</td>
                                                <td class="py-3">BPJS</td>
                                                <td class="py-3">Ilham Indra</td>
                                                <td class="py-3">Januar Rifqi</td>
                                                <td class="py-3 text-center">
                                                    <button class="btn btn-sm btn-outline-secondary px-4">Lihat</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-3">31 Oktober 2024</td>
                                                <td class="py-3">Kontrol</td>
                                                <td class="py-3">Umum</td>
                                                <td class="py-3">Ilham Indra</td>
                                                <td class="py-3">Januar Rifqi</td>
                                                <td class="py-3 text-center">
                                                    <button class="btn btn-sm btn-outline-secondary px-4">Lihat</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-3">24 Oktober 2024</td>
                                                <td class="py-3">Kunjungan Sakit</td>
                                                <td class="py-3">Umum</td>
                                                <td class="py-3">Ilham Indra</td>
                                                <td class="py-3">Januar Rifqi</td>
                                                <td class="py-3 text-center">
                                                    <button class="btn btn-sm btn-outline-secondary px-4">Lihat</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    
                            <!-- Medications History Tab (Initially Hidden) -->
                            <div id="medications-content" class="tab-content d-none">
                                <div class="table-responsive">
                                    <table class="table table-bordered m-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="py-3">Tanggal Pemberian</th>
                                                <th class="py-3">Nama Obat</th>
                                                <th class="py-3">Dosis</th>
                                                <th class="py-3">Frekuensi</th>
                                                <th class="py-3">Lama Pemberian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="py-3">04 Desember 2025</td>
                                                <td class="py-3">
                                                    Paracetamol 500g<br>
                                                    Vitamin C
                                                </td>
                                                <td class="py-3">
                                                    1 Kapsul<br>
                                                    1 Kapsul
                                                </td>
                                                <td class="py-3">
                                                    3x Sehari<br>
                                                    1x Sehari
                                                </td>
                                                <td class="py-3">5 Hari</td>
                                            </tr>
                                            <tr>
                                                <td class="py-3">31 Oktober 2024</td>
                                                <td class="py-3">Amoxicilin 500g</td>
                                                <td class="py-3">1 Kapsul</td>
                                                <td class="py-3">3x Sehari</td>
                                                <td class="py-3">5 Hari</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    
                            <!-- Labs History Tab (Initially Hidden) -->
                            <div id="labs-content" class="tab-content d-none">
                                <div class="table-responsive">
                                    <table class="table table-bordered m-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="py-3">Tanggal Pemeriksaan</th>
                                                <th class="py-3">Jenis Pemeriksaan</th>
                                                <th class="py-3">Tempat Pemeriksaan</th>
                                                <th class="py-3">Hasil Ringkasan</th>
                                                <th class="py-3">Catatan Dokter</th>
                                                <th class="py-3">File Hasil</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="py-3">24 Oktober 2024</td>
                                                <td class="py-3">Urinalisa</td>
                                                <td class="py-3">RS Bhayangkara</td>
                                                <td class="py-3">Normal</td>
                                                <td class="py-3">Tidak Perlu Tindakan Lanjut</td>
                                                <td class="py-3 text-center">
                                                    <button class="btn btn-sm btn-outline-secondary px-4">Lihat</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
    $(document).ready(function() {
        // Simple tab system
        $('#visits-tab').addClass('active');
        $('#visits-content').removeClass('d-none');
        
        $('#visits-tab').click(function() {
            $('.btn').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').addClass('d-none');
            $('#visits-content').removeClass('d-none');
        });
        
        $('#medications-tab').click(function() {
            $('.btn').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').addClass('d-none');
            $('#medications-content').removeClass('d-none');
        });
        
        $('#labs-tab').click(function() {
            $('.btn').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').addClass('d-none');
            $('#labs-content').removeClass('d-none');
        });
    });
</script>
@endpush

