@extends('layouts.app')

@section('title', 'Tambah Kunjungan')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">Tambah Kunjungan</h4>
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
                        <form action="{{ route('kunjungan.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Pilih Pasien</label>
                                    <select id="pasien" name="id_pasien" class="form-control"></select>
                                </div>

                                <div class="form-group">
                                    <label>Pilih Dokter</label>
                                    <select id="dokter" name="id_dokter" class="form-control"></select>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                                    <input type="datetime-local" name="tanggal_kunjungan" id="tanggal_kunjungan" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Tipe Kunjungan</label>
                                    <select name="tipe_kunjungan" class="form-control">
                                        @foreach ($tipe_kunjungan as $option)
                                            <option value="{{ $option }}">{{ ucfirst($option) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Status Kunjungan</label>
                                    <select name="status_kunjungan" class="form-control">
                                        @foreach ($status_kunjungan as $option)
                                            <option value="{{ $option }}">{{ ucfirst($option) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="d-flex col-6 justify-content-start ">
                                        <a class="btn btn-secondary" href="{{ route('kunjungan.index') }}">Kembali</a>
                                    </div>
                                    <div class="d-flex col-6 justify-content-end ">
                                        <button type="submit" class="btn btn-primary">Lanjut</button>
                                    </div>
                                </div>
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
    </script>
@endpush
