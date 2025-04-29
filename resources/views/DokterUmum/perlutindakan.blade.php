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
                            
                            <!-- Form Anamnesis dan Pemeriksaan -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="font-weight-bold">Form Anamnesa dan Pemeriksaan Utama</h5>
                                    
                                    <div class="mt-3">
                                        <div class="font-weight-bold">I. Anamnesa</div>
                                        <div class="ml-3 mt-2">
                                            <div class="font-weight-bold">a. Keluhan</div>
                                            
                                            <div class="d-flex mt-2">
                                                <div style="width: 250px;">Keluhan Utama</div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-2">=</span>
                                                    <input type="text" class="form-control" value="-">
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex mt-2">
                                                <div style="width: 250px;">Keluhan Tambahan</div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-2">=</span>
                                                    <input type="text" class="form-control" value="-">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="ml-3 mt-3">
                                            <div class="font-weight-bold">b. Riwayat Penyakit</div>
                                            
                                            <div class="d-flex mt-2">
                                                <div style="width: 250px;">Riwayat Penyakit Yang Pernah Atau Sedang Diderita Pasien</div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-2">=</span>
                                                    <input type="text" class="form-control" value="-">
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex mt-2">
                                                <div style="width: 250px;">Riwayat Penyakit Keluarga Pasien</div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-2">=</span>
                                                    <input type="text" class="form-control" value="-">
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex mt-2">
                                                <div style="width: 250px;">Kebiasaan Pasien</div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-2">=</span>
                                                    <input type="text" class="form-control" value="-">
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
                                                    <div style="width: 120px;">BB</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="mx-1">=</span>
                                                        <input type="text" class="form-control" value="60">
                                                    </div>
                                                </div>

                                                <!-- TB -->
                                                <div class="d-flex mr-4 mb-2">
                                                    <div style="width: 120px;">TB</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="mx-1">=</span>
                                                        <input type="text" class="form-control" value="175">
                                                    </div>
                                                </div>

                                                <!-- TD -->
                                                <div class="d-flex mr-4 mb-2">
                                                    <div style="width: 120px;">TD</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="mx-1">=</span>
                                                        <input type="text" class="form-control" value="120/80">
                                                    </div>
                                                </div>

                                                <!-- N -->
                                                <div class="d-flex mr-4 mb-2">
                                                    <div style="width: 120px;">N</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="mx-1">=</span>
                                                        <input type="text" class="form-control" value="89">
                                                    </div>
                                                </div>

                                                <!-- RR -->
                                                <div class="d-flex mr-4 mb-2">
                                                    <div style="width: 120px;">RR</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="mx-1">=</span>
                                                        <input type="text" class="form-control" value="19">
                                                    </div>
                                                </div>

                                                <!-- S -->
                                                <div class="d-flex mr-4 mb-2">
                                                    <div style="width: 120px;">S</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="mx-1">=</span>
                                                        <input type="text" class="form-control" value="36.9">
                                                    </div>
                                                </div>

                                                <!-- KU -->
                                                <div class="d-flex mr-4 mb-2">
                                                    <div style="width: 120px;">KU</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="mx-1">=</span>
                                                        <div class="form-group">
                                                            <select class="form-control" id="penilaian" name="penilaian">
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
                                    </div>

                                    
                                    <div class="mt-4">
                                        <div class="font-weight-bold">III. Diagnosa</div>
                                        <div class="ml-3 mt-2">
                                            <div class="d-flex mt-2">
                                                <div style="width: 250px;">Diagnosa Sementara</div>
                                                <div class="d-flex align-items-center">
                                                    <input type="text" class="form-control bg-light" placeholder="">
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex mt-2">
                                                <div style="width: 250px;">Diagnosa Tambahan</div>
                                                <div class="d-flex align-items-center">
                                                    <input type="text" class="form-control bg-light" placeholder="">
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
                                            <button id="btnLanjut" class="btn btn-primary">Lanjut</button>
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

    <!-- Modal Dialog untuk konfirmasi Surat Rujukan -->
    <div class="modal fade" id="modalRujukan" tabindex="-1" role="dialog" aria-labelledby="modalRujukanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <h5 class="font-weight-bold mb-4">Buat Surat Rujukan?</h5>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-light mx-2" style="width: 80px; background-color: #e9ecef;" onclick="window.location.href='dokter-umum-perlurujukan'">Ya</button>
                        <button type="button" class="btn btn-light mx-2" style="width: 80px; background-color: #e9ecef;" onclick="window.location.href='dokter-umum-tidakrujukan'">Tidak</button>
                    </div>


                </div>
            </div>
        </div>
    </div>
    
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Tampilkan toast jika ada
            $('.toast').toast('show');
            
            // Handler untuk tombol Lanjut
            $('#btnLanjut').click(function() {
                // Tampilkan modal rujukan
                $('#modalRujukan').modal('show');
            });
        });
    </script>
@endpush

