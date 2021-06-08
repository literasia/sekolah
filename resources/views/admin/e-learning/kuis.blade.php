@extends('layouts.admin')

@section('title', 'E-Learning | Kuis')
@section('title-2', 'Kuis')
@section('title-3', 'Kuis')

@section('describ')
    Ini adalah halaman Kuis untuk admin
@endsection

@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('admin.e-learning.kuis') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-block">
                    <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                    <div class="dt-responsive table-responsive mt-3">
                        <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Paket Soal</th>
                                    <th>Nama Guru</th>
                                    <th>Jenis Kuis</th>
                                    <th>Keterangan</th>
                                    <th>Durasi</th>
                                    <th>Jumlah Pilihan Ganda</th>
                                    <th>Jumlah Essai</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Status</th>
                                    <th>Action</th>
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

@include('admin.e-learning.modals._kuis')
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
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-clockpicker.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
<style>
    .btn i {
        margin-right: 0px;
    }
    .rotate{
        -moz-transition: all .2s linear;
        -webkit-transition: all 2s linear;
        transition: all .2s linear;
    }
    .rotate.down{
        -moz-transform:rotate(90deg);
        -webkit-transform:rotate(90deg);
        transform:rotate(90deg);
    }
    .badge-secondary {
        background-color: #6c757d6b;
    }
    .duration-option, .duration-option:focus {
        border: 1px solid #ced4da!important;
        background-color: #85ccff4a;
    }
    .quiz-modal-wrapper {
        position: relative;
    }

    .quiz-modal-caption {
        position: absolute; 
        top: -35px; 
        left: 20px; 
        background: #fff;
    }
    .demo-content {
        visibility: hidden;
        display: none;
        z-index: 9999999!important;
        background: #fff;
    }
    .demo-wrapper a:hover + .demo-content, .demo-wrapper a:active + .demo-content, .demo-wrapper a:focus + .demo-content {
        visibility: visible;
        display: block;
    }
    .form-check-input-custom {
        margin-left: -1rem!important;
    }
    .btn-next {
        border-radius: 30px;
    }
    .border-bottom-custom {
        border-bottom: 2px solid red;
    }
    .modal-dialog {
        margin-bottom: 20rem!important;
    }
    .nav-link.active {
        font-weight: bold;
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
<script>
    $('document').ready(function() {
        $('#order-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.e-learning.kuis') }}",
            },
            columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'paket_soal',
                name: 'paket_soal'
            },
            {
                data: 'guru',
                name: 'guru'
            },
            {
                data: 'jenis_kuis',
                name: 'jenis_kuis'
            },
            {
                data: 'keterangan',
                name: 'keterangan'
            },
            {
                data: 'durasi',
                name: 'durasi'
            },
            {
                data: 'jumlah_soal_pg',
                name: 'jumlah_soal_pg'
            },
            {
                data: 'jumlah_soal_essai',
                name: 'jumlah_soal_essai'
            },
            {
                data: 'tanggal_mulai',
                name: 'tanggal_mulai'
            },
            {
                data: 'tanggal_selesai',
                name: 'tanggal_selesai'
            },
            {
                data: 'jam_mulai',
                name: 'jam_mulai'
            },
            {
                data: 'jam_selesai',
                name: 'jam_selesai'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action'
            }
            ]
        });

        $('#add').on('click', function() {
            $('.modal-title').html('Tambah Kuis');
            $('.form-control').val('');
            $('#action').val('add');
            $('#btn')
                .removeClass('btn-info')
                .addClass('btn-success')
                .val('Simpan');
            $('#btn-cancel')
                .removeClass('btn-outline-info')
                .addClass('btn-outline-success')
                .val('Batal');
            $('#modal-kuis').modal('show');
        });

        
        $('#form-kuis-ku').on('submit', function (event) {
            event.preventDefault();
            console.log('ta');
            var url = '';
            var text = "Data sukses ditambahkan";

            if ($('#action').val() == 'add') {
                url = "{{ route('admin.e-learning.kuis.store') }}";
                text = "Data sukses ditambahkan";
            }

            if ($('#action').val() == 'edit') {
                url = "{{ route('admin.e-learning.kuis.update') }}";
                text = "Data sukses diupdate";
            }

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
                success: function (data) {
                    if (data.single_choice) {
                        Swal.fire("Gagal", data.message, "error");
                    }

                    if (data.multiple_choice) {
                        Swal.fire("Gagal", data.message, "error");
                    }

                    if (data.errors) {
                        data.errors.soal_id ? $('#soal_id').addClass('is-invalid') : $('#soal_id').removeClass('is-invalid');
                        data.errors.guru_id ? $('#guru_id').addClass('is-invalid') : $('#guru_id').removeClass('is-invalid');
                        data.errors.jenis_kuis ? $('#jenis_kuis').addClass('is-invalid') : $('#jenis_kuis').removeClass('is-invalid');
                        data.errors.keterangan ? $('#keterangan').addClass('is-invalid') : $('#keterangan').removeClass('is-invalid');
                        data.errors.jumlah_soal_pg ? $('#jumlah_soal_pg').addClass('is-invalid') : $('#jumlah_soal_pg').removeClass('is-invalid');
                        data.errors.jumlah_soal_essai ? $('#jumlah_soal_essai').addClass('is-invalid') : $('#jumlah_soal_essai').removeClass('is-invalid');
                        data.errors.tanggal_mulai ? $('#tanggal_mulai').addClass('is-invalid') : $('#tanggal_mulai').removeClass('is-invalid');
                        data.errors.tanggal_selesai ? $('#tanggal_selesai').addClass('is-invalid') : $('#tanggal_selesai').removeClass('is-invalid');
                        data.errors.jam_mulai ? $('#jam_mulai').addClass('is-invalid') : $('#jam_mulai').removeClass('is-invalid');
                        data.errors.jam_selesai ? $('#jam_selesai').addClass('is-invalid') : $('#jam_selesai').removeClass('is-invalid');
                        data.errors.durasi ? $('#durasi').addClass('is-invalid') : $('#durasi').removeClass('is-invalid');
                        data.errors.status ? $('#status').addClass('is-invalid') : $('#status').removeClass('is-invalid');
                        toastr.error("data masih kosong!");
                        console.log(data.errors);
                    }

                    if (data.success) {
                        Swal.fire("Berhasil", text, "success");
                        $('.form-control').removeClass('is-invalid');
                        $('#form-kuis-ku')[0].reset();
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
                        $('#modal-kuis').modal('hide');
                    }
                }
            });
        });

        $('#tanggal_terbit, #tanggal_mulai, #tanggal_selesai').dateDropper({
            theme: 'leaf',
            format: 'd-m-Y'
        });

        $('.clockpicker').clockpicker({
            donetext: 'Done',
            autoclose: true
        });

        $(".rotate-collapse").click(function() {
            $(".rotate").toggleClass("down"); 
        });

        $(document).on('click', '.edit', function () {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/admin/e-learning/kuis/'+id,
                dataType: 'JSON',
                success: function (data) {
                    
                    $('#hidden_id').val(data.id);
                    $('#soal_id').val(data.soal_id);
                    $('#guru_id').val(data.guru_id);
                    $('#durasi').val(data.durasi);
                    $('#jenis_kuis').val(data.jenis_kuis);
                    $('#jumlah_soal_pg').val(data.jumlah_soal_pg);
                    $('#jumlah_soal_essai').val(data.jumlah_soal_essai);
                    $('#tanggal_mulai').val(data.tanggal_mulai);
                    $('#tanggal_selesai').val(data.tanggal_selesai);
                    $('#jam_mulai').val(data.jam_mulai);
                    $('#jam_selesai').val(data.jam_selesai);
                    $('#keterangan').val(data.keterangan);
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
                    $('#modal-kuis').modal('show');
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
                url: '/admin/e-learning/kuis/hapus/'+ user_id,
                beforeSend: function () {
                    $('#ok_button').text('Menghapus...');
                }, success: function (data) {
                    setTimeout(function () {
                        $('#confirmModal').modal('hide');
                        $('#order-table').DataTable().ajax.reload();
                        Swal.fire("Berhasil", data.success, "success");
                    }, 1000);
                }
            });
        });
    })
</script>
@endpush