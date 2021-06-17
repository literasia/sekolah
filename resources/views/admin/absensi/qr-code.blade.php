@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Absensi | Absensi QR Code')
@section('title-2', 'Absensi QR Code')
@section('title-3', 'Absensi QR Code')

@section('describ')
    Ini adalah halaman Absensi QR Code untuk admin
@endsection

@section('icon-l', 'fa fa-clipboard-list')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.absensi.qr-code') }}
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
                                <table id="qr-code-table" class="table table-striped nowrap shadow-sm">
                                    <thead class="text-left">
                                        <tr>
                                            <th>No.</th>
                                            <th>NIP</th>
                                            <th>Nama Lengkap</th>
                                            <th>No. HP</th>
                                            <th>Alamat</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-left">
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>10204285
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @include('admin.absensi.modals._qr-code')
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Konfirmasi</h4>
                </div>
                <div class="modal-body">
                    <h5 align="center" id="confirm">Apakah anda yakin ingin menghapus data ini?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-sm btn-outline-danger">Hapus</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datedropper/css/datedropper.min.css') }}" />
@endpush

{{-- addons js --}}
@push('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#qr-code-table').DataTable();

            $('#add').on('click', function () {
                $('#modal-qr-code').modal('show');
                $('.form-control').val('');
                $('.modal-title').text('Tambah QR Code');
                $('#action').val('add');
                $('#btn').removeClass('btn-info').addClass('btn-success').val('Simpan');
                $('#btn-cancel').removeClass('btn-outline-info').addClass('btn-outline-success').text('Batal');
            });
        });
    </script>
@endpush