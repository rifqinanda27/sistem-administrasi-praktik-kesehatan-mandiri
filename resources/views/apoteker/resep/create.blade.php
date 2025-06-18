@extends('layouts.app')
@section('title', 'Racik Obat')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                            <div class="col-8">
                                @if ($errors->has('message'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('message') }}
                                    </div>
                                @endif
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
                                <div class="form-group">
                                    <label for="">Catatan Dokter :</label>
                                    <p>{{ $resep['catatan'] }}</p>
                                </div>
                                <div id="obat-instruksi-wrapper">
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
                                
                                <!-- Template disembunyikan -->
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
                                </div>
                                <!-- <div class="table-responsive">
                                    <table id="datatable-main-pasien" class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <th style="width: 10px">#</th>
                                            <th>Obat</th>
                                            <th>Instruksi</th>
                                            <th>Dosis per hari</th>
                                            <th>Frekuensi Hari</th>
                                        </thead>
                                        <tbody>
                                            @foreach($resep['detail_resep'] as $index => $ob)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ob['obat']['nama_obat'] ?? '-'}}</td>
                                                <td>{{ $ob['instruksi']['keterangan'] ?? '-'}}</td>
                                                <td>{{ $ob['dosis'] ?? '-'}}</td>
                                                <td>{{ $ob['frekuensi'] ?? '-'}}</td>
                                            </tr>
                                            <input type="hidden" name="total[]" value="{{ $ob['dosis'] * $ob['frekuensi'] * $ob['obat']['harga_satuan'] }}">
                                            <input type="hidden" name="detail[{{ $index }}][obat_id]" value="{{ $ob['id_obat'] }}">
                                            <input type="hidden" name="detail[{{ $index }}][dosis]" value="{{ $ob['dosis'] }}">
                                            <input type="hidden" name="detail[{{ $index }}][frekuensi]" value="{{ $ob['frekuensi'] }}">
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> -->
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
</script>
@endpush
