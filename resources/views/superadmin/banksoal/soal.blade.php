@extends('layouts.superadmin')

@section('title', 'Bank Soal | Soal')
@section('title-2', 'Soal')
@section('title-3', 'Soal')

@section('describ')
    Ini adalah halaman Bank Soal untuk superadmin
@endsection

@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('superadmin.banksoal.soal') }}
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
                                    <th>Judul</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Tingkat Pendidikan</th>
                                    <!-- <th>Kelas</th> -->
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
@include('superadmin.banksoal.modals._tambah-soal')
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
    .modal-dialog {
        margin-bottom: 6rem!important;
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
<script type="text/javascript">
    $('document').ready(function() {
        $('#order-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('superadmin.banksoal.soal') }}",
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
                data: 'mata_pelajaran',
                name: 'mata_pelajaran'
            },
            {
                data: 'tingkat',
                name: 'tingkat'
            },
            // {
            //     data: 'kelas',
            //     name: 'kelas'
            // },
            {
                data: 'action',
                name: 'action'
            }
            ]
        });
        $('#add').on('click', function() {
            $('.modal-title').html('Tambah Soal');
            $('.form-control').val('');
            $('#action').val('add');
            $('#hidden_id').val('');
            $('#judul').val('');
            $('#mata_pelajaran_id').val('');
            $('#tingkat_id').val('');
            $('#status').val('');
            $('#btn')
                .removeClass('btn-info')
                .addClass('btn-success')
                .val('Simpan');
            $('#btn-cancel')
                .removeClass('btn-outline-info')
                .addClass('btn-outline-success')
                .val('Batal');
            $('#modal-soal').modal('show');
        });
        $('#publish_date').dateDropper({
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
        $('#form-soal').on('submit', function (event) {
            event.preventDefault();
            var url = '';
            var text = "Data sukses ditambahkan";
            if ($('#action').val() == 'add') {
                url = "{{ route('superadmin.banksoal.soal.store') }}";
                text = "Data sukses ditambahkan";
            }
            if ($('#action').val() == 'edit') {
                url = "{{ route('superadmin.banksoal.soal.update') }}";
                text = "Data sukses diupdate";
            }
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
                success: function (data) {
                    if (data.errors) {
                        
                        data.errors.judul ? $('#judul').addClass('is-invalid') : $('#judul').removeClass('is-invalid');
                        data.errors.mata_pelajaran_id ? $('#mata_pelajaran_id').addClass('is-invalid') : $('#mata_pelajaran_id').removeClass('is-invalid');
                        data.errors.tingkat_id ? $('#tingkat_id').addClass('is-invalid') : $('#tingkat_id').removeClass('is-invalid');
                        // data.errors.kelas_id ? $('#kelas_id').addClass('is-invalid') : $('#kelas_id').removeClass('is-invalid');
                        toastr.error("data masih kosong");
                    }
                    if (data.success) {
                        Swal.fire("Berhasil", text, "success");
                        $('.form-control').removeClass('is-invalid');
                        $('#form-soal')[0].reset();
                        $('#action').val('add');
                        $('#btn')
                            .removeClass('btn-info')
                            .addClass('btn-success')
                            .val('Simpan');
                        $('#btn-cancel')
                            .removeClass('btn-outline-info')
                            .addClass('btn-outline-success')
                            .text('Batal');
                        $('#order-table').DataTable().ajax.reload();
                        $('#modal-soal').modal('hide');
                    }
                    $('#form_result').html(html);
                }
            });
        });
        $(document).on('click', '.edit', function () {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/superadmin/banksoal/soal/'+id,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $('.modal-title').html('Edit Soal');
                    $('#action').val('edit');
                    $('#hidden_id').val(data.id);
                    $('#judul').val(data.judul);
                    $('#mata_pelajaran_id').val(data.mata_pelajaran_id);
                    $('#tingkat_id').val(data.tingkat_id);
                    $('#status').val(data.status);
                    $('#btn')
                        .removeClass('btn-success')
                        .addClass('btn-info')
                        .val('Update');
                    $('#btn-cancel')
                        .removeClass('btn-outline-success')
                        .addClass('btn-outline-info')
                        .text('Batal');
                    $('#modal-soal').modal('show');
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
                url: '/superadmin/banksoal/soal/hapus/'+ user_id,
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