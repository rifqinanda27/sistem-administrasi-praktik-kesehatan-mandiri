@extends('layouts.app')
@section('title', 'Daftar Obat')
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
                        <h4 class="m-3">Obat</h4>
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
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <form id="search-form" method="GET" action="{{ route('obat.index') }}">
                                        <div class="input-group mb-3">
                                            <input type="text" name="search" id="search-input" value="{{ $search }}" class="form-control" placeholder="Cari obat...">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Cari</button>
                                                @if(request()->has('search') && request()->get('search') !== '')
                                                    <a href="{{ route('obat.index') }}" class="btn btn-secondary">Clear</a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <div class="card-tools">
                                        <a href="{{ route('obat.create') }}" class="btn btn-primary"><span class="fas fa-user-plus"></span> Tambah Obat</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="table-wrapper">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <th style="width: 10px">#</th>
                                            <th style="width: 50px">Nama Obat</th>
                                            <th>Bentuk</th>
                                            <th>Dosis</th>
                                            <th style="width: 200px">Jumlah Stok</th>
                                            <th style="width: 50px">Golongan</th>
                                            <th style="width: 100px">Indikasi</th> <!-- Tambahkan kolom Status -->
                                            <th>Kadaluarsa</th> <!-- Kolom Aksi dengan tombol -->
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach($obat as $key => $ob)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ob['nama_obat'] ?? '-'}}</td>
                                                <td>{{ $ob['bentuk'] ?? '-'}}</td>
                                                <td>{{ $ob['dosis'] ?? '-'}}</td>
                                                <td>{{ $ob['jumlah_stok'] ?? '-'}}</td>
                                                <td>{{ $ob['golongan'] ?? '-'}}</td>
                                                <td>{{ $ob['indikasi'] ?? '-'}}</td>
                                                <td>{{ $ob['tanggal_kadaluarsa'] ?? '-'}}</td>
                                                <td>{{ 'Rp. ' . number_format($ob['harga_satuan'], 2, ',', '.') ?? '-'}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-sm btn-outline-info" data-toggle="dropdown"><i class="fas fa-cog"></i>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item" href="{{ route('obat.edit', $ob['id_obat']) }}">Edit</a>
                                                        <!-- <a class="dropdown-item" href="#">Hapus</a> -->
                                                        <form action="{{ route('obat.destroy', $ob['id_obat']) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini?')" style="display:inline;">
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
                                    {{ $obat->appends(['search' => $search])->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
