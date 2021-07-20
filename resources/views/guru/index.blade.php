@extends('layouts.guru')

@section('title', 'Dashboard')
@section('title-2', 'Dashboard')
@section('title-3', 'Dashboard')
@section('describ')
    Ini adalah halaman Dashboard untuk guru
@endsection
@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('guru.index') }}
@endsection

@section('content')
<div class="row match-height">
    <div class="col-md-12 col-xl-8" >
        <div class="card glass-card d-flex justify-content-center align-items-center p-2">
            <div class=" col-xl-12 card sale-card shadow mb-0 p-0">
                <div class="card-header px-4 pt-4 pb-3" >
                    <h3 class="text-left">Pengumuman</h3>
                </div>
                <div class="card-body px-1 pb-4 pt-0">
                    <div class="announcement-card px-3 pb-3 pt-0">
                        <div class="message-panel p-3">
                            <div class="mb-1 d-flex justify-content-between align-items-center">
                                <h5 style="color: #2cb1b1ad; font-weight: 600;">Penerimaan guru Baru</h5>
                                <small class="text-muted" style="color: #8e8e8ec7;font-weight: 600;">14 Juni 2021</small>
                            </div>
                            <p class="mb-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis dolor quis excepturi adipisci voluptas incidunt pariatur repudiandae, provident nisi facere et voluptatibus voluptatem odit reprehenderit quam ipsum vitae deleniti amet!</p>
                        </div>

                        <div class="message-panel p-3">
                            <div class="mb-1 d-flex justify-content-between align-items-center">
                                <h5 style="color: #2cb1b1ad; font-weight: 600;">Masuk Sekolah</h5>
                                <small class="text-muted" style="color: #8e8e8ec7;font-weight: 600;">23 Juni 2021</small>
                            </div>
                            <p class="mb-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis dolor quis excepturi adipisci voluptas incidunt pariatur repudiandae, provident nisi facere et voluptatibus voluptatem odit reprehenderit quam ipsum vitae deleniti amet!</p>
                        </div>

                        <div class="message-panel p-3">
                            <div class="mb-1 d-flex justify-content-between align-items-center">
                                <h5 style="color: #2cb1b1ad; font-weight: 600;">Libur Nasional</h5>
                                <small class="text-muted" style="color: #8e8e8ec7;font-weight: 600;">19 Agustus 2021</small>
                            </div>
                            <p class="mb-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis dolor quis excepturi adipisci voluptas incidunt pariatur repudiandae, provident nisi facere et voluptatibus voluptatem odit reprehenderit quam ipsum vitae deleniti amet!</p>
                        </div>

                        <div class="message-panel p-3">
                            <div class="mb-1 d-flex justify-content-between align-items-center">
                                <h5 style="color: #2cb1b1ad; font-weight: 600;">Ujian Akhir Sekolah</h5>
                                <small class="text-muted" style="color: #8e8e8ec7;font-weight: 600;">20 September 2021</small>
                            </div>
                            <p class="mb-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis dolor quis excepturi adipisci voluptas incidunt pariatur repudiandae, provident nisi facere et voluptatibus voluptatem odit reprehenderit quam ipsum vitae deleniti amet!</p>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-4">
        <div class="card comp-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-b-25">E-Book</h6>
                        <h3 class="f-w-700 text-c-blue">{{ $ebook }}</h3>
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
                        <h6 class="m-b-25">Audio Book</h6>
                        <h3 class="f-w-700 text-c-green">{{ $audiobook }}</h3>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-audio bg-c-green"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card comp-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-b-25">Video Book</h6>
                        <h3 class="f-w-700 text-c-yellow">{{ $videobook }}</h3>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-video bg-c-yellow"></i>
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
                                <th width= 25%>Nama</th>
                                <th width= 15%>E-Book</th>
                                <th width= 15%>Audio Book</th>
                                <th width= 15%>Video Book</th>
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

@push('css')
    <style>
        .match-height>[class*=col]{
            display:flex;flex-flow:column;
        }
        .match-height>[class*=col]>.card{
            flex:1 1 auto;
        }
        .glass-card {
            background: rgba( 255, 255, 255, 0.40 );
            box-shadow: 0 8px 32px 0 rgb(31 38 135 / 22%);
            backdrop-filter: blur( 17.5px );
            -webkit-backdrop-filter: blur( 17.5px );
            border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );
        }
        .announcement-card {
            max-height: 300px;
            overflow: auto;
        }
        .message-panel {
            background-color: #bfd9ff6b;
            border-radius: .8rem;
            margin-bottom: 1.5rem;
            color: #676767;
            box-shadow: 0 8px 17px -5px rgb(31 38 135 / 22%);
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript" src="{{ asset('assets/pages/dashboard/custom-dashboard.min.js') }}"></script>
@endpush
