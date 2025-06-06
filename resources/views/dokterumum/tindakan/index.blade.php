@extends('layouts.app')

@section('title', 'Daftar Tindakan')

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
                        <span class="fas fa-stethoscope" style="font-size: 29px;"></span>
                        <!-- Judul -->
                        <h4 class="m-3">Tindakan & Pemeriksaan</h4>
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
                @include('dokterumum.tindakan.partials.terjadwal', ['terjadwal' => $terjadwal])
                @include('dokterumum.tindakan.partials.selesai', ['selesai' => $selesai])
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('.toast').toast('show')
        $(document).ready(function() {
            $('#datatable-main-upcoming').DataTable();
            $('#datatable-main-history').DataTable();
        });
    </script>
@endpush

