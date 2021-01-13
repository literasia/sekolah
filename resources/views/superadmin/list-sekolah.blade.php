@extends('layouts.superadmin')

@section('title', 'List Sekolah')
@section('title-2', 'List Sekolah')
@section('title-3', 'List Sekolah')
@section('describ')
    Ini adalah halaman list sekolah untuk superadmin
@endsection
@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('superadmin.list-sekolah') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h5>List Sekolah</h5>
            </div>
            <div class="card-body">
                <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID Sekolah</th>
                                    <th>Nama Sekolah</th>
                                    <th>Jenjang</th>
                                    <th>T. A</th>
                                    <th>Alamat</th>
                                    <th>Actions</th>
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

{{-- Modal --}}
@include('superadmin.modals._tambah-sekolah')
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
            $('#order-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('superadmin.list-sekolah') }}",
                },
                columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'id_sekolah',
                    name: 'id_sekolah'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'jenjang',
                    name: 'jenjang'
                },
                {
                    data: 'tahun_ajaran',
                    name: 'tahun_ajaran'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'action',
                    name: 'action'
                }
                ]
            });

            $('.close').on('click', function () {
                $('#form-sekolah')[0].reset();
                $('#btn').removeClass('btn-outline-info').addClass('btn-outline-success').val('Simpan');
            });

            $('#add').on('click', function () {
                $('#modal-sekolah').modal('show');
                $('.modal-title').text('Tambahin Sekolah nya doong');
                $('#action').val('add');
                $('#btn').removeClass('btn-outline-info').addClass('btn-outline-success').val('Simpan');
            });

            $('#form-sekolah').on('submit', function (event) {
                event.preventDefault();
                var url = '';

                if ($('#action').val() == 'add') {
                    url = "{{ route('superadmin.list-sekolah') }}";
                }
                
                if ($('#action').val() == 'edit') {
                    url = "{{ route('superadmin.referensi.agama-update') }}";
                }

                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            for (var count = 0; count < data.errors.length; count++) {
                                html = data.errors[count];
                            }
                            $('#sekolah').addClass('is-invalid');
                            toastr.error(html);
                        }

                        if (data.success) {
                            toastr.success(data.success);
                            $('#modal-sekolah').modal('hide');
                            $('#id_sekolah').removeClass('is-invalid');
                            $('#name').removeClass('is-invalid');
                            $('#jenjang').removeClass('is-invalid');
                            $('#tahun_ajaran').removeClass('is-invalid');
                            $('#alamat').removeClass('is-invalid');
                            $('#username').removeClass('is-invalid');
                            $('#password').removeClass('is-invalid');
                            $('#form-sekolah')[0].reset();
                            $('#action').val('add');
                            $('#btn')
                                .removeClass('btn-outline-info')
                                .addClass('btn-outline-success')
                                .val('Simpan');
                            $('#order-table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: '/superadmin/referensi/agama/'+id,
                    dataType: 'JSON',
                    success: function (data) {
                        $('#agama').val(data.agama.name);
                        $('#hidden_id').val(data.agama.id);
                        $('#action').val('edit');
                        $('#btn')
                            .removeClass('btn-outline-success')
                            .addClass('btn-outline-info')
                            .val('Update');
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
                    url: '/superadmin/referensi/agama/hapus/'+user_id,
                    beforeSend: function () {
                        $('#ok_button').text('Menghapus...');
                    }, success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            $('#order-table').DataTable().ajax.reload();
                            toastr.success('Data berhasil dihapus');
                        }, 1000);
                    }
                });
            });
        });
    </script>
@endpush