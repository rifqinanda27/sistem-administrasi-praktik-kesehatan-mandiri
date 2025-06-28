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
                                    @error('nomor_sip')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>NIP</label>
                                    <input type="text" name="dokter_nip"
                                        class="form-control @error('dokter_nip') is-invalid @enderror" placeholder="NIP dokter"
                                        value="{{ $dokter_edit['dokter_nip'] }}">
                                    @error('dokter_nip')
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
                                    @error('spesialisasi')
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
                                    @error('pengalaman_tahun')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Tarif Konsultasi</label>
                                    <input type="text"
                                        class="form-control rupiah-format @error('tarif_konsultasi') is-invalid @enderror"
                                        id="tarif_konsultasi_view"
                                        data-hidden="tarif_konsultasi"
                                        placeholder="Tarif Konsultasi . . ."
                                        value="{{ 'Rp ' . number_format((float) $dokter_edit['tarif_konsultasi'], 0, ',', '.') }}">

                                    <input type="hidden" name="tarif_konsultasi" id="tarif_konsultasi" value="{{ (int) $dokter_edit['tarif_konsultasi'] }}">

                                    @error('tarif_konsultasi')
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
<script>
document.querySelectorAll('.rupiah-format').forEach(function (input) {
    // Format ulang saat load pertama
    let raw = input.value.replace(/[^\d]/g, '');
    if (raw) {
        let formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(parseInt(raw));
        input.value = formatted;
    }

    // Event input realtime
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
