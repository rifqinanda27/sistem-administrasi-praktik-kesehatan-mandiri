<div class="card card-primary card-outline">
    <div class="card-header">
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <form method="GET" action="{{ route('tindakan.index') }}">
                    <div class="input-group mb-3">
                        <input type="text" name="search_terjadwal" value="{{ $searchTerjadwal }}" class="form-control" placeholder="Cari pasien terjadwal...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Cari</button>
                            @if($searchTerjadwal)
                                <a href="{{ route('tindakan.index', ['search_selesai' => request('search_selesai'), 'page_selesai' => request('page_selesai')]) }}" class="btn btn-secondary">Clear</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nomor RM</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>No. KTP</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Tanggal Tindakan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($terjadwal as $ps)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ps['catatan_medis']['no_rekam_medis'] ?? '-' }}</td>
                        <td>{{ $ps['pasien']['nama_lengkap'] ?? '-' }}</td>
                        <td>{{ $ps['pasien']['tanggal_lahir'] ?? '-' }}</td>
                        <td>{{ $ps['pasien']['jenis_kelamin'] ?? '-' }}</td>
                        <td>{{ $ps['pasien']['no_ktp'] ?? '-' }}</td>
                        <td>{{ $ps['pasien']['alamat'] ?? '-' }}</td>
                        <td>{{ $ps['pasien']['telepon'] ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($ps['created_at'])->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ url('perlu-tindakan/' . $ps['catatan_medis']['id_catatan']) }}">
                                <span class="badge bg-danger">Perlu Tindakan</span>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="10" class="text-center">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $terjadwal->appends(['search_terjadwal' => $searchTerjadwal, 'page_selesai' => request('page_selesai')])->links() }}
    </div>
</div>
