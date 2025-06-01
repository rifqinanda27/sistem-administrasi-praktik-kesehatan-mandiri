@extends('layouts.app')

@section('title', 'Pasien Perlu Rujukan')

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
                            <form action="{{ route('perlu-rujukan-store', ['id' => $tindakan['id_catatan']]) }}" method="POST">
                                @csrf   
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
                                                    <div>= {{ $tindakan['kunjungan']['pasien']['nama_lengkap'] }}</div>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <div style="width: 150px;">Usia/Tanggal Lahir</div>
                                                    <div>= {{ \Carbon\Carbon::parse($tindakan['kunjungan']['pasien']['tanggal_lahir'])->age }}/{{ \Carbon\Carbon::parse($tindakan['kunjungan']['pasien']['tanggal_lahir'])->format('Y-m-d') }}</div>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <div style="width: 150px;">Jenis Kelamin</div>
                                                    <div>= {{ $tindakan['kunjungan']['pasien']['jenis_kelamin'] }}</div>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <div style="width: 150px;">Nama Dokter</div>
                                                    <div>= {{ $tindakan['kunjungan']['dokter']['name'] }}</div>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <div style="width: 150px;">SIP</div>
                                                    <div>= {{ $tindakan['kunjungan']['dokter']['dokter_detail']['nomor_sip'] }}</div>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <div style="width: 150px;">Tanggal Rujukan</div>
                                                    <div>= {{ \Carbon\Carbon::parse($tindakan['kunjungan']['tanggal_kunjungan'])->format('Y-m-d') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex mb-2">
                                                    <div style="width: 180px;">Nomor Rekam Medis</div>
                                                    <div>= {{ $tindakan['no_rekam_medis'] }}</div>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <div style="width: 180px;">Tanggal Pemeriksaan</div>
                                                    <div>= {{ \Carbon\Carbon::parse($tindakan['kunjungan']['tanggal_kunjungan'])->format('Y-m-d') }}</div>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <div style="width: 180px;">Alamat</div>
                                                    <div>= {{ $tindakan['kunjungan']['pasien']['alamat'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Diagnosa Klinis -->
                                        <h5 class="font-weight-bold mt-4">II. Diagnosa Klinis</h5>
                                        
                                        <div class="d-flex mt-2">
                                            <div style="width: 250px;">Keluhan Utama</div>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">=</span>
                                                <span>{{ $tindakan['keluhan_utama'] }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex mt-2">
                                            <div style="width: 250px;">Riwayat Penyakit</div>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">=</span>
                                                <span>{{ $tindakan['riwayat_penyakit_pribadi'] }}</span>
                                            </div>
                                        </div>

                                        <div class="d-flex mt-2">
                                            <div style="width: 250px;">Diagnosa Sementara</div>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">=</span>
                                                <!-- <span>{{ $tindakan['diagnosa_sementara'] }}</span> -->
                                                 <input class="form-control" type="text" placeholder="diagnosa . . ." name="diagnosa_sementara">
                                            </div>
                                        </div>
                                        
                                        <!-- Jenis Pemeriksaan Lanjutan -->
                                        <h5 class="font-weight-bold mt-4">III. Jenis Pemeriksaan Lanjutan</h5>

                                        <input type="hidden" name="diminta_oleh" value="{{ $tindakan['kunjungan']['id_dokter'] }}">
                                        <input type="hidden" name="id_kunjungan" value="{{ $tindakan['id_kunjungan'] }}">
                                        
                                        <div class="mt-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div>Jenis Pemeriksaan</div>
                                                        <select name="id_jenis_pemeriksaan" class="form-control">
                                                            @foreach($jenis_laboratorium as $jl)
                                                            <option value="{{ $jl['id_jenis_pemeriksaan'] }}">{{ $jl['nama_pemeriksaan'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div>Laboratorium</div>
                                                        <select name="id_laboratorium" class="form-control">
                                                            @foreach($laboratorium as $l)
                                                            <option value="{{ $l['id_laboratorium'] }}">{{ $l['nama_laboratorium'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="d-flex col-6 justify-content-start mt-4">
                                                <a class="btn btn-secondary" href="{{ url('perlu-tindakan/' . $tindakan['id_catatan']) }}">
                                                        <i class=""></i> Kembali
                                                    </a>
                                            </div>
                                            <div class="d-flex col-6 justify-content-end mt-4">
                                                <button type="submit" class="btn btn-primary" onclick="window.location.href='dokter-umum-complete'">Lanjut</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
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