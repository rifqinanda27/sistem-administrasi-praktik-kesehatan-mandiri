@extends('layouts.app')

@section('title', 'Daftar Permintaan Laboratorium')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content')
               
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <!-- Ikon User -->
                        <span class="fas fa-vial mr-1" style="font-size: 29px;"></span>
                        <!-- Judul -->
                        <h4 class="m-3">Laboratorium Pasien</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- Breadcrumb bisa ditambahkan di sini jika diperlukan -->
                    </ol>
                </div>
            </div>
        </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <form id="search-form" method="GET" action="{{ route('lab-pasien.index') }}">
                            <div class="input-group mb-3">
                                <input type="text" name="search" id="search-input" value="{{ $search }}" class="form-control" placeholder="Cari kunjungan...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                    @if(request()->has('search') && request()->get('search') !== '')
                                        <a href="{{ route('lab-pasien.index') }}" class="btn btn-secondary">Clear</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Nomor KTP</th>
                                <th>Alamat</th>
                                <th>No. Telp</th>
                                <th>Status</th>
                                <th>Cetak</th>
                                <th>Unggah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permintaan_lab as $pl)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pl['kunjungan']['pasien']['nama_lengkap'] }}</td>
                                <td>{{ $pl['kunjungan']['pasien']['tanggal_lahir'] }}</td>
                                <td>{{ $pl['kunjungan']['pasien']['jenis_kelamin'] }}</td>
                                <td>{{ $pl['kunjungan']['pasien']['no_ktp'] }}</td>
                                <td>{{ $pl['kunjungan']['pasien']['alamat'] }}</td>
                                <td>{{ $pl['kunjungan']['pasien']['telepon'] }}</td>
                                <td>{{ $pl['status_permintaan'] }}</td>
                                <td><a href="{{ route('cetak-permintaan' , ['id' => $pl['kunjungan']['catatan_medis']['id_catatan']])  }}" target="_blank" ><span class="fas fa-print text-success" style="font-size: 25px;"></span></a></td>
                                <td>-</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $permintaan_lab->appends(['search' => $search])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<!-- DataTables -->
<script src="{{ asset('') }}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
@endpush
