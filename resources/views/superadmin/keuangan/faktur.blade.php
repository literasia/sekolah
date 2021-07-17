@extends('layouts.superadmin')

{{-- config 1 --}}
@section('title', 'Keuangan | Faktur')
@section('title-2', 'Faktur Penjualan')
@section('title-3', 'Faktur Penjualan')

@section('describ')
Ini adalah halaman faktur penjualan untuk superadmin
@endsection

@section('icon-l', 'fa fa-book')
@section('icon-r', 'icon-home')

@section('link')
{{ route('superadmin.keuangan.faktur') }}
@endsection

{{-- main content --}}
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-block">
                    <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                    <div class="dt-responsive table-responsive mt-3">
                        <table id="faktur-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead class="text-left">
                                <tr>
                                    <th>Nomor Faktur</th>
                                    <th>NPWP</th>
                                    <th>Nama Sekolah</th>
                                    <th>Jenis Pesanan</th>
                                    <th>Keterangan</th>
                                    <th>Biaya</th>
                                    <th>Total Biaya</th>
                                    <th>Tanggal Faktur</th>
                                    <th>Penerima</th>
                                    <th>NIP Penerima</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-left">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="{{route('superadmin.keuangan.laporan-faktur')}}" class="btn btn-warning btn-mini" target="_blank"><i class="fa fa-print"></i></a>
                                        <button class="btn btn-info btn-mini"><i class="fa fa-pencil-alt"></i></button>
                                        <button class="btn btn-danger btn-mini"><i class="fa fa-trash"></i></button>
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

{{-- Modal --}}
@include('superadmin.keuangan.modals._tambah-faktur')
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

    .select2-container {
        width: 100% !important;
        padding: 0;
    }
</style>
@endpush

{{-- addons js --}}
@push('js')
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script> 
<script>
    $(document).ready(function() {
        $('#faktur-table').DataTable();

        $('#add').on('click', function() {
            $('.modal-title').html('Tambah Faktur');
            $('#btn')
                .removeClass('btn-info')
                .addClass('btn-success')
                .val('Simpan');
            $('#btn-cancel')
                .removeClass('btn-outline-info')
                .addClass('btn-outline-success')
                .val('Batal');
            $('#modal-faktur').modal('show');
        });
    });
</script>
@endpush