@extends('layouts.guru')

{{-- config 1 --}}
@section('title', 'E-Voting | Vote')
@section('title-2', 'Vote')
@section('title-3', 'Vote')

@section('describ')
    Ini adalah halaman Hasil Vote untuk guru
@endsection

@section('icon-l', 'fa fa-poll-h')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('guru.e-voting.vote') }}
@endsection

{{-- main content --}}
@section('content')


@foreach($pemilihans as $pemilihan)
    <div class="row container">
        <div class="col-xl-12">
            <div class="card glass-card d-flex justify-content-center align-items-center p-2">
                <div class=" col-xl-12 card shadow mb-0 p-0">
                    <div class="card-header">
                        <h5>Pemilihan {{ $pemilihan->posisi }}</h5>
                    </div>
                    <div class="card-block">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Hasil Voting</h5>
                                        <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                                    </div>
                                    <div class="card-block">
                                        <canvas id="myChart{{ $pemilihan->id }}" width="284" height="284" style="display: block; width: 284px; height: 284px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


@endsection

{{-- addons css --}}
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <style>
        .btn i {
            margin-right: 0px;
        }
        .glass-card {
            background: rgba( 255, 255, 255, 0.40 );
            box-shadow: 0 8px 32px 0 rgb(31 38 135 / 22%);
            backdrop-filter: blur( 17.5px );
            -webkit-backdrop-filter: blur( 17.5px );
            border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );
        }
    </style>
@endpush

{{-- addons js --}}
@push('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/chart.js/js/Chart.js') }}"></script>
    <!-- <script src="{{ asset('bower_components/chart.js/js/chartjs-custom.js') }}"></script> -->
    <script>
        "use strict";
        $(document).ready(function(){
        /*Doughnut chart*/
        @foreach ($names as $nc)
        var ctx{{ $nc->id }} = document.getElementById("myChart{{ $nc->id }}");
        var data{{ $nc->id }} = {
            labels: [
                    @foreach($nc->calons as $calon)
                        "{{ $calon->name }}",
                    @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($counts as $count)
                        {{ $count }},
                    @endforeach
                ],
                backgroundColor: [
                    "#5a308d",
                    "#7d2b8b",
                    "#ca0088",
                    "#cc1b59"
                ],
                borderWidth: [
                    "0px",
                    "0px",
                    "0px",
                    "0px"
                ],
                borderColor: [
                    "#5a308d",
                    "#7d2b8b",
                    "#ca0088",
                    "#cc1b59"

                ]
            }]
        };

        var myDoughnutChart = new Chart(ctx{{$nc->id}}, {
            type: 'doughnut',
            data: data{{$nc->id}}
        });
        @endforeach

    });
    </script>
@endpush