@extends('layouts.superadmin')

{{-- config 1 --}}
@section('title', 'Berita')
@section('title-2', 'Berita')
@section('title-3', 'Berita')

@section('describ')
    Ini adalah halaman Berita untuk Superadmin
@endsection

@section('icon-l', 'fa fa-newspaper')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('superadmin.berita.berita') }}
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
                            <table id="berita-table" class="table table-striped table-bordered nowrap shadow-sm">
                                <thead class="text-left">
                                    <tr>
                                        <th>No.</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Isi Berita</th>
                                        <th>Thumbnail</th>
                                        <th>Tanggal Rilis</th>
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
    @include('superadmin.berita.modals._berita')
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
       /* .truncate {
            width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }*/
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
            $('#add').on('click', function () {
                $('.modal-title').html('Tambah Berita');
                $('#action').val('add');
                $('#judul').val('');
                $('#kategori').val('');
                $('#tanggal_rilis').val('');
                $('#isi').val('');
                $('#btn')
                    .removeClass('btn-info')
                    .addClass('btn-success')
                    .val('Simpan');
                $('#btn-cancel')
                    .removeClass('btn-outline-info')
                    .addClass('btn-outline-success')
                    .val('Batal');
                $('#modal-berita').modal('show');
            });

            $('#tanggal_rilis').dateDropper({
                theme: 'leaf',
                format: 'd-m-Y'
            });

            // $('td:nth-child(5)').addClass('truncate');

            $('#berita-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('superadmin.berita.berita') }}",
                },
                columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'kategori',
                    name: 'kategori'
                },
                {
                    data: 'isi',
                    name: 'isi'
                },
                {
                    data: 'thumbnail',
                    name: 'thumbnail'
                },
                {
                    data: 'tanggal_rilis',
                    name: 'tanggal_rilis'
                },
                {
                    data: 'action',
                    name: 'action'
                }
                ]
            });

            $('#form-berita').on('submit', function (e) {
                event.preventDefault();

                var text = "Data sukses ditambahkan";
                let url = '';
                if ($('#action').val() == 'add') {
                    url = "{{ route('superadmin.berita.berita.store') }}";
                    text = "Data sukses ditambahkan";
                }

                if ($('#action').val() == 'edit') {
                    url = "{{ route('superadmin.berita.berita.update') }}";
                    text = "Data sukses diupdate";
                }

                var formData = new FormData($('#form-berita')[0]);

                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'JSON',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        let html = ''

                        // rules error message
                        if (data.error) {
                            data.errors.judul ? $('#judul').addClass('is-invalid') : $('#judul').removeClass('is-invalid');
                            data.errors.kategori ? $('#kategori').addClass('is-invalid') : $('#kategori').removeClass('is-invalid');
                            data.errors.tanggal_rilis ? $('#tanggal_rilis').addClass('is-invalid') : $('#tanggal_rilis').removeClass('is-invalid');
                            data.errors.isi ? $('#isi').addClass('is-invalid') : $('#isi').removeClass('is-invalid');
                            data.errors.thumbnail ? $('#thumbnail').addClass('is-invalid') : $('#thumbnail').removeClass('is-invalid');
                            toastr.error("data masih kosong");
                        }

                        // Succes
                        if (data.success) {
                            Swal.fire("Berhasil", text, "success");
                            $('#modal-berita').modal('hide');
                            $('#judul').removeClass('is-invalid');
                            $('#form-berita')[0].reset();
                            $('#action').val('add');
                            $('#btn')
                                .removeClass('btn-info')
                                .addClass('btn-success')
                                .val('Simpan');
                            $('#btn-cancel')
                                .removeClass('btn-outline-info')
                                .addClass('btn-outline-success')
                                .val('Batal');
                            $('#berita-table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: '/superadmin/berita/berita/'+id,
                    dataType: 'JSON',
                    success: function (data) {
                        $('#action').val('edit');
                        $('.modal-title').html('Edit Berita');
                        $('#judul').val(data.judul);
                        $('#kategori').val(data.kategori);
                        $('#isi').val(data.isi);
                        $('#tanggal_rilis').val(data.tanggal_rilis);
                        $('#btn')
                            .removeClass('btn-success')
                            .addClass('btn-info')
                            .val('Update');
                        $('#btn-cancel')
                            .removeClass('btn-outline-success')
                            .addClass('btn-outline-info')
                            .val('Batal');
                        $('#hidden_id').val(data.id);
                        $('#modal-berita').modal('show');
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
                    url: '/superadmin/berita/berita/hapus/'+user_id,
                    beforeSend: function () {
                        $('#ok_button').text('Menghapus...');
                    }, success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            $('#berita-table').DataTable().ajax.reload();
                            Swal.fire("Berhasil", "Data dihapus!", "success");
                        }, 1000);
                    }
                });
            });

        });
    </script>
@endpush
