@extends('layouts.app')

@section('title', 'Complete')

@section('content')
<div class="content" style="padding-top: 60px">
    <!-- Navigation Steps 2 -->
    <div class="stepper-wrapper my-4">
    <div class="stepper-item completed">
        <div class="step-counter">1</div>
        <div class="step-name">Pemeriksaan</div>
    </div>
    <div class="stepper-item completed">
        <div class="step-counter">2</div>
        <div class="step-name">Tindakan</div>
    </div>
    <div class="stepper-item active">
        <div class="step-counter">3</div>
        <div class="step-name">Cetak</div>
    </div>
    </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center" style="height: 80vh;">
                <div class="col-12">
                    <div class="card card-primary card-outline" style="border: none; box-shadow: none;">
                        <div class="card-body text-center py-5">
                            <div class="success-icon mb-4">
                                <!-- Perbesar ukuran lingkaran dan ubah warnanya -->
                                <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center" style="width: 250px; height: 250px;">
                                    <i class="fas fa-check text-white" style="font-size: 90px;"></i>
                                </div>
                            </div>
                            
                            <h1 class="font-weight-bold mb-4" style="font-size: 50px;">Berhasil!</h1>
                            
                            <div class="mt-4">
                                 <button class="btn btn-secondary" onclick="window.location.href='{{ route('tindakan.index') }}'">Kembali</button>
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
        // Additional JavaScript if needed
    </script>
@endpush
