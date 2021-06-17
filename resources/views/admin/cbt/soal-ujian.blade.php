@extends('layouts.admin')

@section('title', 'Computer Based Test | Soal Ujian')
@section('title-2', 'Soal Ujian')
@section('title-3', 'Soal Ujian')

@section('describ')
    Ini adalah halaman Soal Ujian untuk admin
@endsection

@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('admin.cbt.soal-ujian') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card glass-card d-flex justify-content-center align-items-center p-2">
            <div class=" col-xl-12 card shadow mb-0 p-0">
                <div class="card-body">
                    <div class="card-block">
                        <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                        <div class="dt-responsive table-responsive mt-3">
                           <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Judul Ujian</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Nama Guru</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.cbt.modals._tambah-soal-ujian')
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
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-clockpicker.min.css') }}" />
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
    .modal-dialog {
        margin-bottom: 6rem!important;
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
<script src="{{ asset('js/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
<script type="text/javascript">
    $('document').ready(function() {
        $('#order-table').DataTable();

        $('#add').on('click', function() {
            $('.modal-title').html('Tambah Soal Ujian');
            $('.form-control').val('');
            $('#action').val('add');
            $('#hidden_id').val('');
            $('#judul_ujian').val('');
            $('#guru_id').val('');
            $('#mata_pelajaran_id').val('');
            $('#kelas_id').val('');
            $('#jumlah_soal').val('');
            $('#status').val('');
            $('#btn')
                .removeClass('btn-info')
                .addClass('btn-success')
                .val('Simpan');
            $('#btn-cancel')
                .removeClass('btn-outline-info')
                .addClass('btn-outline-success')
                .val('Batal');
            $('#modal-soal').modal('show');
        });
    });
</script>
@endpush