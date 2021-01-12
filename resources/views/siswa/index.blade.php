@extends('layouts.siswa')

@section('title', 'Dashboard')
@section('title-2', 'Dashboard')
@section('title-3', 'Dashboard')
@section('describ')
    Ini adalah halaman dashboard awal untuk Siswa
@endsection
@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('admin.index') }}
@endsection

@section('content')
<div class="card text-center" style="overflow: auto; height: 300px;">

        <div class="card-header">
            <h1>Pengumuman</h1>
        </div>

    <div class="card-body text-center">
        <p class="card-text">14 Juni 2021</p>
        <h5 class="card-title">Penerimaan Siswa Baru</h5>
        <p class="card-text">akan di adakan penerimaan siswa baru</p>
        
        <p class="card-text">16 Juni 2021</p>
        <h5 class="card-title">Pendaftaran Siswa Baru</h5>
        <p class="card-text">pendaftaran akan di buka untuk siswa baru</p>
        
        <p class="card-text">18 Juni 2021</p>
        <h5 class="card-title">Masa Orientasi Sekolah</h5>
        <p class="card-text">masa orientasi siswa wajib di hadiri</p>
        
        <p class="card-text">25 Juni 2021</p>
        <h5 class="card-title">Masuk Sekolah</h5>
        <p class="card-text">proses belajar mengajar akan di laksanakan</p>
        
        <p class="card-text">30 Juni 2021</p>
        <h5 class="card-title">Libur Nasional</h5>
        <p class="card-text">libur nasional akan berlangsung</p>
        
    
    </div>
</div>
<!-- <div class="row">
    <div class="row row-cols-1 row-cols-md-3 g-4 ">
        <div class="card comp-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-b-25">Audio Book</h6>
                        <h3 class="f-w-700 text-c-green">{{ rand(10, 100) }}</h3>
                        <p class="m-b-0">May 23 - June 01 ({{ date('Y') }})</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-audio bg-c-green"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card comp-card">
            <div class="card-body">
                <div class="row align-items-right">
                    <div class="col">
                        <h6 class="m-b-25">E-Book</h6>
                        <h3 class="f-w-700 text-c-blue">{{ rand(10, 100) }}</h3>
                        <p class="m-b-0">May 23 - June 01 ({{ date('Y') }})</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book-open bg-c-blue"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card comp-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-b-25">Video Book</h6>
                        <h3 class="f-w-700 text-c-yellow">{{ rand(10, 100) }}</h3>
                        <p class="m-b-0">May 23 - June 01 ({{ date('Y') }})</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-video bg-c-yellow"></i>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="card comp-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-b-25">Leaderboard Rank</h6>
                        <h3 class="f-w-700 text-c-green">{{ rand(10, 100) }}</h3>
                        <p class="m-b-0">May 23 - June 01 ({{ date('Y') }})</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-audio bg-c-green"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    {{-- Project statustic start --}}
    <div class="col-xl-12">
        <div class="card proj-progress-card">
            <div class="card-block">
                <div class="row">
                <div class="col">
                        <h6 class="m-b-25">Audio Book</h6>
                        <h3 class="f-w-700 text-c-green">{{ rand(10, 100) }}</h3>
                        <p class="m-b-0">May 23 - June ({{ date('Y') }})</p>   
                    </div>
                    <div class="col">
                        <h6 class="m-b-25">Video Book</h6>
                        <h3 class="f-w-700 text-c-yellow">{{ rand(10, 100) }}</h3>
                        <p class="m-b-0">May 23 - June ({{ date('Y') }})</p> 
                    </div>
                    <div class="col">
                        <h6 class="m-b-25">E-Book</h6>
                        <h3 class="f-w-700 text-c-blue">{{ rand(10, 100) }}</h3>
                        <p class="m-b-0">May 23 - June ({{ date('Y') }})</p>
                    </div>
                    <div class="col">
                        <h6 class="m-b-25">Leaderboard Rank</h6>
                        <h3 class="f-w-700 text-c-green">{{ rand(10, 100) }}</h3>
                        <p class="m-b-0">May 23 - June ({{ date('Y') }})</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- testimonial and top selling start --}}
    <div class="col-md-12">
        <div class="card table-card">
            <div class="card-header">
                <h5>Leaderboard</h5>
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
                <div class="table-responsive">
                    <table class="table table-hover m-b-0">
                        <thead>
                            <tr>
                                <th width= 15%>Minggu Ini</th>
                                <th width= 15%>Minggu Lalu</th>
                                <th width= 20%>Nama</th>
                                <th>Audio Book</th>
                                <th>Vidio Book</th>
                                <th>E-Book</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ rand(10,1000) }}</td>
                                <td>{{ rand(10,1000) }}</td>
                                <td>SMA N 1 Medan</td>
                                <td>{{ rand(10,1000) }}</td>
                                <td>{{ 60 }}</td>
                                <td>{{ 60 }}</td>
                            </tr>
                            <tr>
                                <td>{{ rand(10,1000) }}</td>
                                <td>{{ rand(10,1000) }}</td>
                                <td>SMA N 1 Brandan Barat</td>
                                <td>{{ rand(10,1000) }}</td>
                                <td>{{ 60 }}</td>
                                <td>{{ 60 }}</td>
                            </tr>
                            <tr>
                                <td>{{ rand(10,1000) }}</td>
                                <td>{{ rand(10,1000) }}</td>
                                <td>SMA N 1 Babalan</td>
                                <td>{{ rand(10,1000) }}</td>
                                <td>{{ 60 }}</td>
                                <td>{{ 60 }}</td>
                            </tr>
                            <tr>
                                <td>{{ rand(10,1000) }}</td>
                                <td>{{ rand(10,1000) }}</td>
                                <td>SMA N 1 Besitang</td>
                                <td>{{ rand(10,1000) }}</td>
                                <td>{{ 20 }}</td>
                                <td>{{ 60 }}</td>
                            </tr>
                            <tr>
                                <td>{{ rand(10,1000) }}</td>
                                <td>{{ rand(10,1000) }}</td>
                                <td>SMK YPT Maju</td>
                                <td>{{ rand(10,1000) }}</td>
                                <td>{{ 30 }}</td>
                                <td>{{ 60 }}</td>
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
    <script type="text/javascript" src="{{ asset('assets/pages/dashboard/custom-dashboard.min.js') }}"></script>
@endpush