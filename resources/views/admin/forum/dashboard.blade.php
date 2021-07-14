@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Forum | Dashboard')
@section('title-2', 'Dashboard')
@section('title-3', 'Dashboard')

@section('describ')
    Ini adalah halaman Dashboard untuk admin
@endsection

@section('icon-l', 'icon-list')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.forum.dashboard') }}
@endsection

{{-- main content --}}
@section('content')
<div class="row">
        <div class="col-xl-12">
            <div class="card glass-card d-flex justify-content-center align-items-center p-2">
                <div class=" col-xl-12 card shadow mb-0 p-0">
                    <div class="card-body">
                        <div class="card-block p-2">
                            <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                            <div class="dt-responsive table-responsive">
                                <table id="dashboard-table" class="table table-striped nowrap shadow-sm">
                                    <thead class="text-left">
                                        <tr>
                                            <th>No.</th>
                                            <th>Judul</th>
                                            <th>Topik</th>
                                            <th>Total Balasan</th>
                                            <th>Penulis</th>
                                            <th>Dibuat Pada</th>
                                            <th>Privasi</th>
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
    </div>
@include('admin.forum.modals._dashboard')
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
<script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#dashboard-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.forum.dashboard') }}",
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'topik_id',
                        name: 'topik_id'
                    },
                    {
                        data: 'total_balasan',
                        name: 'total_balasan'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'privasi',
                        name: 'privasi'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }

                ],
            });
        
        $('#add').on('click', function () {
            $('#form-forum')[0].reset();
            $('.modal-title').html('Tambah Forum');
            $('#action').val('add');
            $('#judul').val('');
            $('#topik_id').val('');
            $('#total_balasan').val('');
            $('#user_id').val('');
            $('#privasi').val('');            
            $('#create_date').val('');
            $('#btn')
                .removeClass('btn-info')
                .addClass('btn-success')
                .val('Simpan');
            $('#btn-cancel')
                .removeClass('btn-outline-info')
                .addClass('btn-outline-success')
                .val('Batal');
            $('#modal-forum').modal('show');
        });

        $('#form-forum').on('submit', function (e) {
            event.preventDefault();

            let url;
            var text = "Data sukses ditambahkan";

            if ($('#action').val() == 'add') {
                url: "{{ route('admin.forum.dashboard.store') }}";
                text = "Data sukses ditambahkan";
            }

            if ($('#action').val() == 'edit') {
                url = "{{ route('admin.forum.dashboard-update') }}";
                text = "Data sukses diupdate";
            }

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
                success: function (data) {
                    var html = '';
                    // rules error message.
                    if (data.error) {
                        data.errors.judul ? $('#judul').addClass('is-invalid') : $('#judul').removeClass('is-invalid');
                        data.errors.topik_id ? $('#topik_id').addClass('is-invalid') : $('#topik_id').removeClass('is-invalid');
                        data.errors.total_balasan ? $('#total_balasan').addClass('is-invalid') : $('#total_balasan').removeClass('is-invalid');
                        data.errors.user_id ? $('#user_id').addClass('is-invalid') : $('#user_id').removeClass('is-invalid');
                        data.errors.privasi ? $('#privasi').addClass('is-invalid') : $('#privasi').removeClass('is-invalid');
                        toastr.error("data masih kosong");
                    }

                    // success error message
                    if (data.success) {
                        Swal.fire("Berhasil", text, "success");
                        $('#modal-forum').modal('hide');
                        $('.form-control').removeClass('is-invalid');
                        $('#form-forum')[0].reset();
                        $('#action').val('add');
                        $('#btn').removeClass('btn-info').addClass('btn-success').text('Simpan');
                        $('#btn-cancel').removeClass('btn-outline-info').addClass('btn-outline-success').text('Batal');
                        $('#dashboard-table').DataTable().ajax.reload();
                    }
                    $('#form_forum').html(html);
                }
            });
        });

        $(document).on('click', '.edit', function () {
            var id = $(this).attr('id');
            $.ajax({
                url: '/admin/forum/dashboard/'+id,
                dataType: 'JSON',
                success: function (data) {
                    $('.modal-title').html('Edit Forum');
                    $('#hidden_id').val(data.id);
                    $('#judul').val(data.judul);
                    $('#topik_id').val(data.topik_id);
                    $('#total_balasan').val(data.total_balasan);
                    $('#user_id').val(data.user_id);
                    $('#privasi').val(data.privasi);
                    $('#status').val(data.status);
                    $('#action').val('edit');
                    
                    $('#btn')
                        .removeClass('btn-success')
                        .addClass('btn-info')
                        .val('Update');
                    $('#btn-cancel')
                        .removeClass('btn-outline-success')
                        .addClass('btn-outline-info')
                        .val('Batal');
                    $('#modal-forum').modal('show');
                }
            });
        });

        var user_id;
        $(document).on('click', '.delete', function () {
            user_id = $(this).attr('id');
            $('#ok_button').text('Hapus');
            $('#confirmModal').modal('show');
        });
        $('#ok_button').click(function () {
            $.ajax({
                url: '/admin/forum/dashboard/hapus/'+ user_id,
                beforeSend: function () {
                    $('#ok_button').text('Menghapus...');
                }, success: function (data) {
                    setTimeout(function () {
                        $('#confirmModal').modal('hide');
                        $('#dashboard-table').DataTable().ajax.reload();
                        Swal.fire("Berhasil", "Data dihapus!", "success");
                    }, 1000);
                }
            });
        });





        $('#create_date').dateDropper({
            theme: 'leaf',
            format: 'd-m-Y'
        });

        $('#dashboard-table').DataTable();
    });
</script>
@endpush
