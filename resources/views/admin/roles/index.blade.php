@extends('layouts.app')
@section('title', 'Daftar Roles')
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
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">manajemen role</h4>
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
                            <div class="row">
                                <div class="col-6">
                                    <form id="search-form" method="GET" action="{{ route('roles.index') }}">
                                        <div class="input-group mb-3">
                                            <input type="text" name="search" id="search-input" value="{{ $search }}" class="form-control" placeholder="Cari dokter...">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Cari</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <div class="card-tools">
                                        <a href="{{ route('roles.create') }}" class="btn btn-primary"><span class="fas fa-user-plus"></span> Tambah Role</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <th style="width:10px;">No</th>
                                    <th>Nama Role</th>
                                    <th style="width:80px;">Aksi</th>
                                </thead>
                                <tbody>
                                @foreach ($roles as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-sm btn-outline-info" data-toggle="dropdown"><i class="fas fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="{{ route('roles.edit', $item['id']) }}">Edit</a>
                                            <!-- <a class="dropdown-item" href="#">Hapus</a> -->
                                            <form action="{{ route('roles.destroy', $item['id']) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini?')" style="display:inline;">
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
                            {{ $roles->appends(['search' => $search])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
