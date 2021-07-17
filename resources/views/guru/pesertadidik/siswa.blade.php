@extends('layouts.guru')

{{-- config 1 --}}
@section('title', 'Peserta Didik | Siswa')
@section('title-2', 'Siswa')
@section('title-3', 'Siswa')

@section('describ')
    Ini adalah halaman siswa untuk guru
@endsection

@section('icon-l', 'icon-people')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('guru.pesertadidik.siswa') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card glass-card d-flex justify-content-center align-items-center p-2">
                <div class=" col-xl-12 card shadow mb-0 p-0">
                    <div class="card-body">
                        <div class="card-block">
                            <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                            <div class="dt-responsive table-responsive mt-3">
                                <table id="siswa-table" class="table table-striped table-bordered border nowrap shadow-sm">
                                    <thead class="text-left">
                                        <tr>
                                            <th>NIS</th>
                                            <th>Nama Lengkap</th>
                                            <th>Kelas</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>Poin</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-left">
                                        @forelse($siswas as $siswa)
                                            <tr>
                                                <td>{{ $siswa->nis }}</td>
                                                <td>{{ $siswa->nama_lengkap }}</td>
                                                <td>
                                                    @if (!empty($siswa->kelas->name))
                                                        {{ $siswa->kelas->name }}</td>
                                                    @endif
                                                <td>{{ $siswa->jk }}</td>
                                                <td>{{ $siswa->alamat_tinggal }}</td>
                                                <td>{{ $siswa->poin_sp}}</td>
                                                <td>
                                                    @if ($siswa->foto)
                                                        <a target="_blank" href="{{ Storage::url($siswa->foto) }}"><label class="badge badge-warning">Lihat</label></a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="8" class="text-center">Tidak ada data</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
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
        .glass-card {
            background: rgba( 255, 255, 255, 0.40 );
            box-shadow: 0 8px 32px 0 rgb(31 38 135 / 22%);
            backdrop-filter: blur( 17.5px );
            -webkit-backdrop-filter: blur( 17.5px );
            border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );
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
    <script>
        $(document).ready(function () {
            $('#siswa-table').DataTable();
        });
    </script>
@endpush