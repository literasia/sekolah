@extends('layouts.admin')

@section('title', 'Bank Soal | Butir Soal')
@section('title-2', 'Butir Soal')
@section('title-3', 'Butir Soal')

@section('describ')
    Ini adalah halaman Butir Soal untuk admin
@endsection

@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('admin.banksoal.butir-soal') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-block">
                    <h6>Filter</h6>
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-xl-4">
                                <select name="kelas_id" id="pilih" class="form-control form-control-sm">
                                    <option value="">-- Kelas --</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == $kelas_id)
                                                selected
                                            @endif>{{ $item->tingkatanKelas->name }} - {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-4">
                                <select name="soal_id" id="soal_id" class="form-control form-control-sm" required>
                                    <option value="">-- Soal --</option>
                                    @foreach ($bank_soals as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == $soal_id)
                                                selected
                                            @endif>{{ $item->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-2">
                                <input type="submit" value="Pilih" class="btn btn-block btn-sm btn-primary shadow-sm">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-block">
                    @if ($soal_id != "" || $kelas_id != "")
                        <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                    @endif
                    <div class="dt-responsive table-responsive mt-3">
                       <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Pertanyaan</th>
                                    <th>Jenis Soal</th>
                                    <th>Poin</th>
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
@include('admin.banksoal.modals._butir-soal')
@include('admin.banksoal.modals._preview')
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
    .family-modal-wrapper {
        position: relative;
    }
    .family-modal-caption {
        position: absolute; 
        top: -35px; 
        left: 20px; 
        background: rgb(255 255 255 / 57%);
    }
</style>
@endpush

{{-- addons js --}}
@push('js')
<script src="{{ asset('assets/plugins/tinymce/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image')}}"></script> 
<script src="{{ asset('assets/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
<script type="text/javascript">
    $('document').ready(function() {
        let tinyMceObj = {
            external_plugins: {
                'tiny_mce_wiris' : `{{ asset('assets/plugins/tinymce/plugins/tiny_mce_wiris/plugin.min.js') }}`,
            },
            height: 300,
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl | tiny_mce_wiris_formulaEditor | tiny_mce_wiris_formulaEditorChemistry',
            toolbar_sticky: true, 
            image_advtab: true,
            importcss_append: true,
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        }
        tinymce.init({
            ...tinyMceObj,
            selector: '#pertanyaan',
        });
        $(document).on('focusin', function(e) {
            if ($(e.target).closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root, .wrs_modal_dialogContainer").length) {
                e.stopImmediatePropagation();
            }
        });
        $(document).on('click', '.preview', function () {
            $('.modal-title').html('Preview Soal');
            let id = $(this).attr('data-id');
            $.ajax({
                url: '/admin/banksoal/butir-soal/'+id,
                dataType: 'JSON',
                success: function (data) {
                    $('#preview-pertanyaan').html(data.pertanyaan);
                    if (data.jenis_soal == "multiple-choice") {
                        let jawabans = data.jawaban;
                        let alphabet = ['A', 'B', 'C', 'D', 'E', 'F'];
                        $('#preview-opsi-group').html('');
                        for (let index = 0; index < jawabans.length; index++) {
                            let previewJawaban =    `<div class="form-check my-3">
                                                        <input class="form-check-input" ${data.kunci_jawaban.toUpperCase() == alphabet[index] ? 'checked' : ''} type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                        <label class="form-check-label" for="flexRadioDefault2">${jawabans[index]}${data.kunci_jawaban.toUpperCase() == alphabet[index] ? 
                                                            '<label for="" class="label label-sm label-success ml-3">Jawaban yang Benar</label>' : ''
                                                        }</label>
                                                    </div>`;
                            $('#preview-opsi-group').append(previewJawaban);
                        }
                        $('.preview-opsi-group').show();
                        $('#answer-row').show();
                    } else {
                        $('.preview-opsi-group').hide();
                        $('#answer-row').hide();
                    }
                    $('#modal-preview-soal').modal('show');

                }
            });
        });
        $('#question_type').change(function(){
            $('.answer').hide();
            $('#' + $(this).val()).show();
        });

        $('#publish_date').dateDropper({
            theme: 'leaf',
            format: 'd-m-Y'
        });

        $('.clockpicker').clockpicker({
            donetext: 'Done',
            autoclose: true
        });
        
        let counter = 1;
        let alphabet = ['A', 'B', 'C', 'D', 'E', 'F'];
        
        $("#addButton").click(function () {
            counter = 1;
            if(counter >= 6){
                Swal.fire('Perhatian!', 'Hanya boleh 6 input form saja!', 'warning');
                return false;
            }   
        
            let newAnswerField =  `<div id="answer-form${counter}">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" name="jawaban[]" id="jawaban${counter}" class="form-control form-control-sm mb-3">
                                            </div>
                                            <div class="col-4">
                                                <input type="radio" name="kunci_jawaban" value="${alphabet[counter]}" class="d-inline-block">
                                                <p class="ml-2 d-inline-block">Jawaban yang benar</p>
                                            </div>
                                        </div>
                                    </div>`;
            
            $('#answer-group').append(newAnswerField);
            counter++;
        });
        $("#removeButton").click(function () {
            if(counter==1){
                Swal.fire('Perhatian!', 'Tidak ada yang dapat di hapus lagi', 'warning');
                return false;
            }      
            counter--;       
            $("#answer-form" + counter).remove();    
        });
        
        if (`{{ $kelas_id }}` != "" || `{{ $soal_id }}` != "") {
            $('#order-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.banksoal.butir-soal') }}",
                    type: "GET",
                    data: {
                        'soal_id' : `{{ $soal_id }}`,
                        'kelas_id' : `{{ $kelas_id }}`,
                    }
                },
                columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'pertanyaan',
                    name: 'pertanyaan'
                },
                {
                    data: 'jenis_soal',
                    name: 'jenis_soal'
                },
                {
                    data: 'poin',
                    name: 'poin'
                },
                {
                    data: 'action',
                    name: 'action'
                },
                ]
            });
        }
            
        $('#add').on('click', function() {    
            $('.modal-title').html('Tambah Butir Soal');
            $('.form-control').val('');
            $('#point').val(1);
            $('#action').val('add');
            $('#hidden_id').val('');
            
            tinymce.get('pertanyaan').setContent('');
            $('#question_type').val('');
            $('#answer-group').html('');
            let newAnswerField =  `<label>Jawaban</label>
                                    <div id="answer-form0">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" name="jawaban[]" id="jawaban0" class="form-control form-control-sm mb-3">
                                            </div>
                                            <div class="col-4">
                                                <input type="radio" name="kunci_jawaban" value="A" class="d-inline-block">
                                                <p class="ml-2 d-inline-block">Jawaban yang benar</p>
                                            </div>
                                        </div>
                                    </div>`;
                            
            $('#answer-group').append(newAnswerField);
            $('.answer').hide();
            $('#btn')
                .removeClass('btn-info')
                .addClass('btn-success')
                .val('Simpan');
            $('#btn-cancel')
                .removeClass('btn-outline-info')
                .addClass('btn-outline-success')
                .text('Batal');
            $('#modal-butir-soal').modal('show');
        });
        $('#form-butir-soal').on('submit', function (event) {
            event.preventDefault();
            var url = '';
            var text = 'Data sukses ditambahkan';

            if ($('#action').val() == 'add') {
                url = "{{ route('admin.banksoal.butir-soal.store') }}";
                text = "Data sukses ditambahkan";
            }
            if ($('#action').val() == 'edit') {
                url = "{{ route('admin.banksoal.butir-soal.update') }}";
                text = "Data sukses diupdate";
            }
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
                success: function (data) {
                    if (data.errors) {
                        data.errors.poin ? $('#poin').addClass('is-invalid') : $('#poin').removeClass('is-invalid');
                        data.errors.jenis_soal ? $('#question_type').addClass('is-invalid') : $('#question_type').removeClass('is-invalid');
                        toastr.error("data masih kosong!");
                    }
                    if (data.success) {
                        Swal.fire("Berhasil", text, "success");
                        $('.form-control').removeClass('is-invalid');
                        $('#form-butir-soal')[0].reset();
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
                        $('#modal-butir-soal').modal('hide');
                    }
                }
            });
        });

        $(document).on('click', '.edit', function () {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/admin/banksoal/butir-soal/'+id,
                dataType: 'JSON',
                success: function (data) {
                    $('.modal-title').html('Edit Butir Soal');
                    $('#hidden_id').val(data.id);
                    tinymce.get('pertanyaan').setContent(data.pertanyaan);
                    $('#question_type').val(data.jenis_soal);
                    $('#poin').val(data.poin);
                    $('#answer-group').html('');
                    if (data.jenis_soal == "single-choice") {
                        $('#addButton').hide();
                        $('#removeButton').hide();
                    }

                    counter = 0;
                    if (data.jenis_soal == "multiple-choice") {
                        let jawabans = data.jawaban;
                        let alphabet = ['A', 'B', 'C', 'D', 'E', 'F'];

                        for (let index = 0; index < jawabans.length; index++) {
                            let newAnswerField =  `<div id="answer-form${counter}">
                                            <div class="row">
                                                <div class="col-8">
                                                    <input type="text" name="jawaban[]" id="jawaban${counter}" value="${jawabans[index]}" class="form-control form-control-sm mb-3">
                                                </div>
                                                <div class="col-4">
                                                    <input type="radio" name="kunci_jawaban" value="${alphabet[counter]}" ${data.kunci_jawaban == alphabet[counter] ? 'checked' : '' } class="d-inline-block">
                                                    <p class="ml-2 d-inline-block">Jawaban yang benar</p>
                                                </div>
                                            </div>
                                        </div>`;
                            
                            $('#answer-group').append(newAnswerField);
                            counter++;
                        }
                        $('.answer').show();
                    }
                    $('#action').val('edit');
                    $('#btn')
                        .removeClass('btn-success')
                        .addClass('btn-info')
                        .val('Update');
                    $('#btn-cancel')
                        .removeClass('btn-outline-success')
                        .addClass('btn-outline-info')
                        .text('Batal');        
                    $('#modal-butir-soal').modal('show');
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
                url: '/admin/banksoal/butir-soal/hapus/'+ user_id,
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
        
    });
</script>
@endpush
