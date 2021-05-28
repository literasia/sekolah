@extends('layouts.superadmin')

@section('title', 'List Sekolah')
@section('title-2', 'List Sekolah')
@section('title-3', 'List Sekolah')
@section('describ')
    Ini adalah halaman list sekolah untuk superadmin
@endsection
@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('superadmin.list-sekolah') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            {{-- <div class="card-header">
                <h5>List Sekolah</h5>
            </div> --}}
            <div class="card-body">
                <div class="card-block">
                    <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                    <div class="dt-responsive table-responsive mt-3">
                        <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID Sekolah</th>
                                    <th>Nama Sekolah</th>
                                    <th>Jenjang</th>
                                    <th>T. A</th>
                                    <th>Alamat</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
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
@include('superadmin.modals._tambah-sekolah')

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
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <style>
        .btn i {
            margin-right: 0px;
        }
        .checkbox {
            position: absolute;
            left: 15px;
            cursor: pointer;
        }
        .add-ons-icon {
            font-size: 16pt!important;
            color: #e14293;
        }
        .card-hover:hover {
            background: rgba(45,155,219,0.21);
            color: #e14293;
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
    <script>
        $(document).ready(function () {
            $('#order-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('superadmin.list-sekolah') }}",
                },
                columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'id_sekolah',
                    name: 'id_sekolah'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'jenjang',
                    name: 'jenjang'
                },
                {
                    data: 'tahun_ajaran',
                    name: 'tahun_ajaran'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'provinsis',
                    name: 'provinsi'
                },
                {
                    data: 'kabupatens',
                    name: 'kabupaten'
                },
                {
                    data: 'action',
                    name: 'action'
                }
                ],
                columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: 5
                }
                ]
            });
            $("#provinsi").change(function(){
                _this = $(this);
                $.ajax({
                    url: '{{ route('superadmin.referensi.provinsi-getKabupatenKota') }}',
                    dataType: 'JSON',
                    data: {provinsi_id:_this.val()},
                    success: function (data) {
                        $("#kabupaten").html("");
                        var options = "";
                        for (let key in data) {
                            options += `<option value="${data[key].id}">${data[key].name}</option>`;
                        }
                        $("#kabupaten").html(options);
                    }
                });
            });
            $('#btn-cancel').on('click', function () {
                $('#form-sekolah')[0].reset();
                $('#btn').removeClass('btn-info').addClass('btn-success').text('Simpan');
                $('#btn-cancel').removeClass('btn-outline-info').addClass('btn-outline-success').text('Batal');
            });
            $('.close').on('click', function () {
                $('#form-sekolah')[0].reset();
                $('#btn').removeClass('btn-info').addClass('btn-success').text('Simpan');
                $('#btn-cancel').removeClass('btn-outline-info').addClass('btn-outline-success').text('Batal');
            });
            $('#add').on('click', function () {
                $('#password-lama-group').css('display', 'none');
                $('#password-baru-group').css('display', 'none');
                $('#password-konfirmasi-group').css('display', 'none');
                $('#modal-sekolah').modal('show');
                $('.form-control').val('');
                // console.log($('.add-ons-icon').children()[0]);
                $('.modal-title').text('Tambah Sekolah');
                $('#username').attr('readonly', false);
                $('#password').attr('readonly', false);
                $('#action').val('add');
                $('#btn').removeClass('btn-info').addClass('btn-success').text('Simpan');
                $('#btn-cancel').removeClass('btn-outline-info').addClass('btn-outline-success').text('Batal');
            });
            $('#form-sekolah').on('submit', function (e) {
                event.preventDefault();
                if ($('#action').val() == 'add') {
                    url = "{{ route('superadmin.list-sekolah.store') }}";
                }
                if ($('#action').val() == 'edit') {
                    url = "{{ route('superadmin.list-sekolah-update') }}";
                }
                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    
                    success: function (data) {
                        var html = '';
                        // old password error message
                        if (data.error_old_password) {
                            $('#password_lama').addClass('is-invalid');
                            $('#old-password-message').html('password lama tidak sama');
                        }
                        // rules error message
                        if (data.error) {
                            data.errors.name ? $('#name').addClass('is-invalid') : $('#name').removeClass('is-invalid');
                            data.errors.id_sekolah ? $('#id_sekolah').addClass('is-invalid') : $('#id_sekolah').removeClass('is-invalid');
                            data.errors.jenjang ? $('#jenjang').addClass('is-invalid') : $('#jenjang').removeClass('is-invalid');
                            data.errors.tahun_ajaran ? $('#tahun_ajaran').addClass('is-invalid') : $('#tahun_ajaran').removeClass('is-invalid');
                            data.errors.alamat ? $('#alamat').addClass('is-invalid') : $('#name').removeClass('is-invalid');
                            data.errors.provinsi ? $('#provinsi').addClass('is-invalid') : $('#provinsi').removeClass('is-invalid');
                            data.errors.kabupaten ? $('#kabupaten').addClass('is-invalid') : $('#kabupaten').removeClass('is-invalid');
                            data.errors.username ? $('#username').addClass('is-invalid') : $('#username').removeClass('is-invalid');
                            data.errors.password ? $('#password').addClass('is-invalid') : $('#password').removeClass('is-invalid');
                            toastr.error("data masih kosong");
                        }
                        // success error message
                        if (data.success) {
                            Swal.fire("Berhasil", data.success, "success");
                            $('#modal-sekolah').modal('hide');
                            $('#id_sekolah').removeClass('is-invalid');
                            $('#name').removeClass('is-invalid');
                            $('#jenjang').removeClass('is-invalid');
                            $('#tahun_ajaran').removeClass('is-invalid');
                            $('#alamat').removeClass('is-invalid');
                            $('#provinsi').removeClass('is-invalid');
                            $('#kabupaten').removeClass('is-invalid');
                            $('#username').removeClass('is-invalid');
                            $('#password').removeClass('is-invalid');
                            $('#form-sekolah')[0].reset();
                            $('#action').val('add');
                            $('#btn').removeClass('btn-info').addClass('btn-success').text('Simpan');
                            $('#btn-cancel').removeClass('btn-outline-info').addClass('btn-outline-success').text('Batal');
                            $('#order-table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            });
            $(document).on('click', '.edit', function () {
                console.log('tes123');
                var id = $(this).attr('id');
                $.ajax({
                    url: '/superadmin/list-sekolah/'+id,
                    dataType: 'JSON',
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');

                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    success: function (data) {
                        $('#action').val('edit');
                        $('#btn').removeClass('btn-success').addClass('btn-info').val('Update');
                        $('#btn-cancel').removeClass('btn-outline-success').addClass('btn-outline-info').text('Batal');
                        $('#id_sekolah').val(data.id_sekolah);
                        $('#name').val(data.name);
                        $('#jenjang').val(data.jenjang);
                        $('#tahun_ajaran').val(data.tahun_ajaran);
                        $('#alamat').val(data.alamat);
                        $('#provinsi').val(data.provinsi);
                        $('#kabupaten').val(data.kabupaten);
                        // add ons
                        data.dashboard == 1 ? $('#dashboard').prop('checked', true) : $('#dashboard').prop('checked', false);
                        data.sekolah == 1 ? $('#sekolah').prop('checked', true) : $('#sekolah').prop('checked', false);
                        data.referensi == 1 ? $('#referensi').prop('checked', true) : $('#referensi').prop('checked', false);
                        data.fungsionaris == 1 ? $('#fungsionaris').prop('checked', true) : $('#fungsionaris').prop('checked', false);
                        data.pelajaran == 1 ? $('#pelajaran').prop('checked', true) : $('#pelajaran').prop('checked', false);
                        data.peserta_didik == 1 ? $('#peserta_didik').prop('checked', true) : $('#peserta_didik').prop('checked', false);
                        data.absensi == 1 ? $('#absensi').prop('checked', true) : $('#absensi').prop('checked', false);
                        data.e_learning == 1 ? $('#e_learning').prop('checked', true) : $('#e_learning').prop('checked', false);
                        data.daftar_nilai == 1 ? $('#daftar_nilai').prop('checked', true) : $('#daftar_nilai').prop('checked', false);
                        data.e_rapor == 1 ? $('#e_rapor').prop('checked', true) : $('#e_rapor').prop('checked', false);
                        data.pelanggaran == 1 ? $('#pelanggaran').prop('checked', true) : $('#pelanggaran').prop('checked', false);
                        data.e_voting == 1 ? $('#e_voting').prop('checked', true) : $('#e_voting').prop('checked', false);
                        data.kalender == 1 ? $('#kalender').prop('checked', true) : $('#kalender').prop('checked', false);
                        data.import == 1 ? $('#import').prop('checked', true) : $('#import').prop('checked', false);
                        data.perpustakaan == 1 ? $('#perpustakaan').prop('checked', true) : $('#perpustakaan').prop('checked', false);
                        data.pelanggaran == 1 ? $('#pelanggaran').prop('checked', true) : $('#pelanggaran').prop('checked', false);
                        data.leaderboard == 1 ? $('#leaderboard').prop('checked', true) : $('#leaderboard').prop('checked', false);
                        data.forum == 1 ? $('#forum').prop('checked', true) : $('#forum').prop('checked', false);
                        $('#password-lama-group').css('display', 'block');
                        $('#password-baru-group').css('display', 'block');
                        $('#password-konfirmasi-group').css('display', 'block');
                        $('#default-password-group').css('display', 'none');
                        
                        $('#hidden_id').val(data.id);
                        $('#username').val(data.username).attr('readonly', true);
                        $('#password').val(data.password).attr('readonly', true);
                        $('#modal-sekolah').modal('show');
                    }
                });
            });
            var user_id;
            $(document).on('click', '.delete', function () {
                user_id = $(this).attr('id');
                $('#ok_button').text('Hapus');
                $('#confirmModal').modal('show');
            });
            $('#ok_button').click(function () {
                $.ajax({
                    url: '/superadmin/list-sekolah/hapus/'+user_id,
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