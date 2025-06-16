@extends('layouts.app')
@section('title', 'Tambah Obat')
@push('css')
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">Tambah Obat</h4>
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
                                <a href="{{ route('obat.index') }}" class="btn btn-tool"><i
                                        class="fas fa-arrow-alt-circle-left"></i></a>
                            </div>
                        </div>
                        <form action="{{ route('obat.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Obat</label>
                                    <input type="text" name="nama_obat"
                                        class="form-control @error('nama_obat')is-invalid @enderror" placeholder="Nama Obat">
                                    @error('nama_obat')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Bentuk Obat</label>
                                    <!-- <input type="text" name="bentuk"
                                        class="form-control @error('bentuk')is-invalid @enderror" placeholder="Bentuk Obat"> -->
                                    <select name="bentuk" class="form-control @error('bentuk')is-invalid @enderror">
                                        <option value="" disabled selected>Pilih bentuk obat</option>
                                        @foreach ($bentukOptions as $bentuk)
                                            <option value="{{ $bentuk }}" {{ old('bentuk', $obat->bentuk ?? '') == $bentuk ? 'selected' : '' }}>
                                                {{ ucfirst($bentuk) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('bentuk')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Dosis</label>
                                    <input type="text" name="dosis"
                                        class="form-control @error('dosis')is-invalid @enderror" placeholder="Dosis">
                                    @error('dosis')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Stok</label>
                                    <input type="text" name="jumlah_stok"
                                        class="form-control @error('jumlah_stok')is-invalid @enderror" placeholder="Jumlah Stok">
                                    @error('jumlah_stok')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" name="satuan"
                                        class="form-control @error('satuan')is-invalid @enderror" placeholder="Satuan">
                                    @error('satuan')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Golongan</label>
                                    <input type="text" name="golongan"
                                        class="form-control @error('golongan')is-invalid @enderror" placeholder="Golongan">
                                    @error('golongan')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Indikasi</label>
                                    <input type="text" name="indikasi"
                                        class="form-control @error('indikasi')is-invalid @enderror" placeholder="Indikasi">
                                    @error('indikasi')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Kadaluarsa</label>
                                    <input type="date" name="tanggal_kadaluarsa"
                                        class="form-control @error('tanggal_kadaluarsa')is-invalid @enderror" placeholder="Tanggal Kadaluarsa">
                                    @error('tanggal_kadaluarsa')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Harga Satuan</label>
                                    <input type="text"
                                        class="form-control rupiah-format @error('harga_satuan') is-invalid @enderror"
                                        id="harga_satuan_view"
                                        data-hidden="harga_satuan"
                                        placeholder="Harga Satuan"
                                        value="{{ old('harga_satuan', isset($obat['harga_satuan']) ? 'Rp ' . number_format((float) $obat['harga_satuan'], 0, ',', '.') : '') }}">

                                    <input type="hidden" name="harga_satuan" id="harga_satuan" value="{{ old('harga_satuan', isset($obat['harga_satuan']) ? (int) $obat['harga_satuan'] : '') }}">

                                    @error('harga_satuan')
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
        let raw = input.value.replace(/[^\d]/g, '');
        if (raw) {
            input.value = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(parseInt(raw));
        }

        input.addEventListener('input', function () {
            let raw = this.value.replace(/[^\d]/g, '');
            let numericValue = parseInt(raw || '0');

            this.value = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(numericValue);

            let hiddenInput = document.getElementById(this.dataset.hidden);
            if (hiddenInput) {
                hiddenInput.value = numericValue;
            }
        });
    });
    </script>

@endpush
