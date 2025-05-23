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
                    <form action="{{ route('resep-obat-dokter') }}" method="POST">
                    @csrf
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                            <h5 class="font-weight-bold mb-3">Form Diagnosa</h5>
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
                                                    <div>= {{ $tindakan['dokter']['name'] ?? 'Tidak ada dokter' }}</div>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <div style="width: 150px;">SIP</div>
                                                    <div>= {{ $tindakan['dokter']['dokter_detail']['nomor_sip'] ?? 'Tidak ada data' }} </div>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <div style="width: 150px;">Tanggal Rujukan</div>
                                                    <div>= {{ \Carbon\Carbon::parse($tindakan['tanggal_kunjungan'])->format('Y-m-d') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex mb-2">
                                                    <div style="width: 180px;">Nomor Rekam Medis</div>
                                                    <div>= {{ $tindakan['catatan_medis']['no_rekam_medis'] ?? '-' }}</div>
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
                                        
                                        <!-- Diagnosa -->
                                        <div class="mt-4">
                                            <h5 class="font-weight-bold">II. Diagnosa</h5>
                                            <div class="ml-3 mt-2">
                                                <div class="d-flex mt-2">
                                                    <div style="width: 250px;" class="my-auto">Diagnosa Sementara</div>
                                                    <div class="d-flex align-items-center">
                                                        <input type="text" class="form-control bg-light" name="diagnosa_sementara">
                                                        @error('keluhan_utama')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex mt-2">
                                                    <div style="width: 250px;" class="my-auto">Diagnosa Tambahan</div>
                                                    <div class="d-flex align-items-center">
                                                        <input type="text" class="form-control bg-light" name="diagnosa_tambahan">
                                                        @error('keluhan_utama')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Resep Obat -->
                                        <h5 class="font-weight-bold mt-4">III. Resep Obat</h5>
                                        <input type="hidden" value="{{ $tindakan['id_kunjungan'] }}" name="id_kunjungan">
                                        <input type="hidden" value="{{ $tindakan['id_dokter'] }}" name="id_dokter">
                                        <div class="mt-3">
                                            <textarea class="form-control" rows="5" placeholder="Masukkan resep obat di sini..." name="resep_obat"></textarea>
                                        </div>
                                        <!-- <div class="mt-3">
                                            <label>Pilih Obat</label>
                                            <select id="pasien" name="id_pasien" class="form-control"></select>
                                        </div> -->
                                        <div class="row">
                                            <div class="d-flex col-6 justify-content-start mt-4">
                                                <button class="btn btn-secondary" onclick="window.history.back()">
                                                    <i class=""></i> Kembali
                                                </button>
                                            </div>
                                            <div class="d-flex col-6 justify-content-end mt-4">
                                                <button type="submit" class="btn btn-primary">Lanjut</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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


