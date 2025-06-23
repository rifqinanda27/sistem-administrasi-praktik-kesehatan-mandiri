@extends('layouts.app')
@section('title', 'Daftar Pengguna')
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
                    <h4 class="m-0">manajemen pengguna</h4>
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
                                    <form id="search-form" method="GET" action="{{ route('users.index') }}">
                                        <div class="input-group mb-3">
                                            <input type="text" name="search" id="search-input" value="{{ $search }}" class="form-control" placeholder="Cari pengguna ...">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Cari</button>
                                                @if(request()->has('search') && request()->get('search') !== '')
                                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Clear</a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <div class="card-tools">
                                        <a href="{{ route('users.create') }}" class="btn btn-primary"><span class="fas fa-user-plus"></span> Tambah Users</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">                            
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <th>No</th>
                                        <th>Nama Pengguna</th>
                                        <th>Email</th>
                                        <th>Role Pengguna</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['email'] }}</td>
                                            <td>{{ $item['role']['name'] }}</td>
                                            <td>
                                                <button type="button" class="btn btn-block btn-sm btn-outline-info" data-toggle="dropdown"><i class="fas fa-cog"></i>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item" href="{{ route('users.edit', $item['id']) }}">Edit</a>
                                                    <!-- <a class="dropdown-item" href="#">Hapus</a> -->
                                                    <form action="{{ route('users.destroy', $item['id']) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini?')" style="display:inline;">
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
                            </div>
                            {{ $users->appends(['search' => $search])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
