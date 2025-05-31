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
                                                <div>= {{ $tindakan['kunjungan']['pasien']['nama_lengkap'] }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Tanggal Lahir</div>
                                                <div>= {{ $tindakan['kunjungan']['pasien']['tanggal_lahir'] }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">Jenis Kelamin</div>
                                                <div>= {{ $tindakan['kunjungan']['pasien']['jenis_kelamin'] }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 150px;">No KTP</div>
                                                <div>= {{ $tindakan['kunjungan']['pasien']['no_ktp'] }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- <div class="d-flex mb-2">
                                                <div style="width: 180px;">Nomor Rekam Medis</div>
                                                <div>= {{ $tindakan['kunjungan']['pasien']['no_rekam_medis'] }}</div>
                                            </div> -->
                                            <div class="d-flex mb-2">
                                                <div style="width: 180px;">Tanggal Pemeriksaan</div>
                                                <div>= {{ \Carbon\Carbon::parse($tindakan['kunjungan']['tanggal_kunjungan'])->format('Y-m-d') }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 180px;">Alamat</div>
                                                <div>= {{ $tindakan['kunjungan']['pasien']['alamat'] }}</div>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <div style="width: 180px;">No Telepon</div>
                                                <div>= {{ $tindakan['kunjungan']['pasien']['telepon'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Form Anamnesis dan Pemeriksaan -->
                            <form>
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="font-weight-bold">Form Anamnesa dan Pemeriksaan Utama</h5>

                                    <!-- Anamnesa -->
                                    <div class="mt-3">
                                        <div class="font-weight-bold">I. Anamnesa</div>

                                        <!-- a. Keluhan -->
                                        <div class="ml-3 mt-2">
                                            <div class="font-weight-bold">a. Keluhan</div>

                                            <div class="row mt-2">
                                                <div class="col-md-4">Keluhan Utama</div>
                                                <div class="col-md-8">= {{ $tindakan['keluhan_utama'] }}</div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-4">Keluhan Tambahan</div>
                                                <div class="col-md-8">= {{ $tindakan['keluhan_tambahan'] }}</div>
                                            </div>
                                        </div>

                                        <!-- b. Riwayat Penyakit -->
                                        <div class="ml-3 mt-3">
                                            <div class="font-weight-bold">b. Riwayat Penyakit</div>

                                            <div class="row mt-2">
                                                <div class="col-md-4">Riwayat Penyakit Yang Pernah Atau Sedang Diderita Pasien</div>
                                                <div class="col-md-8">= {{ $tindakan['riwayat_penyakit_pribadi'] }}</div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-4">Riwayat Penyakit Keluarga Pasien</div>
                                                <div class="col-md-8">= {{ $tindakan['riwayat_penyakit_keluarga'] }}</div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-4">Kebiasaan Pasien</div>
                                                <div class="col-md-8">= {{ $tindakan['kebiasaan_pasien'] }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pemeriksaan Fisik -->
                                    <div class="mt-4">
                                        <div class="font-weight-bold">II. Pemeriksaan Fisik</div>

                                        <!-- a. Pemeriksaan Umum -->
                                        <div class="ml-3 mt-2">
                                            <div class="font-weight-bold">a. Pemeriksaan Umum</div>

                                            <div class="row mt-2">
                                                <!-- BB -->
                                                <div class="col-6 col-md-3 mb-2">
                                                    <p>BB = {{ $tindakan['berat_badan'] }}</p>
                                                </div>

                                                <!-- TB -->
                                                <div class="col-6 col-md-3 mb-2">
                                                    <p>TB = {{ $tindakan['tinggi_badan'] }}</p>
                                                </div>

                                                <!-- TD -->
                                                <div class="col-6 col-md-3 mb-2">
                                                    <p>TD = {{ $tindakan['tekanan_darah'] }}</p>
                                                </div>

                                                <!-- N -->
                                                <div class="col-6 col-md-3 mb-2">
                                                    <p>N  = {{ $tindakan['neurologi'] }}</p>
                                                </div>

                                                <!-- RR -->
                                                <div class="col-6 col-md-3 mb-2">
                                                    <p>RR = {{ $tindakan['frekuensi_nafas'] }}</p>
                                                </div>

                                                <!-- S -->
                                                <div class="col-6 col-md-3 mb-2">
                                                    <p>S  = {{ $tindakan['suhu_tubuh'] }}</p>
                                                </div>

                                                <!-- KU -->
                                                <div class="col-6 col-md-3 mb-2">
                                                    <p>KU = {{ $tindakan['keadaan_umum'] }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Tombol Navigasi -->
                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start mt-4">
                                            <a class="btn btn-secondary" href="{{ route('tindakan.index') }}">Kembali</a>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end mt-4">
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
                window.location.href = "{{ route('perlu-rujukan', $tindakan['id_catatan']) }}";
            });

            $('#btnTidakRujukan').click(function() {
                window.location.href = "{{ route('tidak-perlu-rujukan', $tindakan['id_catatan']) }}";
            });
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

