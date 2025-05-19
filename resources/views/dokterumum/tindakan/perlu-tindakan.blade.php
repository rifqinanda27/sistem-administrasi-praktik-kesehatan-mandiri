@extends('layouts.app')

@section('content')
    
    <div class="content" style="padding-top: 60px">
        <!-- Navigation Steps 1 -->
        <div class="stepper-wrapper my-4">
            
            <div class="stepper-item active">
                <div class="step-counter">1</div>
                <div class="step-name">Pemeriksaan</div>
            </div>
            <div class="stepper-item">
                <div class="step-counter">2</div>
                <div class="step-name">Tindakan</div>
            </div>
            <div class="stepper-item">
                <div class="step-counter">3</div>
                <div class="step-name">Cetak</div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            
                            <!-- Identitas Pasien -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="font-weight-bold mb-3">Identitas Pasien</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Nama Pasien</div>
                                                <div>= {{ $tindakan['pasien']['nama_lengkap'] }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Tanggal Lahir</div>
                                                <div>= {{ $tindakan['pasien']['tanggal_lahir'] }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Jenis Kelamin</div>
                                                <div>= {{ $tindakan['pasien']['jenis_kelamin'] }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">No KTP</div>
                                                <div>= {{ $tindakan['pasien']['no_ktp'] }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- <div class="d-flex mb-2">
                                                <div style="width: 180px;">Nomor Rekam Medis</div>
                                                <div>= {{ $tindakan['pasien']['no_rekam_medis'] }}</div>
                                            </div> -->
                                            <div class="d-flex mb-2">
                                                <div style="width: 180px;">Tanggal Pemeriksaan</div>
                                                <div>= {{ \Carbon\Carbon::parse($tindakan['tanggal_kunjungan'])->format('Y-m-d') }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 180px;">Alamat</div>
                                                <div>= {{ $tindakan['pasien']['alamat'] }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 180px;">No Telepon</div>
                                                <div>= {{ $tindakan['pasien']['telepon'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Form Anamnesis dan Pemeriksaan -->
                            <form method="POST" action="{{ route('perlu-tindakan-store') }}">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="font-weight-bold">Form Anamnesa dan Pemeriksaan Utama</h5>
                                        <input type="hidden" value="{{ $tindakan['id_kunjungan'] }}" name="id_kunjungan">
                                        <input type="hidden" value="{{ now()->toDateString() }}" name="tanggal">
                                        <input type="hidden" name="buat_rujukan" id="buatRujukan" value="">
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
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex mt-2">
                                                    <div style="width: 250px;" class="my-auto">Keluhan Tambahan</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="mr-2">=</span>
                                                        <input type="text" class="form-control" name="keluhan_tambahan">
                                                        @error('keluhan_utama')
                                                            <div class="invalid-feedback">{{ $message }}</div>
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
                                                        @error('keluhan_utama')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex mt-2">
                                                    <div style="width: 250px;" class="my-auto">Riwayat Penyakit Keluarga Pasien</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="mr-2">=</span>
                                                        <input type="text" class="form-control" name="riwayat_penyakit_keluarga">
                                                        @error('keluhan_utama')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex mt-2">
                                                    <div style="width: 250px;" class="my-auto">Kebiasaan Pasien</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="mr-2">=</span>
                                                        <input type="text" class="form-control" name="kebiasaan_pasien">
                                                        @error('keluhan_utama')
                                                            <div class="invalid-feedback">{{ $message }}</div>
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
                                                            <input type="text" class="form-control" name="berat_badan" placeholder="0">
                                                            @error('keluhan_utama')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <!-- TB -->
                                                    <div class="d-flex mr-4 mb-2">
                                                        <div style="width: 120px;" class="my-auto">TB</div>
                                                        <div class="d-flex align-items-center">
                                                            <span class="mx-1">=</span>
                                                            <input type="text" class="form-control" name="tinggi_badan" placeholder="0">
                                                            @error('keluhan_utama')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <!-- TD -->
                                                    <div class="d-flex mr-4 mb-2">
                                                        <div style="width: 120px;" class="my-auto">TD</div>
                                                        <div class="d-flex align-items-center">
                                                            <span class="mx-1">=</span>
                                                            <input type="text" class="form-control" name="tekanan_darah" placeholder="0/0">
                                                            @error('keluhan_utama')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <!-- N -->
                                                    <div class="d-flex mr-4 mb-2">
                                                        <div style="width: 120px;" class="my-auto">N</div>
                                                        <div class="d-flex align-items-center">
                                                            <span class="mx-1">=</span>
                                                            <input type="text" class="form-control" name="neurologi" placeholder="0">
                                                            @error('keluhan_utama')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <!-- RR -->
                                                    <div class="d-flex mr-4 mb-2">
                                                        <div style="width: 120px;" class="my-auto">RR</div>
                                                        <div class="d-flex align-items-center">
                                                            <span class="mx-1">=</span>
                                                            <input type="text" class="form-control" name="frekuensi_nafas" placeholder="0">
                                                            @error('keluhan_utama')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <!-- S -->
                                                    <div class="d-flex mr-4 mb-2">
                                                        <div style="width: 120px;" class="my-auto">S</div>
                                                        <div class="d-flex align-items-center">
                                                            <span class="mx-1">=</span>
                                                            <input type="text" class="form-control" name="suhu_tubuh" placeholder="0">
                                                            @error('keluhan_utama')
                                                                <div class="invalid-feedback">{{ $message }}</div>
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        
                                        <div class="mt-4">
                                            <div class="font-weight-bold">III. Diagnosa</div>
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
                                        <div class="row">
                                            <div class="d-flex col-6 justify-content-start mt-4">
                                                <button class="btn btn-secondary" onclick="window.history.back()">
                                                    <i class=""></i> Kembali
                                                </button>
                                            </div>
                                            <div class="d-flex col-6 justify-content-end mt-4">
                                                <button type="button" id="btnLanjut" class="btn btn-primary" data-toggle="modal" data-target="#modalRujukan">Lanjut</button>
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

    <!-- Modal Dialog untuk konfirmasi Surat Rujukan -->
    <div class="modal fade" id="modalRujukan" tabindex="-1" role="dialog" aria-labelledby="modalRujukanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <h5 class="font-weight-bold mb-4">Buat Surat Rujukan?</h5>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-light mx-2" style="width: 80px; background-color: #e9ecef;" id="btnYaRujukan">Ya</button>
                        <button type="button" class="btn btn-light mx-2" style="width: 80px; background-color: #e9ecef;" id="btnTidakRujukan">Tidak</button>
                    </div>


                </div>
            </div>
        </div>
    </div>
    
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#btnLanjut').click(function() {
                $('#modalRujukan').modal('show');
            });

            $('#btnYaRujukan').click(function() {
                $('#buatRujukan').val('ya'); // bisa juga true
                $('form').submit();
            });

            $('#btnTidakRujukan').click(function() {
                $('#buatRujukan').val('tidak'); // bisa juga false
                $('form').submit();
            });
        });

    </script>
@endpush

