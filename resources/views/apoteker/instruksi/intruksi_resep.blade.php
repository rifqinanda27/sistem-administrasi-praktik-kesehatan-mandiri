@extends('layouts.app')

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
                <h4 class="m-0">Instruksi</h4>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold">Aturan Penggunaan</h5>
            </div>
            <div class="card-body">
                <table id="datatable-main-instruksi" class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="20px">#</th>
                            <th>Singkatan</th>
                            <th>Kepanjangan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($instruksi as $ins)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ins['nama_instruksi'] }}</td>
                            <td>{{ $ins['arti_latin'] }}</td>
                            <td>{{ $ins['keterangan'] }}</td>
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
