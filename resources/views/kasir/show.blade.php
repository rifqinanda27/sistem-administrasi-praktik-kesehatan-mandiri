@extends('layouts.app')
@section('title', 'Detail Pembayaran')

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
            <div class="col-sm-6 d-flex align-items-center">
                <span class="fas fa-clipboard-list mr-2" style="font-size: 29px;"></span>
                <h4 class="m-0">Detail Pembayaran</h4>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5 class="m-0 font-weight-bold">Detail</h5>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <table id="datatable-main-instruksi" class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="20px">#</th>
                            <th>Nama Pasien</th>
                            <th>Total Biaya</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayaran as $ins)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ins['kunjungan']['pasien']['nama_lengkap'] }}</td>
                            <td>{{ 'Rp. ' . number_format($ins['total_biaya'], 2, ',', '.') ?? '-'}}</td>
                            <td>{{ $ins['metode_pembayaran'] }}</td>
                            <td>-</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $('.toast').toast('show')
        $(document).ready(function() {
            $('#datatable-main-instruksi').DataTable();
        });
    </script>
@endpush
