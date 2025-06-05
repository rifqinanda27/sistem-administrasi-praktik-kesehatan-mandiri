@extends('layouts.app')
@section('title', 'Daftar Resep Obat')
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
                        <span class="fas fa-user-injured mr-1" style="font-size: 29px;"></span>
                        <!-- Judul -->
                        <h4 class="m-3">Resep</h4>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-main-pasien" class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <th style="width: 10px">#</th>
                                        <th>Nama Pasien</th>
                                        <th>Diresepkan oleh</th>
                                        <th>Tanggal Diresepkan</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @foreach($resep as $key => $ob)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ob['kunjungan']['pasien']['nama_lengkap'] ?? '-'}}</td>
                                            <td>{{ $ob['kunjungan']['dokter']['name'] ?? '-'}}</td>
                                            <td>{{ \Carbon\Carbon::parse($ob['created_at'])->format('d-m-Y') ?? '-'}}</td>
                                            <td>
                                                @if($ob['status'] == 'aktif')
                                                    <a href="{{ route('resep.create' , ['id' => $ob['id_resep']]) }}" class="btn btn-primary">Racik Obat</a>
                                                @else
                                                    <p class="btn btn-success">Telah Diberikan</p>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
@push('js')
    <script>
        $('.toast').toast('show')
        $(document).ready(function() {
            $('#datatable-main-pasien').DataTable();
        });
    </script>
@endpush

