@extends('layouts.app')
@section('title', 'Daftar Instruksi')

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
                <div class="row">
                    <div class="col-md-6">
                        <form id="search-form" method="GET" action="{{ route('instruksi.index') }}">
                            <div class="input-group mb-3">
                                <input type="text" name="search" id="search-input" value="{{ $search }}" class="form-control" placeholder="Cari instruksi...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                    @if(request()->has('search') && request()->get('search') !== '')
                                        <a href="{{ route('instruksi.index') }}" class="btn btn-secondary">Clear</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <div class="card-tools">
                            <a href="{{ route('instruksi.create') }}" class="btn btn-primary"><span class="fas fa-user-plus"></span> Tambah Instruksi</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="20px">#</th>
                                <th>Singkatan</th>
                                <th>Kepanjangan</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($instruksi as $ins)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ins['nama_instruksi'] }}</td>
                                <td>{{ $ins['arti_latin'] }}</td>
                                <td>{{ $ins['keterangan'] }}</td>
                                <td>
                                    <button type="button" class="btn btn-block btn-sm btn-outline-info" data-toggle="dropdown"><i class="fas fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="{{ route('instruksi.edit', $ins['id_instruksi']) }}">Edit</a>
                                        <!-- <a class="dropdown-item" href="#">Hapus</a> -->
                                        <form action="{{ route('instruksi.destroy', $ins['id_instruksi']) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini?')" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item text-danger" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $instruksi->appends(['search' => $search])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
