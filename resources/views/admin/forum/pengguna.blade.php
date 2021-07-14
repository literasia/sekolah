@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Forum | Pengguna')
@section('title-2', 'Pengguna')
@section('title-3', 'Pengguna')

@section('describ')
    Ini adalah halaman pengguna untuk admin
@endsection

@section('icon-l', 'icon-people')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.forum.pengguna') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card glass-card d-flex justify-content-center align-items-center p-2">
                <div class=" col-xl-12 card shadow mb-0 p-0">
                    <div class="card-body">
                        <div class="card-block">
                        <!-- <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button> -->
                            <div class="dt-responsive table-responsive mt-3">
                                <table id="pengguna-table" class="table table-striped table-bordered nowrap shadow-sm">
                                    <thead class="text-left">
                                        <tr>
                                            <th>No.</th>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>Kelas</th>
                                            <th>Total Postingan</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @include('admin.forum.modals._mute')

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
    <style>
        .btn i {
            margin-right: 0px;
        }
        .fileinput .thumbnail {
            display: inline-block;
            margin-bottom: 10px;
            overflow: hidden;
            text-align: center;ry
            vertical-align: middle;
            max-width: 250px;
            box-shadow: 0 10px 30px -12px rgb(0 0 0 / 42%), 0 4px 25px 0 rgb(0 0 0 / 12%), 0 8px 10px -5px rgb(0 0 0 / 20%);
        }
        .thumbnail {
            border: 0 none;
            border-radius: 4px;
            padding: 0;
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
    <script>
        $(document).ready(function () {
            $('#pengguna-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.forum.pengguna') }}",
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'kelas_id',
                        name: 'kelas_id'
                    },
                    {
                        data: 'total_postingan',
                        name: 'total_postingan'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
            });
            

            $('#mute').on('click', function () {
                $('.modal-title').html('Tambah Pengguna');
                $('#action').val('mute');
                $('#btn')
                    .removeClass('btn-info')
                    .addClass('btn-success')
                    .val('Simpan');
                $('#btn-cancel')
                    .removeClass('btn-outline-info')
                    .addClass('btn-outline-success')
                    .text('Batal');
                $('#modal-mute').modal('show');
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: '/admin/forum/pengguna/'+id,
                    dataType: 'JSON',
                    success: function (data) {
                        // console.log(data);
                        $('.modal-title').html('Edit Pengguna');
                        $('#action').val('edit');
                        $('#hidden_id').val(data.id);
                        $('#role_id').val(data.role_id);
                        $('#btn')
                            .removeClass('btn-success')
                            .addClass('btn-info')
                            .val('Update');
                        $('#btn-cancel')
                            .removeClass('btn-outline-success')
                            .addClass('btn-outline-info')
                            .text('Batal');
                        $('#modal-pengguna').modal('show');
                    }
                });
            });

            $('#form-pengguna').on('submit', function (event) {
                event.preventDefault();
                var url = '';
                var text = "Data sukses ditambahkan";
                if ($('#action').val() == 'edit') {
                    url = "{{ route('admin.forum.pengguna.update') }}";
                    text = "Data sukses diupdate";
                }
                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    success: function (data) {
                        if (data.errors) {
                            data.errors.role_id ? $('#role_id').addClass('is-invalid') : $('#role_id').removeClass('is-invalid');
                            toastr.error("data masih kosong");
                        }

                        if (data.success) {
                            Swal.fire("Berhasil", text, "success");
                            $('.form-control').removeClass('is-invalid');
                            $('#form-pengguna')[0].reset();
                            $('#action').val('add');
                            $('#btn')
                                .removeClass('btn-info')
                                .addClass('btn-success')
                                .val('Simpan');
                            $('#btn-cancel')
                                .removeClass('btn-outline-info')
                                .addClass('btn-outline-success')
                                .text('Batal');
                            $('#pengguna-table').DataTable().ajax.reload();
                            $('#modal-pengguna').modal('hide');
                        }
                        $('#form_result').html(html);
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
                url: '/admin/forum/pengguna/hapus/'+ user_id,
                beforeSend: function () {
                    $('#ok_button').text('Menghapus...');
                }, success: function (data) {
                    setTimeout(function () {
                        $('#confirmModal').modal('hide');
                        $('#pengguna-table').DataTable().ajax.reload();
                        Swal.fire("Berhasil", "Data dihapus!", "success");
                    }, 1000);
                }
            });
        });

        });
    </script>
@endpush
