@extends('layouts.app')
@section('title', 'Edit Dokter')
@push('css')
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">Edit Dokter</h4>
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
                                <a href="{{ route('dokter.index') }}" class="btn btn-tool">
                                    <i class="fas fa-arrow-alt-circle-left"></i>
                                </a>
                            </div>
                        </div>

                        <form action="{{ route('dokter.update', $dokter_edit['id_dokter']) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nomor SIP</label>
                                    <input type="text" name="nomor_sip"
                                        class="form-control @error('nomor_sip') is-invalid @enderror" placeholder="Nomor SIP"
                                        value="{{ $dokter_edit['nomor_sip'] }}">
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Spesialisasi</label>
                                    <input type="text" name="spesialisasi"
                                        class="form-control @error('spesialisasi') is-invalid @enderror" placeholder="Spesialisasi"
                                        value="{{ $dokter_edit['spesialisasi'] }}">
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Pengalaman Tahun</label>
                                    <input type="text" name="pengalaman_tahun"
                                        class="form-control @error('pengalaman_tahun') is-invalid @enderror" placeholder="Pengalaman tahun . . ."
                                        value="{{ $dokter_edit['pengalaman_tahun'] }}">
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Tarif Konsultasi</label>
                                    <input type="text" name="tarif_konsultasi"
                                        class="form-control @error('tarif_konsultasi') is-invalid @enderror" placeholder="Tarif Konsultasi . . ."
                                        value="{{ $dokter_edit['tarif_konsultasi'] }}">
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Status Praktik</label>
                                    <select name="status_praktik" class="form-control @error('status_praktik') is-invalid @enderror">
                                        <option value="aktif" {{ $dokter_edit['status_praktik'] === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="tidak_aktif" {{ $dokter_edit['status_praktik'] === 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('status_praktik')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-block btn-primary">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
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
