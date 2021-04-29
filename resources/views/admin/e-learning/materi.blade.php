@extends('layouts.admin')

@section('title', 'E-Learning | Materi')
@section('title-2', 'Materi')
@section('title-3', 'Materi')

@section('describ')
    Ini adalah halaman Materi untuk admin
@endsection

@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('admin.e-learning.materi') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-block">
                    <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                    <div class="dt-responsive table-responsive">
                        <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Nama Guru</th>
                                    <th>Materi</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mengidentifikasi Isi Pokok Cerita Hikayat dengan Bahasa Sendiri</td>
                                    <td>Bahasa Indonesia</td>
                                    <td>VII</td>
                                    <td>Mursilah</td>
                                    <td></td>
                                    <td><small>Telah Terbit, 2021/04/28 pukul 05:04 PM</small></td>
                                    <td><label class="badge badge-success">Diterbitkan</label></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Mengidentifikasi Ciri Teks Biografi Berdasarkan Isinya</td>
                                    <td>Bahasa Indonesia</td>
                                    <td>VII</td>
                                    <td>Mursilah</td>
                                    <td></td>
                                    <td><small>Diperbarui, 2021/04/28 pukul 05:04 PM</small></td>
                                    <td><label class="badge badge-warning">Draf</label></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.e-learning.modals._materi')
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

    .rotate{
        -moz-transition: all .2s linear;
        -webkit-transition: all 2s linear;
        transition: all .2s linear;
    }

    .rotate.down{
        -moz-transform:rotate(90deg);
        -webkit-transform:rotate(90deg);
        transform:rotate(90deg);
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
    $('document').ready(function() {
        $('#order-table').DataTable();

        $('#add').on('click', function() {
            // $('.modal-title').html('Tambah Pesan');
            // $('#judul').val('');
            // $('#message').val('');
            // $('#start_date').val('');
            // $('#end_date').val('');
            // $('#action').val('add');
            // $('#button')
            //     .removeClass('btn-outline-success edit')
            //     .addClass('btn-outline-info add')
            //     .html('Simpan');
            $('#modal-materi').modal('show');
        });

        $(".rotate").click(function() {
            $(this).toggleClass("down"); 
        });
    })
</script>
@endpush