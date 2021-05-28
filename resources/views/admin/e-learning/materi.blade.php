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
                <div class="card-block">
                    <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                    <div class="dt-responsive table-responsive mt-3">
                        <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Nama Guru</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
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


@include('admin.e-learning.modals._materi')
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
<script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script>
    $('document').ready(function() {
        var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
   
        $(".rotate-collapse").click(function() {
            $(".rotate").toggleClass("down"); 
        });
    })
</script>

<script>
    $(document).ready(function () {
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
            selector: '#materi',
        });

        $('#order-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.e-learning.materi') }}",
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
                data: 'kelas',
                name: 'kelas'
            },
            {
                data: 'guru',
                name: 'guru'
            },
            {
                data: 'materi',
                name: 'materi'
            },
            {
                data: 'tanggal_terbit',
                name: 'tanggal_terbit'
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
            $('.modal-title').html('Tambah Materi');
            $('#modal-materi').modal('show');
            $('.form-control').val('');
            tinymce.get('materi').setContent('');
            $('.modal-title').text('Tambah Materi');
            $('#action').val('add');
            $('#btn').removeClass('btn-info').addClass('btn-success').text('Simpan');
            $('#btn-cancel').removeClass('btn-outline-info').addClass('btn-outline-success').text('Batal');
        });

        $('#form-materi').on('submit', function (event) {
            event.preventDefault();
            var url = '';

            if ($('#action').val() == 'add') {
                url = "{{ route('admin.e-learning.materi.store') }}";
                text = "Data sukses ditambahkan";
            }

            if ($('#action').val() == 'edit') {
                url = "{{ route('admin.e-learning.materi.update') }}";
                text = "Data sukses diupdate";
            }

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
                success: function (data) {
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
                        $('#form-materi')[0].reset();
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
                        $('#modal-materi').modal('hide');
                    }
                    $('#form_result').html(html);
                }
            });
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

        $(document).on('click', '.edit', function () {
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url: '/admin/e-learning/materi/'+id,
                dataType: 'JSON',
                success: function (data) {
                    $('#judul').val(data.judul);
                    $('#mata_pelajaran_id').val(data.mata_pelajaran_id);
                    $('#kelas_id').val(data.kelas_id);
                    $('#guru_id').val(data.guru_id);
                    $('#materi').html(data.materi);
                    tinymce.get('materi').setContent(data.materi);

                    $(document).on('focusin', function(e) {
                        if ($(e.target).closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root, .wrs_modal_dialogContainer").length) {
                            e.stopImmediatePropagation();
                        }
                    });

                    $('#status').val(data.status);
                    $('#tanggal_terbit').val(data.tanggal_terbit);
                    $('#jam_terbit').val(data.jam_terbit);
                    $('#hidden_id').val(data.id);
                    $('#action').val('edit');
                    $('#btn')
                        .removeClass('btn-success')
                        .addClass('btn-info')
                        .val('Update');
                    $('#btn-cancel')
                        .removeClass('btn-outline-success')
                        .addClass('btn-outline-info')
                        .val('Batal');
                    $('#modal-materi').modal('show');
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
                url: '/admin/e-learning/materi/hapus/'+ user_id,
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
