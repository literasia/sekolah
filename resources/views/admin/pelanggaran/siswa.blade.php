@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Pelanggaran | Pelanggaran Siswa')
@section('title-2', 'Pelanggaran Siswa')
@section('title-3', 'Pelanggaran Siswa')

@section('describ')
    Ini adalah halaman pelanggaran siswa untuk admin
@endsection

@section('icon-l', 'icon-people')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.pesertadidik.siswa-pindahan') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card glass-card d-flex justify-content-center align-items-center p-2">
                <div class=" col-xl-12 card shadow mb-0 p-0">
                    <div class="card-body">
                        <div class="card-block">
                            <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                            <div class="dt-responsive table-responsive mt-3">
                                <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                                    <thead class="text-left">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Siswa</th>
                                            <th>Tanggal</th>
                                            <th>Pelanggaran</th>
                                            <th>Poin</th>
                                            <th>Sebab</th>
                                            <th>Sanksi</th>
                                            <th>Penanganan</th>
                                            <th>Keterangan</th>
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
    {{-- Modal --}}
    @include('admin.pelanggaran.modals._siswa')
@endsection

{{-- addons css --}}
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <!-- Select 2 css -->
    <link rel="stylesheet" href="{{ asset('bower_components/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datedropper/css/datedropper.min.css') }}" />
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
        .select2-container {
            width: 100% !important;
            padding: 0;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            background-color: transparent;
            color: #000;
            padding: 0px 30px 0px 10px;
        }
    </style>
@endpush

{{-- addons js --}}
@push('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Select 2 js -->
    <script type="text/javascript" src="{{ asset('bower_components/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script>
        $(document).ready(function () {
            $('#siswa_id').select2();


            $('#add').on('click', function () {
                $('#siswa_id').select2('destroy').val('').select2();
                $('#form-pelanggaran-siswa')[0].reset();
                $('#btn')
                    .removeClass('btn-info')
                    .addClass('btn-success')
                    .val('Simpan');
                $('#action').val('add');
                $('#siswa_id').select2('destroy').val('').select2();
                $('#form-pelanggaran-siswa')[0].reset();
                $('#modal-siswa').modal('show');
                $('#btn-cancel')
                    .removeClass('btn-outline-info')
                    .addClass('btn-outline-success')
            });


            $('#tanggal_pelanggaran').dateDropper({
                theme: 'leaf',
                format: 'd-m-Y'
            });
            $('#order-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.pelanggaran.siswa') }}",
                },
                columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_siswa',
                    name: 'nama_siswa'
                },
                {
                    data: 'tanggal_pelanggaran',
                    name: 'tanggal_pelanggaran'
                },
                {
                    data: 'pelanggaran',
                    name: 'pelanggaran'
                },
                {
                    data: 'poin',
                    name: 'poin'
                },
                {
                    data: 'sebab',
                    name: 'sebab'
                },
                {
                    data: 'sanksi',
                    name: 'sanksi'
                },
                {
                    data: 'penanganan',
                    name: 'Penanganan'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'action',
                    name: 'action'
                }
                ],
                columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: 5
                }
                ]
            });
            $('#form-pelanggaran-siswa').on('submit', function (event) {
                event.preventDefault();
                var url = '';
                if ($('#action').val() == 'add') {
                    url = "{{ route('admin.pelanggaran.siswa') }}";
                    text = "Data sukses ditambahkan";
                }
                if ($('#action').val() == 'edit') {
                    url = "{{ route('admin.pelanggaran.siswa-update') }}";
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
                            $('#siswa').addClass('is-invalid');
                            toastr.error(html);
                        }
                        if (data.success) {
                            Swal.fire("Berhasil", text, "success");
                            $('#modal-siswa').modal('hide');
                            $('#siswa').removeClass('is-invalid');
                            $('#form-pelanggaran-siswa')[0].reset();
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
                var id = $(this).attr('id');
                $.ajax({
                    url: '/admin/pelanggaran/siswa/'+id,
                    dataType: 'JSON',
                    success: function (data) {
                        $('#action').val('edit');
                        $('#siswa_id').select2('val', '1');
                        $('#tanggal_pelanggaran').val(data.tanggal_pelanggaran);
                        $('#pelanggaran').val(data.pelanggaran);
                        $('#poin_lama').val(data.poin);
                        $('#poin').val(data.poin);
                        $('#sebab').val(data.sebab);
                        $('#sanksi').val(data.sanksi);
                        $('#penanganan').val(data.penanganan);
                        $('#keterangan').val(data.keterangan);
                        $('#hidden_id').val(data.id);
                        $('#btn')
                            .removeClass('btn-success')
                            .addClass('btn-info')
                            .val('Update');
                        $('#btn-cancel')
                            .removeClass('btn-outline-success')
                            .addClass('btn-outline-info')
                            .val('Batal');
                        $('#modal-siswa').modal('show');
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
                    url: '/admin/pelanggaran/siswa/hapus/'+user_id,
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
        const pelanggaran = document.getElementById('pelanggaran');
        const poin = document.getElementById('poin');
        function setPoin(selected){
            // console.log(pelanggaran.options[pelanggaran.selectedIndex].dataset.poi n);
            poin.value = pelanggaran.options[pelanggaran.selectedIndex].dataset.poin;
        }
    </script>
@endpush
