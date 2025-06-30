@extends('layouts.app')
@section('title', 'Daftar Pembayaran')

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
                <h4 class="m-0">Daftar Pembayaran</h4>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline shadow-sm">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <form id="search-form" method="GET" action="{{ route('pembayaran.index') }}">
                            <div class="input-group mb-3">
                                <input type="text" name="search" id="search-input" value="{{ $search }}" class="form-control" placeholder="Cari pembayaran...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                    @if(request()->has('search') && request()->get('search') !== '')
                                        <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Clear</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="20px">#</th>
                                <th>Nama Pasien</th>
                                
                                <th>Metode Pembayaran</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayaran as $ins)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ins['kunjungan']['pasien']['nama_lengkap'] }}</td>
                                
                                <td>{{ $ins['metode_pembayaran'] }}</td>
                                <td>
                                    <span class="badge bg-{{ $ins['status'] == 'belum_dibayar' ? 'warning' : 'success' }}">
                                        {{ ucwords(str_replace('_', ' ', $ins['status'])) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('pembayaran.show' , ['pembayaran' => $ins['id_pembayaran']]) }}" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pembayaran->appends(['search' => $search])->links() }}
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
            $('#datatable-main-instruksi').DataTable();
        });
    </script>
@endpush
