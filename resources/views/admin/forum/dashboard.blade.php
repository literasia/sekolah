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
                        <button id="add" class="btn btn-outline-primary shadow-sm my-3"><i class="fa fa-plus"></i></button>
                            <div class="dt-responsive table-responsive">
                                <table id="dashboard-table" class="table table-striped nowrap shadow-sm">
                                    <thead class="text-left">
                                        <tr>
                                            <th>No.</th>
                                            <th>Forum</th>
                                            <th>Topik</th>
                                            <th>Balasan</th>
                                            <th>Moderator</th>
                                            <th>Penulis</th>
                                            <th>Dibuat pada</th>
                                            <th>Postingan Terakhir</th>
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
    @include('admin.forum.modals._dashboard')
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

          $('#add').on('click', function () {
                $('.modal-title').html('Tambah Forum');
               $('#action').val('add');
              $('#title').val('');
              $('#category').val('');
              $('#content').val('');
              $('#create_date').val('');
              $('#btn')
                  .removeClass('btn-info')
                  .addClass('btn-success')
                  .val('Tambah');
              $('#modal-forum').modal('show');
          });

            $('#create_date').dateDropper({
                theme: 'leaf',
                format: 'd-m-Y'
            });

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
                    data: 'forum',
                    name: 'forum'
                },
                {
                    data: 'topic',
                    name: 'topic'
                },
                {
                    data: 'reply',
                    name: 'reply'
                },
                {
                    data: 'moderator',
                    name: 'moderator'
                },
                {
                    data: 'writer',
                    name: 'writer'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'last_post',
                    name: 'last_post'
                },
                {
                    data: 'action',
                    name: 'action'
                }
                ]
            });

            $('#form-news').on('submit', function (event) {
                event.preventDefault();

                var url = '';
                if ($('#action').val() == 'add') {
                    url = "{{ route('admin.forum.dashboard') }}";
                }

                if ($('#action').val() == 'edit') {
                    url = "{{ route('admin.forum.dashboard-update') }}";
                }

                var formData = new FormData($('#form-news')[0]);

                $('#btn').prop('disabled', true);
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: '/admin/forum/dashboard/'+id,
                    dataType: 'JSON',
                    success: function (data) {
                        $('#action').val('edit');
                        $('#title').val(data.name);
                        $('#category').val(data.category);
                        $('#content').val(data.content);
                        $('#create_date').val(data.create_date);
                        $('#hidden_id').val(data.id);
                        $('#btn')
                            .removeClass('btn-success')
                            .addClass('btn-info')
                            .val('Update');
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
                    url: '/admin/forum/dashboard/hapus/'+user_id,
                    beforeSend: function () {
                        $('#ok_button').text('Menghapus...');
                    }, success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            $('#dashboard-table').DataTable().ajax.reload();
                            // toastr.success('Data berhasil dihapus');
                            Swal.fire('Sukses!', 'Data berhasi dihapus!', 'success');
                        }, 1000);
                    }
                });
            });

        });
    </script>
@endpush