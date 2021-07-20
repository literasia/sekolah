@extends('layouts.siswa')

{{-- config 1 --}}
@section('title', 'Pelajaran | Jadwal Pelajaran')
@section('title-2', 'Jadwal Pelajaran')
@section('title-3', 'Jadwal Pelajaran')

@section('describ')
    Ini adalah halaman Jadwal Pelajaran untuk siswa
@endsection

@section('icon-l', 'fa fa-list-alt')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('siswa.pelajaran.jadwal-pelajaran') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row" id="showjpcard">
        <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                @include('siswa.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Senin', 'data' => $data['senin'] ?? []])
              </div>
              <div class="col-md-4">
                @include('siswa.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Selasa', 'data' => $data['selasa'] ?? []])
              </div>
              <div class="col-md-4">
                @include('siswa.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Rabu', 'data' => $data['rabu'] ?? []])
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                @include('siswa.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Kamis', 'data' => $data['kamis'] ?? []])
              </div>
              <div class="col-md-4">
                @include('siswa.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Jumat', 'data' => $data['jumat'] ?? []])
              </div>
              <div class="col-md-4">
                @include('siswa.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Sabtu', 'data' => $data['sabtu'] ?? []])
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
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <style>
        .btn i {
            margin-right: 0px;
        }
    </style>
@endpush

{{-- addons js --}}
@push('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            loadData();
        });
    </script>
@endpush