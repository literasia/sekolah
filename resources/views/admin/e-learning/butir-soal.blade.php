@extends('layouts.admin')

@section('title', 'E-Learning | Butir Soal')
@section('title-2', 'Butir Soal')
@section('title-3', 'Butir Soal')

@section('describ')
    Ini adalah halaman Butir Soal untuk admin
@endsection

@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('admin.e-learning.butir-soal') }}
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
                                <select name="kelas_id" id="pilih" class="form-control form-control-sm" required>
                                    <option value="">-- Kelas --</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == $kelas_id)
                                                selected
                                            @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-4">
                                <select name="soal_id" id="soal_id" class="form-control form-control-sm">
                                    <option value="">-- Soal --</option>
                                    @foreach ($soal as $item)
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
                    <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                    <div class="dt-responsive table-responsive mt-3">
                       <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pertanyaan</th>
                                    <th>Jenis</th>
                                    <th>Kunci Jawaban</th>
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
@include('admin.e-learning.modals._butir-soal')
@include('admin.e-learning.modals._preview')
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


        $('#add').on('click', function() {
            $('.modal-title').html('Tambah Butir Soal');
            $('#modal-butir-soal').modal('show');
        });

        $('.preview').on('click', function() {
            $('.modal-title').html('Preview Soal');
            $('#modal-preview-soal').modal('show');
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
        let alphabet = ['a', 'b', 'c', 'd', 'e', 'f'];
        
        $("#addButton").click(function () {
                
            if(counter >= 6){
                Swal.fire('Perhatian!', 'Hanya boleh 6 input form saja!', 'warning');
                return false;
            }   
        
            let newAnswerField =  `<div id="answer-form${counter}">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" name="jawaban[]" id="jawaban${counter}'" class="form-control form-control-sm mb-3">
                                            </div>
                                            <div class="col-4">
                                                <input type="checkbox" name="kunci_jawaban" value="${alphabet[counter]}" class="d-inline-block">
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

        // ------

        if (`{{ $kelas_id }}` != "") {
            $('#order-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.e-learning.butir-soal') }}",
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
                    data: 'kunci_jawaban',
                    name: 'kunci_jawaban'
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
            $('#modal-butir-soal').modal('show');
        });

        $('#form-butir-soal').on('submit', function (event) {
            event.preventDefault();
            var url = '';

            if ($('#action').val() == 'add') {
                url = "{{ route('admin.e-learning.butir-soal.store') }}";
                text = "Data sukses ditambahkan";
            }

            if ($('#action').val() == 'edit') {
                url = "{{ route('admin.e-learning.butir-soal.update') }}";
                text = "Data sukses diupdate";
            }

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
                success: function (data) {
                    console.log(data);
                    var html = '';
                    if (data.errors) {
                        html = data.errors[0];
                        $('#kode').addClass('is-invalid');
                        $('#name').addClass('is-invalid');
                        toastr.error(html);
                    }

                    if (data.success) {
                        Swal.fire("Berhasil", data.success, "success");
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
                            .val('Batal');
                        $('#order-table').DataTable().ajax.reload();
                        $('#modal-butir-soal').modal('hide');
                    }
                    $('#form_result').html(html);
                }
            });
        });

        $(document).on('click', '.edit', function () {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/admin/e-learning/butir-soal/'+id,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $('#hidden_id').val(data.id);
                    tinymce.get('pertanyaan').setContent(data.pertanyaan);

                    $('#question_type').val('multiple-choice');
                    $('#multiple-choice').show();
                    $('#answer-group').html('');
                    $('#answer-group').append(`<label>Jawaban</label>`);
                    
                    let jawabans = data.jawaban;
                    let alphabet = ['a', 'b', 'c', 'd', 'e', 'f'];

                    counter = 0;

                    for (let index = 0; index < jawabans.length; index++) {
                        let newAnswerField =  `<div id="answer-form${counter}">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" name="jawaban[]" id="jawaban${counter}'" value="${jawabans[index]}" class="form-control form-control-sm mb-3">
                                            </div>
                                            <div class="col-4">
                                                <input type="checkbox" name="kunci_jawaban" value="${alphabet[counter]}" ${data.kunci_jawaban == alphabet[counter] ? 'checked' : '' } class="d-inline-block">
                                                <p class="ml-2 d-inline-block">Jawaban yang benar</p>
                                            </div>
                                        </div>
                                    </div>`;
                        
                        $('#answer-group').append(newAnswerField);
                        counter++;
                    }

                    console.log(counter);
                    

                    $('#modal-butir-soal').modal('show');
                    $('#action').val('edit');
                    $('#btn')
                        .removeClass('btn-success')
                        .addClass('btn-info')
                        .val('Update');
                    $('#btn-cancel')
                        .removeClass('btn-outline-success')
                        .addClass('btn-outline-info')
                        .val('Batal');
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
                url: '/admin/e-learning/butir-soal/hapus/'+ user_id,
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