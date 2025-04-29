@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <!-- Ikon User -->
                        <span class="fas fa-home mr-1" style="font-size: 29px;"></span>
                        <!-- Judul -->
                        <h4 class="m-3">Dashboard</h4>
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

    

    <div class="row mb-4" style="margin-left: 10px;"> <!-- Menambahkan margin kiri pada row -->
        <!-- Total Pasien -->
        <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
                <span class="info-box-icon custom-icon bg-primary-dark">
                    <i class="fas fa-user"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Pasien Ditangani</span>
                    <span class="info-box-number">20</span>
                </div>
            </div>
        </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">

                        <div class="card-body">

                        <!-- tabel -->

                            <div class="card shadow-sm">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <strong>Statistik Pasien Per Bulan</strong>
                                    <small>2024</small>
                                </div>
                                <div class="card-body">
                                    <canvas id="chartPasien"></canvas>
                                </div>
                            </div>


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
