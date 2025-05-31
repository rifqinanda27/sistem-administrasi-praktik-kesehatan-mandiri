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
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <!-- Ikon User -->
                        <span class="fas fa-vial mr-1" style="font-size: 29px;"></span>
                        <!-- Judul -->
                        <h4 class="m-3">Laboratorium Pasien</h4>
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
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Data Pasien</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-main-pasien" class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Nomor KTP</th>
                                <th>Alamat</th>
                                <th>No. Telp</th>
                                <th>Status</th>
                                <th>Cetak</th>
                                <th>Unggah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Budi Santoso</td>
                                <td>01-01-1990</td>
                                <td>Laki-Laki</td>
                                <td>1234567890123456</td>
                                <td>Jl. Mawar No. 1</td>
                                <td>081234567890</td>
                                <td>Pasien Aktif</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm custom-outline-btn" title="Cetak">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" style="height: 30px; font-size: 12px; padding: 3px;">
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Siti Aminah</td>
                                <td>15-05-1985</td>
                                <td>Perempuan</td>
                                <td>9876543210987654</td>
                                <td>Jl. Melati No. 2</td>
                                <td>081298765432</td>
                                <td>Tidak Aktif</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm custom-outline-btn" title="Cetak">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </td>
                                <td>
                                    <input type="file" class="form-control form-control-sm" style="height: 30px; font-size: 12px; padding: 3px;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<!-- DataTables -->
<script src="{{ asset('') }}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#datatable-main-pasien').DataTable();
    });
</script>
@endpush
