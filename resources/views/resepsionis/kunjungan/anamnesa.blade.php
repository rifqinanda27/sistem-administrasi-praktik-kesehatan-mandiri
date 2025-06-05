@extends('layouts.app')

@section('title', 'Anamnesa Pasien')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">ANAMNESA</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
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
                            <h5 class="card-title m-0"></h5>
                            <div class="card-tools">
                                <a href="{{ route('kunjungan.index') }}" class="btn btn-tool"><i
                                        class="fas fa-arrow-alt-circle-left"></i></a>
                            </div>
                        </div>
                        <form action="{{ route('anamnesa.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <h5 class="font-weight-bold">Form Anamnesa dan Pemeriksaan Utama</h5>
                                <input type="hidden" value="{{ $tindakan['id_kunjungan'] }}" name="id_kunjungan">
                                <input type="hidden" value="{{ now()->toDateString() }}" name="tanggal">
                                <div class="mt-3">
                                    <div class="font-weight-bold">I. Anamnesa</div>
                                    <div class="ml-3 mt-2">
                                        <div class="font-weight-bold">a. Keluhan</div>
                                        
                                        <div class="d-flex mt-2">
                                            <div style="width: 250px;" class="my-auto">Keluhan Utama</div>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">=</span>
                                                <input type="text" class="form-control" name="keluhan_utama">
                                                @error('keluhan_utama')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex mt-2">
                                            <div style="width: 250px;" class="my-auto">Keluhan Tambahan</div>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">=</span>
                                                <input type="text" class="form-control" name="keluhan_tambahan">
                                                @error('keluhan_tambahan')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="ml-3 mt-3">
                                        <div class="font-weight-bold">b. Riwayat Penyakit</div>
                                        
                                        <div class="d-flex mt-2">
                                            <div style="width: 250px;" class="my-auto">Riwayat Penyakit Yang Pernah Atau Sedang Diderita Pasien</div>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">=</span>
                                                <input type="text" class="form-control" name="riwayat_penyakit_pribadi">
                                                @error('riwayat_penyakit_pribadi')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex mt-2">
                                            <div style="width: 250px;" class="my-auto">Riwayat Penyakit Keluarga Pasien</div>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">=</span>
                                                <input type="text" class="form-control" name="riwayat_penyakit_keluarga">
                                                @error('riwayat_penyakit_keluarga')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex mt-2">
                                            <div style="width: 250px;" class="my-auto">Kebiasaan Pasien</div>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">=</span>
                                                <input type="text" class="form-control" name="kebiasaan_pasien">
                                                @error('kebiasaan_pasien')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="mt-4">
                                    <div class="font-weight-bold">II. Pemeriksaan Fisik</div>
                                    <div class="ml-3 mt-2">
                                        <div class="font-weight-bold">a. Pemeriksaan Umum</div>
                                        <div class="d-flex flex-wrap mt-2">
                                            <!-- BB -->
                                            <div class="d-flex mr-4 mb-2">
                                                <div style="width: 120px;" class="my-auto">BB</div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mx-1">=</span>
                                                    <input type="text" class="form-control" name="berat_badan" placeholder="Berat Badan">
                                                    @error('berat_badan')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- TB -->
                                            <div class="d-flex mr-4 mb-2">
                                                <div style="width: 120px;" class="my-auto">TB</div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mx-1">=</span>
                                                    <input type="text" class="form-control" name="tinggi_badan" placeholder="Tinggi Badan">
                                                    @error('tinggi_badan')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- TD -->
                                            <div class="d-flex mr-4 mb-2">
                                                <div style="width: 120px;" class="my-auto">TD</div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mx-1">=</span>
                                                    <input type="text" id="tekananDarah" class="form-control" name="tekanan_darah" placeholder="Tekanan Darah">
                                                    @error('tekanan_darah')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- N -->
                                            <div class="d-flex mr-4 mb-2">
                                                <div style="width: 120px;" class="my-auto">N</div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mx-1">=</span>
                                                    <input type="text" class="form-control" name="neurologi" placeholder="Nadi">
                                                    @error('neurologi')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- RR -->
                                            <div class="d-flex mr-4 mb-2">
                                                <div style="width: 120px;" class="my-auto">RR</div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mx-1">=</span>
                                                    <input type="text" class="form-control" name="frekuensi_nafas" placeholder="frekuensi Nafas">
                                                    @error('frekuensi_nafas')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- S -->
                                            <div class="d-flex mr-4 mb-2">
                                                <div style="width: 120px;" class="my-auto">S</div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mx-1">=</span>
                                                    <input type="text" class="form-control" name="suhu_tubuh" placeholder="Suhu Tubuh">
                                                    @error('suhu_tubuh')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- KU -->
                                            <div class="d-flex mr-4 mb-2">
                                                <div style="width: 120px;" class="my-auto">KU</div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mx-1">=</span>
                                                    <!-- <input type="text" class="form-control" name="keadaan_umum">
                                                    @error('keluhan_utama')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror -->
                                                    <select class="form-control" id="penilaian" name="keadaan_umum">
                                                        <option value="sangat_baik">Sangat Baik</option>
                                                        <option value="baik">Baik</option>
                                                        <option value="cukup">Cukup</option>
                                                        <option value="kurang">Kurang</option>
                                                    </select>
                                                    @error('keadaan_umum')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-block btn-primary"><i class="fa fa-save"></i>
                                    Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('') }}plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#pasien').select2({
            placeholder: 'Cari Nama Pasien',
            ajax: {
                url: '/cari-pasien',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return { term: params.term };
                },
                processResults: function (data) {
                    return {
                        results: data // format: [{ id: ..., text: ... }]
                    };
                },
                cache: true
            }
        });

        $('#dokter').select2({
            placeholder: 'Cari Nama Dokter',
            ajax: {
                url: '/cari-dokter',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return { term: params.term };
                },
                processResults: function (data) {
                    return {
                        results: data // format: [{ id: ..., text: ... }]
                    };
                },
                cache: true
            }
        });


        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('tekananDarah');

            input.addEventListener('input', function (e) {
                let value = input.value.replace(/\D/g, ''); // Hanya angka
                if (value.length > 3) {
                value = value.slice(0, 3) + '/' + value.slice(3, 5);
                }
                input.value = value;
            });
        });


    </script>
@endpush
