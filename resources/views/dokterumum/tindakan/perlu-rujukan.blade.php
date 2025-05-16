@extends('layouts.app')

@section('content')

<div class="content" style="padding-top: 60px">
    <!-- Navigation Steps 2 -->
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
                            <h5 class="font-weight-bold mb-3">Form Rujukan Pemeriksaan Lanjutan</h5>
                            <!-- Identitas Pasien -->
                            <div class="card">
                                <div class="card-body">
                                    <!-- Identitas -->
                                    <h5 class="font-weight-bold">I. Identitas</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Nama Pasien</div>
                                                <div>= {{ $tindakan['pasien']['nama_lengkap'] }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Usia/Tanggal Lahir</div>
                                                <div>= {{ \Carbon\Carbon::parse($tindakan['pasien']['tanggal_lahir'])->age }}/{{ \Carbon\Carbon::parse($tindakan['pasien']['tanggal_lahir'])->format('Y-m-d') }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Jenis Kelamin</div>
                                                <div>= {{ $tindakan['pasien']['jenis_kelamin'] }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Nama Dokter</div>
                                                <div>= {{ $tindakan['id_dokter'] }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">SIP</div>
                                                <div>= 123/abc/345/2024</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Tanggal Rujukan</div>
                                                <div>= {{ \Carbon\Carbon::parse($tindakan['tanggal_kunjungan'])->format('Y-m-d') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex mb-2">
                                                <div style="width: 180px;">Nomor Rekam Medis</div>
                                                <div>= {{ $tindakan['catatan_medis']['no_rekam_medis'] }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 180px;">Tanggal Pemeriksaan</div>
                                                <div>= {{ \Carbon\Carbon::parse($tindakan['tanggal_kunjungan'])->format('Y-m-d') }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 180px;">Alamat</div>
                                                <div>= {{ $tindakan['pasien']['alamat'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Diagnosa Klinis -->
                                    <h5 class="font-weight-bold mt-4">II. Diagnosa Klinis</h5>
                                    
                                    <div class="d-flex mt-2">
                                        <div style="width: 250px;">Keluhan Utama</div>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">=</span>
                                            <span>{{ $tindakan['catatan_medis']['keluhan_utama'] }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex mt-2">
                                        <div style="width: 250px;">Diagnosa Sementara</div>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">=</span>
                                            <span>{{ $tindakan['catatan_medis']['diagnosa_sementara'] }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex mt-2">
                                        <div style="width: 250px;">Riwayat Penyakit</div>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">=</span>
                                            <span>{{ $tindakan['catatan_medis']['riwayat_penyakit_pribadi'] }}</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Jenis Pemeriksaan Lanjutan -->
                                    <h5 class="font-weight-bold mt-4">III. Jenis Pemeriksaan Lanjutan</h5>
                                    
                                    <div class="mt-2">
                                        <div style="width: 250px;">Pemeriksaan yang Dibutuhkan</div>
                                        
                                        <div class="d-flex flex-wrap mt-3">
                                            <div class="form-check mr-4 mb-2">
                                                <input class="form-check-input" type="checkbox" id="hematologi">
                                                <label class="form-check-label" for="hematologi">
                                                    Hematologi
                                                </label>
                                            </div>
                                            
                                            <div class="form-check mr-4 mb-2">
                                                <input class="form-check-input" type="checkbox" id="kimia_darah">
                                                <label class="form-check-label" for="kimia_darah">
                                                    Kimia Darah
                                                </label>
                                            </div>
                                            
                                            <div class="form-check mr-4 mb-2">
                                                <input class="form-check-input" type="checkbox" id="imunoserology">
                                                <label class="form-check-label" for="imunoserology">
                                                    Imunoserology
                                                </label>
                                            </div>
                                            
                                            <div class="form-check mr-4 mb-2">
                                                <input class="form-check-input" type="checkbox" id="urinalisa">
                                                <label class="form-check-label" for="urinalisa">
                                                    Urinalisa
                                                </label>
                                            </div>
                                            
                                            <div class="form-check mr-4 mb-2">
                                                <input class="form-check-input" type="checkbox" id="lain_lain">
                                                <label class="form-check-label" for="lain_lain">
                                                    Lain-lain
                                                </label>
                                            </div>
                                        </div>
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