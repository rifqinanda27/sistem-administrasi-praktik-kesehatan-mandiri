@extends('layouts.app')
@section('title', 'Pengaturan')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">Pengaturan</h4>
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
                    <div class="card card-outline">
                        <form action="{{ route('pengaturan.upsert') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="">
                                    <div class="font-weight-bold">I. Pengaturan Aplikasi</div>
                                    <div class="form-group">
                                        <p>Nama Aplikasi</p>
                                        <input type="text" class="form-control"
                                            value="{{ $pengaturan['nama_aplikasi'] }}"
                                            placeholder="Masukkan nama . . ."
                                            name="nama_aplikasi">
                                        @error('nama_aplikasi')
                                            <div class="invalid-feedback" role="alert">
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <p>Logo Aplikasi</p>

                                        @if(!empty($pengaturan['logo']))
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/logo/' . $pengaturan['logo']) }}" 
                                                    alt="Logo Aplikasi" 
                                                    style="max-height: 100px;">
                                            </div>
                                        @endif

                                        {{-- Input file untuk ganti logo --}}
                                        <input type="file"
                                            name="logo"
                                            class="form-control @error('logo') is-invalid @enderror"
                                            placeholder="Masukkan logo aplikasi . . .">

                                        @error('logo')
                                            <div class="invalid-feedback" role="alert">
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="">
                                    <div class="font-weight-bold">II. Pengaturan Tarif</div>
                                    <div class="form-group">
                                        <p>Biaya Admin</p>
                                        <input type="text" class="form-control rupiah-format"
                                            id="biaya_admin_view"
                                            value="{{ (int) $tarif['biaya_admin'] }}"
                                            data-hidden="biaya_admin"
                                            placeholder="Masukkan nominal . . .">
                                        <input type="hidden" name="biaya_admin" id="biaya_admin" value="{{ (int) $tarif['biaya_admin'] }}">
                                        @error('biaya_admin')
                                            <div class="invalid-feedback" role="alert">
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <p>Biaya Rujukan Lab</p>
                                        <input type="text"
                                            class="form-control rupiah-format"
                                            id="biaya_rujukan_lab_view"
                                            data-hidden="biaya_rujukan_lab"
                                            placeholder="Masukkan nominal . . ."
                                            value="{{ 'Rp ' . number_format((float) $tarif['biaya_rujukan_lab'], 0, ',', '.') }}">
    
                                        <input type="hidden" name="biaya_rujukan_lab" id="biaya_rujukan_lab" value="{{ (int) $tarif['biaya_rujukan_lab'] }}">
    
                                        @error('biaya_rujukan_lab')
                                            <div class="invalid-feedback" role="alert">
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="">
                                    <div class="font-weight-bold">III. Pengaturan Surat</div>
                                    <div class="form-group">
                                        <p>Alamat</p>
                                        <input type="text" class="form-control"
                                            value="{{ $pengaturan['alamat'] }}"
                                            placeholder="Masukkan nama . . ."
                                            name="alamat">
                                        @error('alamat')
                                            <div class="invalid-feedback" role="alert">
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <p>Kota</p>
                                        <input type="text" class="form-control"
                                            value="{{ $pengaturan['kota'] }}"
                                            placeholder="Masukkan kota . . ."
                                            name="kota">
                                        @error('kota')
                                            <div class="invalid-feedback" role="alert">
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <p>Nomor Telepon</p>
                                        <input type="text" class="form-control"
                                            value="{{ $pengaturan['no_telpon'] }}"
                                            placeholder="Masukkan nama . . ."
                                            name="no_telpon">
                                        @error('no_telpon')
                                            <div class="invalid-feedback" role="alert">
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <p>Email</p>
                                        <input type="email" class="form-control"
                                            value="{{ $pengaturan['email'] }}"
                                            placeholder="Masukkan nama . . ."
                                            name="email">
                                        @error('email')
                                            <div class="invalid-feedback" role="alert">
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <p>Kode Pos</p>
                                        <input type="text" class="form-control"
                                            value="{{ $pengaturan['kode_pos'] }}"
                                            placeholder="Masukkan nama . . ."
                                            name="kode_pos">
                                        @error('kode_pos')
                                            <div class="invalid-feedback" role="alert">
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <p>Kop Surat</p>
                                        <textarea name="kop_surat" rows="6" class="form-control">{{ $pengaturan['kop_surat'] }}</textarea>
                                        @error('kop_surat')
                                            <div class="invalid-feedback" role="alert">
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
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
    <script>
        $(function() {
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
        })
    </script>
    <script>
        document.querySelectorAll('.rupiah-format').forEach(function (input) {
            input.addEventListener('input', function () {
                // Hanya ambil angka, buang titik/koma
                let raw = this.value.replace(/[^\d]/g, '');
                
                // Ubah ke number
                const numericValue = parseInt(raw || '0');

                // Format untuk tampilan
                this.value = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(numericValue);

                // Simpan ke hidden input
                const target = document.getElementById(this.dataset.hidden);
                if (target) {
                    target.value = numericValue;
                }
            });
            // Format saat pertama kali dimuat
            let raw = input.value.replace(/[^\d]/g, '');
            if (raw === '') raw = '0';
            input.value = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(raw);
        });
    </script>
@endpush
