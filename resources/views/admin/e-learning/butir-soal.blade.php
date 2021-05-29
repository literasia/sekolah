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
                    <form id="form-butir-soal" action="" method="GET">
                        <input type="hidden" name="req" value="table">
                        <div class="row">
                            <div class="col-xl-4">
                                <select name="kelas_id" id="pilih" class="form-control form-control-sm" required>
                                    <option value="">-- Kelas --</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-xl-4">
                                <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-control form-control-sm">
                                    <option value="">-- Pelajaran --</option>
                                    <option value=""></option>
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
                                    <th>Kuis</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mengidentifikasi Isi Pokok Cerita Hikayat dengan Bahasa Sendiri</td>
                                    <td class="text-primary">Multiple choice</td>
                                    <td>Bahasa Indonesia Semester Ganjil</td>
                                    <td>2021/04/28</td>
                                    <td>05:04 PM</td>
                                    <td><label class="badge badge-success">Diterbitkan</label></td>
                                    <td>
                                        <button type="button" id="" class="preview btn btn-mini btn-primary shadow-sm">Preview</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Mengidentifikasi Ciri Teks Biografi Berdasarkan Isinya</td>
                                    <td class="text-success">Single choice</td>
                                    <td>Bahasa Indonesia Semester Ganjil</td>
                                    <td>2021/04/28</td>
                                    <td>05:04 PM</td>
                                    <td><label class="badge badge-warning">Draf</label></td>
                                    <td>
                                        <button type="button" id="" class="preview btn btn-mini btn-primary shadow-sm">Preview</button>
                                    </td>
                                </tr>
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
        $('#order-table').DataTable();

        var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

        tinymce.init({
            external_plugins: {
                'tiny_mce_wiris' : `{{ asset('assets/plugins/tinymce/plugins/tiny_mce_wiris/plugin.min.js') }}`,
            },
            selector: '#questions',
            height: 300,
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl | tiny_mce_wiris_formulaEditor | tiny_mce_wiris_formulaEditorChemistry',
            toolbar_sticky: true,
            // autosave_ask_before_unload: true,
            // autosave_interval: '30s',
            // autosave_prefix: '{path}{query}-{id}-',
            // autosave_restore_when_empty: false,
            // autosave_retention: '2m', 
            image_advtab: true,
            importcss_append: true,
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
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

        var counter = 2;
        
        $("#addButton").click(function () {
                
            if(counter>6){
                Swal.fire('Perhatian!', 'Hanya boleh 6 input form saja!', 'warning');
                return false;
            }   
        
            var newQuestionsForm =  '<div id="questions-form'+counter+'">' +
                                        '<div class="row">' +
                                            '<div class="col-8">' +
                                                '<input type="text" name="point" id="point'+counter+'" class="form-control form-control-sm mb-3">' +
                                            '</div>' +
                                            '<div class="col-4">' +
                                                '<input type="checkbox" name="" class="d-inline-block">' +
                                                '<p class="ml-2 d-inline-block">Jawaban yang benar</p>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>';

            
            $('#questions-group').append(newQuestionsForm);
            counter++;
        });

        $("#removeButton").click(function () {
        
            if(counter==1){
                Swal.fire('Perhatian!', 'Tidak ada yang dapat di hapus lagi', 'warning');
                return false;
            }      

            counter--;       
            $("#questions-form" + counter).remove();    
        });
    });
</script>
@endpush