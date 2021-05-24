@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Fungsionaris | Guru')
@section('title-2', 'Guru')
@section('title-3', 'Guru')

@section('describ')
    Ini adalah halaman guru untuk admin
@endsection

@section('icon-l', 'icon-people')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.fungsionaris.guru') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="card-block">
                        <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                        <div class="dt-responsive table-responsive mt-3">
                            <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                                <thead class="text-left">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Guru</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
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

    {{-- Modal --}}
    @include('admin.fungsionaris.modals._guru')

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
            //read
            let table = $('#order-table').DataTable({
                processing:true,
                serverSide: true,
                ajax: "{{ route('admin.fungsionaris.guru') }}?req=table",
                columns:[
                    {data: 'DT_RowIndex'},
                    {data: 'nama_pegawai'},
                    {data: 'keterangan'},
                    {data: 'nama_status'},
                    {data: 'action'},
                ]
            });

            $('#add').on('click', function () {
                $('#modal-guru').modal('show');
                $('.form-control').val('');
                $('.modal-title').text('Tambah Guru');
                $('#action').val('add');
                $('#btn').removeClass('btn-info').addClass('btn-success').val('Simpan');
                $('#btn-cancel').removeClass('btn-outline-info').addClass('btn-outline-success').text('Batal');
            });

            $('#tanggal_lahir').dateDropper({
                theme: 'leaf',
                format: 'Y-m-d'
            });

            $('#tanggal_mulai').dateDropper({
                theme: 'leaf',
                format: 'Y-m-d'
            });

            $('#form-guru').on('submit', function (e) {
                event.preventDefault();

                var text = "Data sukses ditambahkan";

                if ($('#action').val() == 'add') {
                    url = "{{ route('admin.fungsionaris.guru.store') }}";
                    text = "Data sukses ditambahkan";
                }

                if ($('#action').val() == 'edit') {
                    url = "{{ route('admin.fungsionaris.guru.update') }}";
                    text = "Data sukses diupdate";
                }

                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    success: function (data) {
                        var html = '';

                        // rules error message
                        if (data.error) {
                            data.errors.pegawai_id ? $('#pegawai_id').addClass('is-invalid') : $('#pegawai_id').removeClass('is-invalid');
                            data.errors.status_guru_id ? $('#status_guru_id').addClass('is-invalid') : $('#status_guru_id').removeClass('is-invalid');
                            data.errors.status ? $('#status').addClass('is-invalid') : $('#status').removeClass('is-invalid');
                            data.errors.keterangan ? $('#keterangan').addClass('is-invalid') : $('#keterangan').removeClass('is-invalid');
                            toastr.error("data masih kosong");
                        }

                        // success success message
                        if (data.success) {
                            Swal.fire("Berhasil", text, "success");
                            $('#modal-guru').modal('hide');
                            $('#name').removeClass('is-invalid');
                            $('#form-guru')[0].reset();
                            $('#action').val('add');
                            $('#btn').removeClass('btn-info').addClass('btn-success').val('Simpan');
                            $('#btn-cancel').removeClass('btn-outline-info').addClass('btn-outline-success').text('Batal');
                            $('#order-table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            });


            $(document).on('click', '.edit', function () {
                var id = $(this).attr('data-id');
                console.log(id);
                $.ajax({
                    url: '/admin/fungsionaris/guru/edit/'+id,
                    dataType: 'JSON',
                    success: function (data) {
                        $('#action').val('edit');
                        $('#btn').removeClass('btn-success').addClass('btn-info').val('Update');
                        $('#btn-cancel').removeClass('btn-outline-success').addClass('btn-outline-info').text('Batal');
                        $('#pegawai_id').val(data.pegawai_id);
                        $('#status_guru_id').val(data.status_guru_id);
                        $('#keterangan').val(data.keterangan);
                        $('#status').val(data.status);
                        $('#hidden_id').val(data.id);
                        $('#modal-guru').modal('show');
                    }
                });
            });

            var user_id;
            $(document).on('click', '.delete', function () {
                user_id = $(this).attr('data-id');
                $('#ok_button').text('Hapus');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function () {
                $.ajax({
                    url: '/admin/fungsionaris/guru/delete/'+user_id,
                    beforeSend: function () {
                        $('#ok_button').text('Menghapus...');
                    }, success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            $('#order-table').DataTable().ajax.reload();
                            Swal.fire("Berhasil", "Data dihapus!", "success");
                        }, 1000);
                    }
                });
            });

        });
    </script>
@endpush
