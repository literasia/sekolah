@extends('layouts.guru')

@section('title', 'Forum | Balasan')
@section('title-2', 'Balasan')
@section('title-3', 'Balasan')

@section('describ')
    Ini adalah halaman Balasan untuk guru
@endsection

@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('guru.forum.balasan') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card glass-card d-flex justify-content-center align-items-center p-2">
            <div class=" col-xl-12 card shadow mb-0 p-0">
                <div class="card-body">
                    <div class="card-block">
                        <div class="dt-responsive table-responsive mt-3">
                           <table id="reply-table" class="table table-striped table-bordered nowrap shadow-sm">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Balasan</th>
                                        <th>Judul Forum</th>
                                        <th>Penulis</th>
                                        <th>Dibuat Pada (Tanggal)</th>
                                        <th>Dibuat Pada (Jam)</th>
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
    .modal-dialog {
        margin-bottom: 6rem!important;
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
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#reply-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('guru.forum.balasan') }}",
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'komentar',
                        name: 'komentar'
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ],
            });

        $('#dibuat_pada').dateDropper({
            theme: 'leaf',
            format: 'd-m-Y'
        });

        $('#reply-table').DataTable();
        $('#add').on('click', function() {
            $('.modal-title').html('Tambah Balasan');
            $('.form-control').val('');
            $('#action').val('add');
            $('#hidden_id').val('');
            $('#balasan').val('');
            $('#forum_id').val('');
            $('#topik_id').val('');
            $('#penulis_id').val('');
            $('#dibuat_pada_tanggal').val('');
            $('#dibuat_pada_jam').val('');
            $('#status').val('');
            $('#btn')
                .removeClass('btn-info')
                .addClass('btn-success')
                .val('Tambah');
            $('#btn-cancel')
                .removeClass('btn-outline-info')
                .addClass('btn-outline-success')
                .val('Batal');
            $('#modal-reply').modal('show');
        });
    });
</script>
@endpush 