@extends('layouts.app')
@section('title', 'Pengaturan Tarif')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">Pengaturan Tarif</h4>
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
                        <div class="card-header">
                        </div>
                        <form action="{{ route('tarif.upsert') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Biaya Admin</label>
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
                                    <label>Biaya Rujukan Lab</label>
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
