@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Leaderboard | Leaderboard')
@section('title-2', 'Leaderboard')
@section('title-3', 'Leaderboard')

@section('describ')
    Ini adalah halaman Leaderboard untuk admin
@endsection

@section('icon-l', 'fa fa-trophy')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.leaderboard.leaderboard') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="card-block">
                        <!-- <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button> -->
                        <div class="dt-responsive table-responsive">
                            <table id="leaderboard-table" class="table table-striped table-bordered nowrap shadow-sm">
                                <thead class="text-left">
                                    <tr>
                                        <!-- <th>Nis</th> -->
                                        <th>Nama Lengkap</th>
                                        <th>Kelas</th>
                                        <th>Judul / Topik</th>
                                        <th>Aktivitas</th>
                                        <!-- <th>Balasan</th> -->
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-left">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- addons css --}}
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <link href="{{ asset('assets/pages/jquery.filer/css/jquery.filer.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datedropper/css/datedropper.min.css') }}" />
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/switchery/css/switchery.min.css') }}">-->
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <style>
        .btn i {
            margin-right: 0px;
        }
    </style>
@endpush

{{-- addons javascript --}}
@push('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/pages/file-upload/dropzone-amd-module.min.js') }}"></script>
    <script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
    <!--
    <script src="{{ asset('bower_components/switchery/js/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/pages/advance-elements/swithces.js') }}"></script>
    -->
    <script>
        $(document).ready(function () {
            $('#leaderboard-table').DataTable();

            $('#add').on('click', function(){
                $('#modal-leaderboard').modal('show');
            });
        })
    </script>
@endpush
