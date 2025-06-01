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
                            <div class="card-tools">
                                <a href="{{ route('obat.create') }}" class="btn btn-primary"><span class="fas fa-user-plus"></span> Tambah Obat</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatable-main-pasien" class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <th style="width: 10px">#</th>
                                    <th style="width: 50px">Nama Obat</th>
                                    <th>Bentuk</th>
                                    <th>Dosis</th>
                                    <th style="width: 10px">Jumlah Stok</th>
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

