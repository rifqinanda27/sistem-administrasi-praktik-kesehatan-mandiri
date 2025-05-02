@extends('layouts.app')

@section('content')

<div class="content" style="padding-top: 60px">
        <!-- Navigation Steps -->
    <div class="stepper-wrapper my-4">
            <div class="stepper-item completed">
                <div class="step-counter">1</div>
                <div class="step-name">Pemeriksaan</div>
            </div>
            <div class="stepper-item active">
                <div class="step-counter">2</div>
                <div class="step-name">Tindakan</div>
            </div>
            <div class="stepper-item">
                <div class="step-counter">3</div>
                <div class="step-name">Cetak</div>
            </div>
    </div>
    
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                        <h5 class="font-weight-bold mb-3">Form Resep Obat</h5>
                            <!-- Identitas Pasien -->
                            <div class="card">
                                <div class="card-body">
                                    <!-- Identitas -->
                                    <h5 class="font-weight-bold">I. Identitas</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Nama Pasien</div>
                                                <div>= Januar Rifqi</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Usia/Tanggal Lahir</div>
                                                <div>= 79/17-08-1945</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Jenis Kelamin</div>
                                                <div>= Laki-Laki</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Nama Dokter</div>
                                                <div>= Januar Rifqi</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">SIP</div>
                                                <div>= 123/abc/345/2024</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Tanggal Rujukan</div>
                                                <div>= 4/12/2025</div>
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
                                        </div>
                                    </div>
                                    
                                    <!-- Resep Obat -->
                                    <h5 class="font-weight-bold mt-4">II. Resep Obat</h5>
                                
                                    <div class="mt-3">
                                        <textarea class="form-control" rows="5" placeholder="Masukkan resep obat di sini..."></textarea>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="d-flex col-6 justify-content-start mt-4">
                                            <button class="btn btn-secondary" onclick="window.history.back()">
                                                <i class=""></i> Kembali
                                            </button>
                                        </div>
                                        <div class="d-flex col-6 justify-content-end mt-4">
                                            <button class="btn btn-primary" onclick="window.location.href='dokter-umum-complete'">Lanjut</button>
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
@endsection

@push('js')
    <script>
        $('.toast').toast('show')
    </script>
@endpush


