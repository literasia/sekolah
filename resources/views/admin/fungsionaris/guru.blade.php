@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Fungsionaris | Guru')
@section('title-2', 'Guru')
@section('title-3', 'Guru')

@section('describ')
    Ini adalah halaman guru untuk admin
@endsection

@section('icon-l', 'icon-people')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.fungsionaris.guru') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="card-block">
                        <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                        <div class="dt-responsive table-responsive">
                            <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                                <thead class="text-left">
                                    <tr>
                                        <th>NIP</th>
                                        <th>Nama Lengkap</th>
                                        <th>Status Guru</th>
                                        <th>Aktif</th>
                                        <th>Keterangan</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-left">
                                    <tr>
                                        <td>-</td>
                                        <td>Lestari Juwita</td>
                                        <td>Guru Tetap</td>
                                        <td>Aktif</td>
                                        <td>-</td>
                                        <td>
                                            <button type="button" class="btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>
                                            &nbsp;&nbsp;
                                            <button type="button" class="btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>-</td>
                                        <td>Indra Lesmana</td>
                                        <td>Guru Tetap</td>
                                        <td>Aktif</td>
                                        <td>-</td>
                                        <td>
                                            <button type="button" class="btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>
                                            &nbsp;&nbsp;
                                            <button type="button" class="btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>-</td>
                                        <td>Yield Content</td>
                                        <td>Guru Honor</td>
                                        <td>Tidak Aktif</td>
                                        <td>-</td>
                                        <td>
                                            <button type="button" class="btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>
                                            &nbsp;&nbsp;
                                            <button type="button" class="btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @include('admin.fungsionaris.modals._guru')
@endsection

{{-- addons css --}}
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <style>
        .btn i {
            margin-right: 0px;
        }
    </style>
@endpush

{{-- addons js --}}
@push('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#order-table').DataTable();

            $('#add').on('click', function () {
                $('#modal-guru').modal('show');
            });
        });
    </script>
@endpush