@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'E-Voting | Posisi')
@section('title-2', 'Posisi')
@section('title-3', 'Posisi')

@section('describ')
    Ini adalah halaman posisi untuk admin
@endsection

@section('icon-l', 'icon-people')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.e-voting.posisi') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card glass-card d-flex justify-content-center align-items-center p-2">
                <div class=" col-xl-12 card shadow mb-0 p-0">
                    <div class="card-body">
                        <div class="card-block">
                            <form id="form-posisi-kandidat">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="nama_posisi">Nama posisi </label>
                                            <input type="text" name="nama_posisi" id="nama_posisi" class="form-control form-control-sm" placeholder="Nama Posisi">
                                            <input type="hidden" name="sekolah_id" id="sekolah_id" class="form-control form-control-sm" value="{{ $sekolahId = auth()->user()->id_sekolah }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="hidden_id" id="hidden_id">
                                        <input type="hidden" id="action" val="add">
                                        <input type="submit" class="btn btn-sm btn-success" value="Simpan" id="btn">
                                        <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal" id="btn-cancel">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="card glass-card d-flex justify-content-center align-items-center p-2">
                <div class=" col-xl-12 card shadow mb-0 p-0">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                                    <thead class="text-left">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Posisi</th>
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
    <script>
        $(document).ready(function () {
            $('#order-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.e-voting.posisi') }}",
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
                    data: 'action',
                    name: 'action'
                }
                ]
            });

            $('#form-posisi-kandidat').on('submit', function (event) {
                event.preventDefault();

                var url = '';
                var text = "Data sukses ditambahkan";

                if ($('#nama_posisi').val() == 'add') {
                    url = "{{ route('admin.e-voting.posisi') }}";
                    text = "Data sukses ditambahkan";
                }

                if ($('#action').val() == 'edit') {
                    url = "{{ route('admin.e-voting.posisi-update') }}";
                    text = "Data sukses diupdate";
                }

                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    success: function (data) {
                        var html = ''
                        if (data.errors) {
                            html = data.errors[0];
                            $('#nama_posisi').addClass('is-invalid');
                            toastr.error(html);
                        }

                        if (data.success) {
                            Swal.fire("Berhasil", text, "success");
                            $('#nama_posisi').removeClass('is-invalid');
                            $('#form-posisi-kandidat')[0].reset();
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
//
            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: '/admin/e-voting/posisi/'+id,
                    dataType: 'JSON',
                    success: function (data) {
                        $('#nama_posisi').val(data.nama_posisi.name);
                        $('#hidden_id').val(data.nama_posisi.id);
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
                    url: '/admin/e-voting/posisi/hapus/'+user_id,
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
