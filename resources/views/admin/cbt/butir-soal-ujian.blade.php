@extends('layouts.admin')

@section('title', 'Computer Based Test | Butir Soal Ujian')
@section('title-2', 'Butir Soal Ujian')
@section('title-3', 'Butir Soal Ujian')

@section('describ')
    Ini adalah halaman Butir Soal Ujian untuk admin
@endsection

@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('admin.cbt.butir-soal-ujian') }}
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
                                </select>
                            </div>
                            <div class="col-xl-4">
                                <select name="soal_id" id="soal_id" class="form-control form-control-sm" required>
                                    <option value="">-- Soal --</option>
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
@include('admin.cbt.modals._butir-soal-ujian')
@include('admin.cbt.modals._preview-ujian')
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
        
            $('#order-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.e-learning.butir-soal') }}",
                    type: "GET",
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
        
            
        $('#add').on('click', function() {    
            $('.modal-title').html('Tambah Butir Soal Ujian');
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
        
    });
</script>
@endpush
