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
        <div class="card glass-card d-flex justify-content-center align-items-center p-2">
            <div class=" col-xl-12 card shadow mb-0 p-0">
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
    .glass-card {
        background: rgba( 255, 255, 255, 0.40 );
        box-shadow: 0 8px 32px 0 rgb(31 38 135 / 22%);
        backdrop-filter: blur( 17.5px );
        -webkit-backdrop-filter: blur( 17.5px );
        border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );
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
            $('#form-kuis-ku')[0].reset();
            $('.modal-title').html('Tambah Kuis');
            $('.form-control').val('');
            $('#action').val('add');
            $('#hide-quiz').prop( "checked", false );
            $('#restart-quiz').prop('checked', false);
            $('#random-quiz').prop('checked', true);
            $('#random-option').prop('checked', true);
            $('#statistic').prop('checked', true);
            $('#take_quiz_only_once').prop('checked', false);
            $('#specific-number').prop('checked', true);
            $('#skip-question').prop('checked', false);
            $('#autostart').prop('checked', false);
            $('#registered-user').prop('checked', true);
            $('#show-point').prop('checked', false);
            $('#number-answers').prop('checked', false);
            $('#hide-message').prop('checked', true);
            $('#answer-mark').prop('checked', true);
            $('#force-answer').prop('checked', false);
            $('#hide-numbering').prop('checked', true);
            $('#average-point').prop('checked', true);
            $('#hide-correct-question').prop('checked', false);
            $('#hide-quiz-time').prop('checked', false);
            $('#hide-score').prop('checked', false);

            $('#label-hide-quiz').text('Aktifkan');
            $('#label-restart-quiz').text('Aktifkan');
            $('#label-random-quiz').text('Aktif');
            $('#label-random-option').text('Aktif');
            $('#label-statistic').text('Aktif');
            $('#label-once-quiz').text('Aktifkan');
            $('#label-specific-number').text('Aktif');
            $('#label-skip-question').text('Nonaktifkan');
            $('#label-autostart').text('Aktifkan');
            $('#label-registered-user').text('Aktif');
            $('#label-show-point').text('Aktifkan');
            $('#label-number-answers').text('Aktifkan');
            $('#label-hide-message').text('Aktif');
            $('#label-answer-mark').text('Dinonaktifkan');
            $('#label-force-answer').text('Aktifkan');
            $('#label-hide-numbering').text('Aktif');
            $('#label-average-point').text('Aktif');
            $('#label-hide-correct-question').text('Aktifkan');
            $('#label-hide-quiz-time').text('Aktifkan');
            $('#label-hide-score').text('Aktifkan');
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

        $("input[type='checkbox']").click(function() {
            $('#hide-quiz').change(function(){
                if ($("#hide-quiz").is(':checked')){
                    $('#label-hide-quiz').text("Aktif");
                } else {
                    $('#label-hide-quiz').text("Aktifkan");
                }
            });

            $('#restart-quiz').change(function(){
                if ($("#restart-quiz").is(':checked')){
                    $('#label-restart-quiz').text("Aktif");
                } else {
                    $('#label-restart-quiz').text("Aktifkan");
                }
            });

            $('#random-question').change(function(){
                if ($("#random-question").is(':checked')){
                    $('#label-random-question').text("Aktif");
                } else {
                    $('#label-random-question').text("Aktifkan");
                }
            });

            $('#random-option').change(function(){
                if ($("#random-option").is(':checked')){
                    $('#label-random-option').text("Aktif");
                } else {
                    $('#label-random-option').text("Aktifkan");
                }
            });

            $('#statistic').change(function(){
                if ($("#statistic").is(':checked')){
                    $('#label-statistic').text("Aktif");
                } else {
                    $('#label-statistic').text("Aktifkan");
                }
            });

            $('#once-quiz').change(function(){
                if ($("#once-quiz").is(':checked')){
                    $('#label-once-quiz').text("Aktif");
                } else {
                    $('#label-once-quiz').text("Aktifkan");
                }
            });

            $('#specific-number').change(function(){
                if ($("#specific-number").is(':checked')){
                    $('#label-specific-number').text("Aktif");
                } else {
                    $('#label-specific-number').text("Aktifkan");
                }
            });

            $('#skip-question').change(function(){
                if ($("#skip-question").is(':checked')){
                    $('#label-skip-question').text("Dinonaktifkan");
                } else {
                    $('#label-skip-question').text("Nonaktifkan");
                }
            });

            $('#autostart').change(function(){
                if ($("#autostart").is(':checked')){
                    $('#label-autostart').text("Aktif");
                } else {
                    $('#label-autostart').text("Aktifkan");
                }
            });

            $('#registered-user').change(function(){
                if ($("#registered-user").is(':checked')){
                    $('#label-registered-user').text("Aktif");
                } else {
                    $('#label-registered-user').text("Aktifkan");
                }
            });

            $('#show-point').change(function(){
                if ($("#show-point").is(':checked')){
                    $('#label-show-point').text("Aktif");
                } else {
                    $('#label-show-point').text("Aktifkan");
                }
            });

            $('#number-answers').change(function(){
                if ($("#number-answers").is(':checked')){
                    $('#label-number-answers').text("Aktif");
                } else {
                    $('#label-number-answers').text("Aktifkan");
                }
            });

            $('#hide-message').change(function(){
                if ($("#hide-message").is(':checked')){
                    $('#label-hide-message').text("Aktif");
                } else {
                    $('#label-hide-message').text("Aktifkan");
                }
            });

            $('#answer-mark').change(function(){
                if ($("#answer-mark").is(':checked')){
                    $('#label-answer-mark').text("Dinonaktifkan");
                } else {
                    $('#label-answer-mark').text("Nonaktifkan");
                }
            });

            $('#force-answer').change(function(){
                if ($("#force-answer").is(':checked')){
                    $('#label-force-answer').text("Aktif");
                } else {
                    $('#label-force-answer').text("Aktifkan");
                }
            });

            $('#hide-numbering').change(function(){
                if ($("#hide-numbering").is(':checked')){
                    $('#label-hide-numbering').text("Aktif");
                } else {
                    $('#label-hide-numbering').text("Aktifkan");
                }
            });

            $('#average-point').change(function(){
                if ($("#average-point").is(':checked')){
                    $('#label-average-point').text("Aktif");
                } else {
                    $('#label-average-point').text("Aktifkan");
                }
            });

            $('#hide-correct-question').change(function(){
                if ($("#hide-correct-question").is(':checked')){
                    $('#label-hide-correct-question').text("Aktif");
                } else {
                    $('#label-hide-correct-question').text("Aktifkan");
                }
            });

            $('#hide-quiz-time').change(function(){
                if ($("#hide-quiz-time").is(':checked')){
                    $('#label-hide-quiz-time').text("Aktif");
                } else {
                    $('#label-hide-quiz-time').text("Aktifkan");
                }
            });

            $('#hide-score').change(function(){
                if ($("#hide-score").is(':checked')){
                    $('#label-hide-score').text("Aktif");
                } else {
                    $('#label-hide-score').text("Aktifkan");
                }
            });
        });

        $('#form-kuis-ku').on('submit', function (event) {
            event.preventDefault();
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
                     // console.log(data.pengaturan.is_hide_title);
                    for (const peng in data.pengaturan) {
                        $(`input[name="${peng}"]`).attr("checked", data.pengaturan[peng]?true:false);
                    }
                    $('.modal-title').html('Edit Kuis');
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

                    if (data.pengaturan.is_hide_title == 1) {
                        $('#hide-quiz').prop("checked", true );
                        $('#label-hide-quiz').text('Aktif');
                    } else {
                        $('#hide-quiz').prop("checked", false );
                        $('#label-hide-quiz').text('Aktifkan');
                    }

                    if (data.pengaturan.restart_quiz == 1 ) {
                        $('#restart-quiz').prop("checked", true );
                        $('#label-restart-quiz').text('Aktif');
                    } else {
                        $('#restart-quiz').prop("checked", false );
                        $('#label-restart-quiz').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.random_question == 1) {
                        $('#random-question').prop("checked", true);
                        $('#label-random-question').text('Aktif');
                    } else {
                        $('#random-question').prop( "checked", false );
                        $('#label-random-question').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.random_option == 1) {
                        $('#random-option').prop('checked', true);
                        $('#label-random-option').text('Aktif');
                    } else {
                        $('#random-option').prop( "checked", false );
                        $('#label-random-option').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.statistic == 1) {
                        $('#statistic').prop('checked', true);
                        $('#label-statistic').text('Aktif');
                    } else {
                        $('#statistic').prop( "checked", false );
                        $('#label-statistic').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.take_quiz_only_once == 1) {
                        $('#take_quiz_only_once').prop('checked', true);
                        $('#label-once-quiz').text('Aktif');
                    } else {
                        $('#take_quiz_only_once').prop( "checked", false );
                        $('#label-once-quiz').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.only_show_specific_question == 1) {
                        $('#specific-number').prop('checked', true);
                        $('#label-specific-number').text('Aktif');
                    } else {
                        $('#specific-number').prop( "checked", false );
                        $('#label-specific-number').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.skip_question == 1) {
                        $('#skip-question').prop('checked', true);
                        $('#label-skip-question').text('Dinonaktifkan');
                    } else {
                        $('#skip-question').prop( "checked", false );
                        $('#label-skip-question').text('Nonaktifkan');
                    }
                    
                    if (data.pengaturan.autostart == 1) {
                        $('#autostart').prop('checked', true);
                        $('#label-autostart').text('Aktif');
                    } else {
                        $('#autostart').prop( "checked", false );
                        $('#label-autostart').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.only_registered == 1) {
                        $('#registered-user').prop('checked', true);
                        $('#label-registered-user').text('Aktif');
                    } else {
                        $('#registered-user').prop( "checked", false );
                        $('#label-registered-user').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.show_point == 1) {
                        $('#show-point').prop('checked', true);
                        $('#label-show-point').text('Aktif');
                    } else {
                        $('#show-point').prop( "checked", false );
                        $('#label-show-point').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.with_number_in_option  == 1) {
                        $('#number-answers').prop('checked', true);
                        $('#label-number-answers').text('Aktif');
                    } else {
                        $('#number-answers').prop( "checked", false );
                        $('#label-number-answers').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.show_correct_option == 1) {
                        $('#hide-message').prop('checked', true);
                        $('#label-hide-message').text('Aktif');
                    } else {
                        $('#hide-message').prop( "checked", false );
                        $('#label-hide-message').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.answer_mark == 1) {
                        $('#answer-mark').prop('checked', true);
                        $('#label-answer-mark').text('Dinonaktifkan');
                    } else {
                        $('#answer-mark').prop( "checked", false );
                        $('#label-answer-mark').text('Nonaktifkan');
                    }
                    
                    if (data.pengaturan.force_answer == 1) {
                        $('#force-answer').prop('checked', true);
                        $('#label-force-answer').text('Aktif');
                    } else {
                        $('#force-answer').prop( "checked", false );
                        $('#label-force-answer').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.hide_numbering == 1) {
                        $('#hide-numbering').prop('checked', true);
                        $('#label-hide-numbering').text('Aktif');
                    } else {
                        $('#hide-numbering').prop( "checked", false );
                        $('#label-hide-numbering').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.show_average_point == 1) {
                        $('#average-point').prop('checked', true);
                        $('#label-average-point').text('Aktif');
                    } else {
                        $('#average-point').prop( "checked", false );
                        $('#label-average-point').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.hide_correct_question == 1) {
                        $('#hide-correct-question').prop('checked', true);
                        $('#label-hide-correct-question').text('Aktif');
                    } else {
                        $('#hide-correct-question').prop( "checked", false );
                        $('#label-hide-correct-question').text('Aktifkan');
                    }

                    if (data.pengaturan.hide_quiz_time == 1) {
                        $('#hide-quiz-time').prop('checked', true);
                        $('#label-hide-quiz-time').text('Aktif');
                    } else {
                        $('#hide-quiz-time').prop( "checked", false );
                        $('#label-hide-quiz-time').text('Aktifkan');
                    }
                    
                    if (data.pengaturan.hide_quiz_score == 1) {
                        $('#hide-score').prop('checked', true);
                        $('#label-hide-score').text('Aktif');
                    } else {
                        $('#hide-score').prop( "checked", false );
                        $('#label-hide-score').text('Aktifkan');
                    }
                    
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