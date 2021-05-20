@extends('layouts.admin')

@section('title', 'E-Learning | Soal')
@section('title-2', 'Soal')
@section('title-3', 'Soal')

@section('describ')
    Ini adalah halaman Soal untuk admin
@endsection

@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('admin.e-learning.soal') }}
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
                                    <th>No</th>
                                    <th>Pertanyaan</th>
                                    <th>Jenis</th>
                                    <th>Kuis</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Nama Guru</th>
                                    <th>Tanggal</th>
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
                                    <td>Bahasa Indonesia</td>
                                    <td>VII</td>
                                    <td>Mursilah</td>
                                    <td><small>Telah Terbit, 2021/04/28 pukul 05:04 PM</small></td>
                                    <td><label class="badge badge-success">Diterbitkan</label></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Mengidentifikasi Ciri Teks Biografi Berdasarkan Isinya</td>
                                    <td class="text-success">Single choice</td>
                                    <td>Bahasa Indonesia Semester Ganjil</td>
                                    <td>Bahasa Indonesia</td>
                                    <td>VII</td>
                                    <td>Mursilah</td>
                                    <td><small>Telah Terbit, 2021/04/28 pukul 05:04 PM</small></td>
                                    <td><label class="badge badge-warning">Draf</label></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.e-learning.modals._tambah-soal')
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
<script src="{{ asset('bower_components/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('bower_components/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{ asset('http://127.0.0.1:8000/bower_components/tinymce/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image')}}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script type="text/javascript">
    tinymce.init({
            external_plugins: {
                'tiny_mce_wiris' : 'http://127.0.0.1:8000/bower_components/tinymce/plugins/tiny_mce_wiris/plugin.min.js'
            },
            selector: 'textarea#materi',
            height: 200,
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl | tiny_mce_wiris_formulaEditor | tiny_mce_wiris_formulaEditorChemistry',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',  
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
</script>
<script>
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
            // $('.modal-title').html('Tambah Pesan');
            // $('#judul').val('');
            // $('#message').val('');
            // $('#start_date').val('');
            // $('#end_date').val('');
            // $('#action').val('add');
            // $('#button')
            //     .removeClass('btn-outline-success edit')
            //     .addClass('btn-outline-info add')
            //     .html('Simpan'); ;
            $('#modal-soal').modal('show');
        });

        $('#question_type').change(function(){
            $('.answer').hide();
            $('#' + $(this).val()).show();
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