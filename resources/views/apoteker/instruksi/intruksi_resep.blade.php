@extends('layouts.app')

@push('css')
    <!-- DataTables (tidak perlu jika tidak butuh fitur filter/sort) -->
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
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Singkatan</th>
                            <th>Kepanjangan</th>
                            <th>Arti</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>s</td><td>signa</td><td>tandai</td><td>Singkatan untuk aturan pakai terlihat pada bagian signatura atau yang diawali dengan signa</td></tr>
                        <tr><td>a.c.</td><td>ante coenam</td><td>sebelum makan</td><td>-</td></tr>
                        <tr><td>a.c.</td><td>Durante coenam</td><td>pada waktu makan</td><td>-</td></tr>
                        <tr><td>p.c.</td><td>post coenam</td><td>setelah makan</td><td>-</td></tr>
                        <tr><td>a.m.</td><td>ante paradigm</td><td>sebelum sarapan pagi</td><td>-</td></tr>
                        <tr><td>a.h.</td><td>alternis horis</td><td>selang satu jam</td><td>-</td></tr>
                        <tr><td>abs.febr.</td><td>absente febre</td><td>bila tidak demam</td><td>-</td></tr>
                        <tr><td>h.v.</td><td>hora vespertina</td><td>malam hari</td><td>-</td></tr>
                        <tr><td>n.</td><td>nocte</td><td>malam hari</td><td>-</td></tr>
                        <tr><td>h.s.</td><td>hora somni</td><td>waktu tidur</td><td>-</td></tr>
                        <tr><td>h.m.</td><td>hora matutina</td><td>pagi hari</td><td>-</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
