@extends('layouts.superadmin')

@section('title', 'Dashboard')
@section('title-2', 'Dashboard')
@section('title-3', 'Dashboard')
@section('describ')
    Ini adalah halaman dashboard awal untuk superadmin
@endsection
@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('superadmin.index') }}
@endsection

@section('content')
<div class="row">
    {{-- sale revenue card start --}}
    <div class="col-md-12 col-xl-8">
        <div class="card sale-card">
            <div class="card-header">
                <h5>Grafik</h5>
            </div>
            <div class="card-block">
                <div id="sales-analytics" class="chart-shadow" style="height:380px"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <div class="card comp-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-b-25">Siswa</h6>
                        <h3 class="f-w-700 text-c-blue">{{ rand(10, 10000) }}</h3>
                        <p class="m-b-0">May 23 - June 01 ({{ date('Y') }})</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users bg-c-blue"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card comp-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-b-25">Guru</h6>
                        <h3 class="f-w-700 text-c-green">{{ rand(10, 5000) }}</h3>
                        <p class="m-b-0">May 23 - June 01 ({{ date('Y') }})</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users bg-c-green"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card comp-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-b-25">Orang Tua</h6>
                        <h3 class="f-w-700 text-c-yellow">{{ rand(10, 10000) }}</h3>
                        <p class="m-b-0">May 23 - June 01 ({{ date('Y') }})</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users bg-c-yellow"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Project statustic start --}}
    <div class="col-xl-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5>Pengumuman</h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                        <li><i class="feather icon-maximize full-card"></i></li>
                        <li><i class="icon-minus minimize-card"></i></li>
                        <li><i class="feather icon-refresh-cw reload-card"></i></li>
                        <li><i class="icon-trash close-card"></i></li>
                        <li><i class="feather icon-chevron-left open-card-option"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-block p-b-0">
                <p class="text-muted">
                    Tidak ada pengumuman.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('assets/pages/dashboard/custom-dashboard.min.js') }}"></script>
@endpush