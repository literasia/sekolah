@extends('layouts.superadmin')

@section('title', 'Library')
@section('title-2', 'Library')
@section('title-3', 'Library')
@section('describ')
Ini adalah halaman library untuk superadmin
@endsection
@section('icon-l', 'icon-book-open')
@section('icon-r', 'icon-home')
@section('link')
{{ route('superadmin.library.index') }}
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
                                    <th>Kategori</th>
                                    <th>Tingkat</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Status</th>
                                    <th>Actions</th>
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

{{-- Modal --}}
@include('superadmin.modals._tambah-baru')
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
<link rel="stylesheet" href="{{ asset('bower_components/select2/css/select2.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datedropper/css/datedropper.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
<style>
    .btn i {
        margin-right: 0px;
    }
    .select2-container {
        width: 100% !important;
        padding: 0;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        background-color: transparent; 
        color: #000;
        padding: 0px 30px 0px 10px; 
    }
</style>
@endpush

{{-- addons js --}}
@push('js')
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#nama_sekolah').select2();

        $('#order-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('superadmin.library.index') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'sub_kategori',
                    name: 'sub_kategori'
                },
                {
                    data: 'tingkat',
                    name: 'tingkat'
                },
                {
                    data: 'penulis',
                    name: 'penulis'
                },
                {
                    data: 'penerbit',
                    name: 'penerbit'
                },
                {
                    data: 'tahun_terbit',
                    name: 'tahun_terbit'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
            columnDefs: [{
                render: function(data, type, full, meta) {
                    return "<div class='text-wrap width-200'>" + data + "</div>";
                },
                targets: 2
            }],
        });

        $('#add').on('click', function() {
            $("#action").val("add")
            $('#modal-title').html('Tambah Buku');
            $('.form-control').val('');
            $('#btn').html('Simpan');
            $('#btn').removeClass('btn-info').addClass('btn-success').text('Simpan');
            $('#modal-library').modal('show');
        });
    });

    $('#unit').change(function () {
        if($(this).val() == 'umum') {
            $('#row-kelas').hide(); 
            $('#row-unit').removeClass('col-xl-6');
            $('#row-unit').removeClass('col-lg-6');
        }
        else {
            $('#row-kelas').show(); 
            $('#row-unit').addClass('col-xl-6');
            $('#row-unit').addClass('col-lg-6');
        }
    });

    $("#confirmDeleteModal").on('shown.bs.modal', function(e) {
        const url = $(e.relatedTarget).data('url');
        const form = confirmDeleteModal.querySelector('#deleteForm');
        form.action = url;
    });

    $(document).on('click', '.edit', function () {
            var id = $(this).attr('id');
            $.ajax({
                url: 'library/show/'+id,
                dataType: 'JSON',
                success: function (data) {
                    $('#modal-title').html('Edit Buku');
                    $('#action').val('edit');
                    $('#btn').removeClass('btn-success').addClass('btn-info').text('Update');
                    $('#btn-cancel').removeClass('btn-outline-success').addClass('btn-outline-info').text('Batal');
                    $('#name').val(data.library.name);
                    $('#sekolah_id').val(data.library.sekolah_id);
                    $('#sub_kategori_id').val(data.library.sub_kategori_id);
                    $('#tingkat_id').val(data.library.tingkat_id);
                    $('#link_audio').val(data.library.link_audio);
                    $('#link_ebook').val(data.library.link_ebook);
                    $('#link_video').val(data.library.link_video);
                    $('#deskripsi').val(data.library.Deskripsi);
                    $('#penulis_id').val(data.library.penulis_id);
                    $('#penerbit_id').val(data.library.penerbit_id);
                    $('#tahun_terbit').val(data.library.tahun_terbit); 
                    $('#hidden_id').val(data.library.id);
                    $('#modal-library').modal('show');
                }
            });
        });

        let user_id;
        $(document).on('click', '.delete', function () {
            user_id = $(this).attr('id');
            $('#ok_button').text('Hapus');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function () {
            $.ajax({
                url: 'library/delete/'+user_id,
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


        $('#form-library').on('submit', function (e) {
            event.preventDefault();
            let url;
            var text = "Data sukses ditambahkan";

            if ($('#action').val() == 'add') {
                url = "{{ route('superadmin.library.store') }}";
                text = "Data sukses ditambahkan";
            }

            if ($('#action').val() == 'edit') {
                url = "{{ route('superadmin.library.update') }}";
                text = "Data sukses diupdate";
            }

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
                success: function (data) {
                    var html = '';
                    // rules error message.
                    if (data.error) {
                        console.log(data)
                        data.errors.name ? $('#name').addClass('is-invalid') : $('#name').removeClass('is-invalid');
                        data.errors.tingkat_id ? $('#tingkat_id').addClass('is-invalid') : $('#tingkat_id').removeClass('is-invalid');
                        data.errors.sub_kategori_id ? $('#sub_kategori_id').addClass('is-invalid') : $('#sub_kategori_id').removeClass('is-invalid');
                        data.errors.tahun_terbit ? $('#tahun_terbit').addClass('is-invalid') : $('#tahun_terbit').removeClass('is-invalid');
                        data.errors.penulis_id ? $('#penulis_id').addClass('is-invalid') : $('#penulis_id').removeClass('is-invalid');
                        data.errors.penerbit_id ? $('#penerbit_id').addClass('is-invalid') : $('#penerbit_id').removeClass('is-invalid');

                        toastr.error("data masih kosong");
                    }

                    // success error message
                    if (data.success) { 
                        Swal.fire("Berhasil", text, "success");
                        $('#modal-library').modal('hide');
                        $('.form-control').removeClass('is-invalid');
                        $('#form-library')[0].reset();
                        $('#action').val('add');
                        $('#btn').removeClass('btn-info').addClass('btn-success').text('Simpan');
                        $('#btn-cancel').removeClass('btn-outline-info').addClass('btn-outline-success').text('Batal');
                        $('#order-table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                }
            });
        }); 

        
</script>
@endpush