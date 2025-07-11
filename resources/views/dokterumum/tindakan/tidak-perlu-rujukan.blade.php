@extends('layouts.app')

@section('title', 'Pasien Tidak Perlu Rujukan')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
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
                    <form action="{{ route('perlu-tindakan-update', ['id' => $tindakan['id_catatan']]) }}" method="POST">
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
                                                    <div>= {{ $tindakan['kunjungan']['dokter']['name'] ?? 'Tidak ada dokter' }}</div>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <div style="width: 150px;">SIP</div>
                                                    <div>= {{ $tindakan['kunjungan']['dokter']['dokter_detail']['nomor_sip'] ?? 'Tidak ada data' }} </div>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <div style="width: 150px;">Tanggal Rujukan</div>
                                                    <div>= {{ \Carbon\Carbon::parse($tindakan['kunjungan']['tanggal_kunjungan'])->format('Y-m-d') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex mb-2">
                                                    <div style="width: 180px;">Nomor Rekam Medis</div>
                                                    <div>= {{ $tindakan['kunjungan']['catatan_medis']['no_rekam_medis'] ?? '-' }}</div>
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
                                        
                                        <!-- Diagnosa -->
                                        <div class="mt-4">
                                            <h5 class="font-weight-bold">II. Diagnosa</h5>
                                            <div class="row mt-2">
                                                <div class="col-3">
                                                    <div class="my-auto">Diagnosa Sementara</div>
                                                </div>
                                                <div class="col-9">
                                                    <div class="d-flex align-items-center">
                                                        <span class="mr-2">=</span>
                                                        <input type="text" class="form-control" name="diagnosa_sementara" placeholder="isi diagnosa sementara . . .">
                                                        @error('diagnosa_sementara')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mt-2">
                                                <div class="col-3">
                                                    <div class="my-auto">Diagnosa Tambahan</div>
                                                </div>
                                                <div class="col-9">
                                                    <div class="d-flex align-items-center">
                                                        <span class="mr-2">=</span>
                                                        <input type="text" class="form-control" name="diagnosa_tambahan" placeholder="isi diagnosa tambahan . . .">
                                                        @error('diagnosa_tambahan')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Resep Obat -->
                                        <h5 class="font-weight-bold mt-4">III. Resep Obat</h5>
                                        <input type="hidden" value="{{ $tindakan['kunjungan']['id_kunjungan'] }}" name="id_kunjungan">
                                        <input type="hidden" value="{{ $tindakan['kunjungan']['dokter']['dokter_detail']['id_dokter'] }}" name="id_dokter">
                                        
                                        <!-- Tempat baris-baris dinamis akan ditambahkan -->
                                        <div>
                                            <p for="">Tulis resep untuk apoteker</p>
                                            <textarea class="form-control" name="catatan" id="" rows="5" placeholder="Tulis disini . . ."></textarea>
                                            @error('catatan')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <!-- <div id="obat-instruksi-wrapper">
                                            <div class="row obat-instruksi-group">
                                                <div class="col-md-3">
                                                    <label for="">Pilih Obat</label>
                                                    <select class="form-control select-obat" name="id_obat[]" style="width: 100%"></select>
                                                    @error('id_obat')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Pilih Instruksi</label>
                                                    <select class="form-control select-instruksi" name="id_instruksi[]" style="width: 100%"></select>
                                                    @error('id_instruksi')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
  
                                                <div class="col-md-2">
                                                    <label for="">Dosis</label>
                                                    <select class="form-control" name="dosis[]" style="width: 100%">
                                                        <option value="1">Satu kali</option>
                                                        <option value="2">Dua kali</option>
                                                        <option value="3">Tiga kali</option>
                                                        <option value="4">Empat kali</option>
                                                    </select>
                                                    @error('dosis')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">Berapa Hari</label>
                                                    <select class="form-control" name="frekuensi[]" style="width: 100%">
                                                        <option value="1">Sehari</option>
                                                        <option value="2">Dua Hari</option>
                                                        <option value="3">Tiga Hari</option>
                                                        <option value="4">Empat Hari</option>
                                                    </select>
                                                    @error('frekuensi')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                
                                                <div class="col-md-2">
                                                    <label>&nbsp;</label><br>
                                                    <button type="button" class="btn btn-success add-row">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        Template disembunyikan
                                        <div id="template-obat-instruksi" style="display: none;">
                                            <div class="row obat-instruksi-group mt-3">
                                                <div class="col-md-3">
                                                    <label for="">Pilih Obat</label>
                                                    <select class="form-control plain-obat" name="id_obat[]" style="width: 100%"></select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Pilih Instruksi</label>
                                                    <select class="form-control plain-instruksi" name="id_instruksi[]" style="width: 100%"></select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">Dosis</label>
                                                    <select class="form-control" name="dosis[]" style="width: 100%">
                                                        <option value="1">Satu kali</option>
                                                        <option value="2">Dua kali</option>
                                                        <option value="3">Tiga kali</option>
                                                        <option value="4">Empat kali</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">Berapa Hari</label>
                                                    <select class="form-control" name="frekuensi[]" style="width: 100%">
                                                        <option value="1">Sehari</option>
                                                        <option value="2">Dua Hari</option>
                                                        <option value="3">Tiga Hari</option>
                                                        <option value="4">Empat Hari</option>
                                                    </select>
                                                </div>
        
                                                <div class="col-md-2">
                                                    <label>&nbsp;</label><br>
                                                    <button type="button" class="btn btn-danger remove-row">-</button>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="row">
                                            <div class="d-flex col-6 justify-content-start mt-4">
                                                <a class="btn btn-secondary" href="{{ url('perlu-tindakan/' . $tindakan['id_catatan']) }}">
                                                    <i class=""></i> Kembali
                                                </a>
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
<!-- <script src="{{ asset('') }}plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function initializeSelect2(context) {
        $(context).find('.select-obat').select2({
            placeholder: 'Cari Nama Obat',
            width: '100%',
            ajax: {
                url: '/cari-obat',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $(context).find('.select-instruksi').select2({
            placeholder: 'Cari Instruksi',
            width: '100%',
            ajax: {
                url: '/cari-instruksi',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    }

    $(document).ready(function () {
        // Inisialisasi awal untuk elemen yang sudah ada
        initializeSelect2(document);

        // Event tambah baris
        $('#obat-instruksi-wrapper').on('click', '.add-row', function () {
            let $newRow = $($('#template-obat-instruksi').html());

            // Ganti class sementara dengan class yang akan di-initialize
            $newRow.find('.plain-obat').removeClass('plain-obat').addClass('select-obat');
            $newRow.find('.plain-instruksi').removeClass('plain-instruksi').addClass('select-instruksi');

            $('#obat-instruksi-wrapper').append($newRow);

            // Inisialisasi hanya pada elemen baru
            initializeSelect2($newRow);
        });


        // Event hapus baris
        $('#obat-instruksi-wrapper').on('click', '.remove-row', function () {
            $(this).closest('.obat-instruksi-group').remove();
        });
    });
</script> -->

@endpush



