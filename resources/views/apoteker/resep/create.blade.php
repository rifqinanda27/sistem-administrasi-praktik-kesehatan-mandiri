@extends('layouts.app')
@section('title', 'Racik Obat')
@push('css')
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">Racik Obat</h4>
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
                                <a href="{{ route('resep.index') }}" class="btn btn-tool"><i
                                        class="fas fa-arrow-alt-circle-left"></i></a>
                            </div>
                        </div>
                        <form action="{{ route('resep.store', ['id' => $resep['id_resep']]) }}" method="post">
                            @csrf
                            <input type="hidden" name="id_kunjungan" value="{{ $resep['id_kunjungan'] }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nama Pasien : </label>
                                    <p>{{ $resep['kunjungan']['pasien']['nama_lengkap'] }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Dokter :</label>
                                    <p>{{ $resep['kunjungan']['dokter']['name'] }}</p>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatable-main-pasien" class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <th style="width: 10px">#</th>
                                            <th>Obat</th>
                                            <th>Instruksi</th>
                                            <th>Dosis per hari</th>
                                            <th>Frekuensi Hari</th>
                                        </thead>
                                        <tbody>
                                            @foreach($resep['detail_resep'] as $ob)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ob['obat']['nama_obat'] ?? '-'}}</td>
                                                <td>{{ $ob['instruksi']['keterangan'] ?? '-'}}</td>
                                                <td>{{ $ob['dosis'] ?? '-'}}</td>
                                                <td>{{ $ob['frekuensi'] ?? '-'}}</td>
                                            </tr>
                                            <input type="hidden" name="total[]" value="{{ $ob['dosis'] * $ob['frekuensi'] * $ob['obat']['harga_satuan'] }}">
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-block btn-primary">
                                    Berikan Obat</button>
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
@endpush
