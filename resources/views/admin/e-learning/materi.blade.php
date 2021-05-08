@extends('layouts.admin')

@section('title', 'E-Learning | Materi')
@section('title-2', 'Materi')
@section('title-3', 'Materi')

@section('describ')
    Ini adalah halaman Materi untuk admin
@endsection

@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('admin.e-learning.materi') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-body">

                {{-- <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="materi">Materi</label>
                            <textarea name="materi" id="materi" cols="10" rows="3" class="form-control form-control-sm" placeholder="Keterangan" required></textarea>
                        </div>
                    </div>
                </div> --}}
                <div class="card-block">
                    <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                    <div class="dt-responsive table-responsive">
                        <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Nama Guru</th>
                                    <th>Materi</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mengidentifikasi Isi Pokok Cerita Hikayat dengan Bahasa Sendiri</td>
                                    <td>Bahasa Indonesia</td>
                                    <td>VII</td>
                                    <td>Mursilah</td>
                                    <td></td>
                                    <td><small>Telah Terbit, 2021/04/28 pukul 05:04 PM</small></td>
                                    <td><label class="badge badge-success">Diterbitkan</label></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Mengidentifikasi Ciri Teks Biografi Berdasarkan Isinya</td>
                                    <td>Bahasa Indonesia</td>
                                    <td>VII</td>
                                    <td>Mursilah</td>
                                    <td></td>
                                    <td><small>Diperbarui, 2021/04/28 pukul 05:04 PM</small></td>
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
@include('admin.e-learning.modals._materi')
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
</style>
@endpush

{{-- addons js --}}
@push('js')
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script type="text/javascript">
  
</script>
<script>
    $('document').ready(function() {
        $('#order-table').DataTable();

        tinymce.init({
            external_plugins: {
                'tiny_mce_wiris' : `{{ asset('assets/plugins/tinymce/plugins/tiny_mce_wiris/plugin.min.js') }}`,
            },
            selector: '#materi',
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
            $('.modal-title').html('Tambah Pesan');
            $('#judul').val('');
            $('#message').val('');
            $('#start_date').val('');
            $('#end_date').val('');
            $('#action').val('add');
            $('#button')
                .removeClass('btn-outline-success edit')
                .addClass('btn-outline-info add')
                .html('Simpan');
            $('#modal-materi').modal('show');
        });

        $(".rotate-collapse").click(function() {
            $(".rotate").toggleClass("down"); 
        });
    })
</script>
@endpush