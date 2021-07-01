@extends('layouts.superadmin')

@section('title', 'Referensi | Mata Pelajaran')
@section('title-2', 'Mata Pelajaran')
@section('title-3', 'Mata Pelajaran')
@section('describ')
    Ini adalah halaman Mata Pelajaran untuk superadmin
@endsection
@section('icon-l', 'icon-book-open')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('superadmin.referensi.matapelajaran') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-block">
                    <form id="form-mapel">
                    @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="nama_pelajaran">Mata Pelajaran</label>
                                    <input type="text" id ="nama_pelajaran" name="nama_pelajaran" class="form-control form-control-sm" placeholder="Mata Pelajaran">
                                    <span id="form_result" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="hidden_id" id="hidden_id">
                                <input type="hidden" id="action" val="add">
                                <input type="submit" class="btn btn-sm btn-success" value="Simpan" id="btn">
                                <button type="reset" class="btn btn-sm btn-outline-success" id="btn-cancel">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead class="text-left">
                                <tr>
                                    <th>No.</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Actions</th>
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
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script> 
    <script>
        $(document).ready(function () {
            $('#order-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('superadmin.referensi.matapelajaran') }}",
            },
            columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nama_pelajaran',
                name: 'nama_pelajaran'
            },
            {
                data: 'action',
                name: 'action'
            }
            ]
        });
        
        $('#form-mapel').on('submit', function (event) {
                event.preventDefault();
                var url = '';
                var text = "Data sukses ditambahkan";

                if ($('#action').val() == 'add') {
                    url = "{{ route('superadmin.referensi.matapelajaran') }}";
                    text = "Data sukses ditambahkan";
                }
                
                if ($('#action').val() == 'edit') {
                    url = "{{ route('superadmin.referensi.matapelajaran-update') }}";
                    text = "Data sukses diupdate";
                }

                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            // for (var count = 0; count <= data.errors.length; count++) {
                            html = data.errors[0];
                            // }
                            $('#nama_pelajaran').addClass('is-invalid');
                            toastr.error(html);
                        }

                        if (data.success) {
                            Swal.fire("Berhasil", text, "success");
                            $('#nama_pelajaran').removeClass('is-invalid');
                            $('#form-mapel')[0].reset();
                            $('#action').val('add');
                            $('#btn')
                                .removeClass('btn-info')
                                .addClass('btn-success')
                                .val('Simpan');
                            $('#btn-cancel')
                                .removeClass('btn-outline-info')
                                .addClass('btn-outline-success')
                                .val('Batal');
                            $('#order-table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: '/superadmin/referensi/matapelajaran/'+id,
                    dataType: 'JSON',
                    success: function (data) {
                        // console.log(data);
                        $('#nama_pelajaran').val(data.nama_pelajaran);
                        $('#hidden_id').val(data.id);
                        $('#action').val('edit');
                        $('#btn')
                            .removeClass('btn-success')
                            .addClass('btn-info')
                            .val('Update');
                        $('#btn-cancel')
                            .removeClass('btn-outline-success')
                            .addClass('btn-outline-info')
                            .val('Batal');
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
                    url: '/superadmin/referensi/matapelajaran/hapus/'+user_id,
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