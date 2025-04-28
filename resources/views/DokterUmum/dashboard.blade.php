@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="bi bi-house-door"></i> Dashboard</h3>
    </div>

    <div class="mb-4">
        <div class="card shadow-sm">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-person-check fs-1 text-primary me-3"></i>
                <div>
                    <h6 class="mb-0">Pasien Ditangani</h6>
                    <h3 class="mb-0">10</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Statistik Pasien Per Bulan</strong>
            <small>2024</small>
        </div>
        <div class="card-body">
            <canvas id="chartPasien"></canvas>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartPasien').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                {
                    label: 'Poli Umum',
                    data: [70, 85, 95, 60, 80, 20, 10, 90, 70, 80, 90, 60],
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                },
                {
                    label: 'Poli Gigi',
                    data: [30, 45, 25, 40, 50, 20, 5, 30, 60, 70, 80, 50],
                    backgroundColor: 'rgba(255, 99, 132, 0.7)'
                },
                {
                    label: 'Poli Anak',
                    data: [50, 60, 70, 65, 75, 15, 8, 55, 65, 85, 95, 55],
                    backgroundColor: 'rgba(75, 192, 192, 0.7)'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 25
                    }
                }
            }
        }
    });
</script>
@endpush
