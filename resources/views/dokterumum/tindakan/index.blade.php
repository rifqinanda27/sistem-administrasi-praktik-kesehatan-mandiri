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

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Tindakan & Pemeriksaan Mendatang</h3>
                        </div>
                        <div class="card-body">
                            <table id="datatable-main" class="table table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Nomor Rekam Medis</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nomor KTP</th>
                                    <th>Alamat</th>
                                    <th>No. Telp</th>
                                    <th>Tanggal Tindakan</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @foreach($pasien as $ps)
                                        @if($ps['status'] == 'terjadwal')
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ps['visit']['pasien']['no_rekam_medis'] ?? '-'}}</td>
                                            <td>{{ $ps['visit']['pasien']['nama_lengkap'] ?? '-' }}</td>
                                            <td>{{ $ps['visit']['pasien']['tanggal_lahir'] ?? '-' }}</td>
                                            <td>{{ $ps['visit']['pasien']['jenis_kelamin'] ?? '-' }}</td>
                                            <td>{{ $ps['visit']['pasien']['no_ktp'] ?? '-' }}</td>
                                            <td>{{ $ps['visit']['pasien']['alamat'] ?? '-' }}</td>
                                            <td>{{ $ps['visit']['pasien']['telepon'] ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($ps['created_at'])->format('Y-m-d') }}</td>
                                            <td>
                                                @if($ps['status'] == "terjadwal")
                                                <a href="{{ url('perlu-tindakan/' . $ps['id_tindakan']) }}">
                                                    <span class="badge bg-danger">Perlu Tindakan</span>
                                                </a>
                                                @elseif($ps['status'] == "selesai")
                                                <span class="badge bg-success">Diberi Resep</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Tindakan & Pemeriksaan</h3>
                        </div>
                        <div class="card-body">
                            <table id="datatable-main" class="table table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Nomor Rekam Medis</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nomor KTP</th>
                                    <th>Alamat</th>
                                    <th>No. Telp</th>
                                    <th>Tanggal Tindakan</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @foreach($pasien as $ps)
                                        @if($ps['status'] == "selesai")
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ps['visit']['pasien']['no_rekam_medis'] ?? '-'}}</td>
                                            <td>{{ $ps['visit']['pasien']['nama_lengkap'] ?? '-' }}</td>
                                            <td>{{ $ps['visit']['pasien']['tanggal_lahir'] ?? '-' }}</td>
                                            <td>{{ $ps['visit']['pasien']['jenis_kelamin'] ?? '-' }}</td>
                                            <td>{{ $ps['visit']['pasien']['no_ktp'] ?? '-' }}</td>
                                            <td>{{ $ps['visit']['pasien']['alamat'] ?? '-' }}</td>
                                            <td>{{ $ps['visit']['pasien']['telepon'] ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($ps['created_at'])->format('Y-m-d') }}</td>
                                            <td>
                                                @if($ps['status'] == "terjadwal")
                                                <a href="{{ url('perlu-tindakan/' . $ps['id_tindakan']) }}">
                                                    <span class="badge bg-danger">Perlu Tindakan</span>
                                                </a>
                                                @elseif($ps['status'] == "selesai")
                                                <span class="badge bg-success">Diberi Resep</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
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
    </script>
@endpush

