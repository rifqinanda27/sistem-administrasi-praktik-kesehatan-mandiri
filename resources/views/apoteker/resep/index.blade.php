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
                            <table id="datatable-main-pasien" class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <th style="width: 10px">#</th>
                                    <th style="width: 50px">Nama Obat</th>
                                    <th>Diresepkan oleh</th>
                                    <th>Instruksi</th>
                                    <th>Keterangan</th>
                                </thead>
                                <tbody>
                                    @foreach($detail_resep as $key => $ob)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ob['obat']['nama_obat'] ?? '-'}}</td>
                                        <td>{{ $ob['dokter']['user']['name'] ?? '-'}}</td>
                                        <td>{{ $ob['instruksi']['nama_instruksi'] ?? '-'}}</td>
                                        <td>{{ $ob['instruksi']['keterangan'] ?? '-'}}</td>
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

    
@endsection
@push('js')
    <script>
        $('.toast').toast('show')
        $(document).ready(function() {
            $('#datatable-main-pasien').DataTable();
        });
    </script>
@endpush

