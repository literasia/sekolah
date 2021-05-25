@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Fungsionaris | Pegawai')
@section('title-2', 'Pegawai')
@section('title-3', 'Pegawai')

@section('describ')
    Ini adalah halaman pegawai untuk admin
@endsection

@section('icon-l', 'icon-people')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.fungsionaris.pegawai') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="card-block">
                        <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                        <div class="dt-responsive table-responsive mt-3">
                            <table id="pegawai-table" class="table table-striped table-bordered nowrap shadow-sm">
                                <thead class="text-left">
                                    <tr>
                                        <th>No.</th>
                                        <th>NIP</th>
                                        <th>Nama Lengkap</th>
                                        <th>No. HP</th>
                                        <th>Alamat</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-left">
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @include('admin.fungsionaris.modals._pegawai')
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
    <script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>

    <script>
        const dateOptions = {
            theme: 'leaf',
            format: 'd-m-Y'
        };

        $(document).ready(function () {
            $('#pegawai-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.fungsionaris.pegawai') }}",
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'no_telepon',
                        name: 'no_telepon'
                    },
                    {
                        data: 'alamat_tinggal',
                        name: 'alamat_tinggal'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
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
                        $("#kabupaten").change();
                    }
                });
            });

            $("#kabupaten").change(function(){
                _this = $(this);
                $.ajax({
                    url: '{{ route('superadmin.referensi.kabupaten-kota-getKecamatans') }}',
                    dataType: 'JSON',
                    data: {kabupaten_kota_id:_this.val()},
                    success: function (data) {
                        $("#kecamatan").html("");
                        var options = "";
                        for (let key in data) {
                            options += `<option value="${data[key].id}">${data[key].name}</option>`;
                        }
                        $("#kecamatan").html(options);
                    }
                });
            });

            $('#add').on('click', function () {
                $('#form-pegawai')[0].reset();
                $('#action').val('add');
                $('#name').val('');
                $('#nik').val('');
                $('#nip').val('');
                $('#agama').val('');
                $('#alamat_tinggal').val('');
                $('#bagian_pegawai_id').val('');
                $('#dusun').val('');
                $('#email').val('');
                $('#gelar_belakang').val('');
                $('#gelar_depan').val('');
                $('#is_menikah').val('');
                $('#jenjang').val('');
                $('#jk').val('');
                $('#provinsi').val('');
                $("#provinsi").change();
                $('#kabupaten').val('');
                $('#kecamatan').val('');
                $('#kode_pos').val('');
                $('#no_telepon').val('');
                $('#no_telepon_rumah').val('');
                $('#rt').val('');
                $('#rw').val('');
                $('#tahun_ajaran').val('');
                $('#tanggal_mulai').val('');
                $('#tempat_lahir').val('');
                $('#tanggal_lahir').val('');
                $('#semester').val('');
                $('#default-password-group').css('display', 'block');
                $('#username').attr('readonly', false);
                $('#password').attr('readonly', false);
                $('#password-lama-group').css('display', 'none');
                $('#password-baru-group').css('display', 'none');
                $('#password-konfirmasi-group').css('display', 'none');
                $('#hidden_id').val('');
                $('#btn').removeClass('btn-info').addClass('btn-success').text('Simpan');
                $('#btn-cancel').removeClass('btn-outline-info').addClass('btn-outline-success').text('Batal');
                $('#modal-pegawai').modal('show');
            });

            $('#tanggal_lahir').dateDropper(dateOptions);
            $('#tanggal_mulai').dateDropper(dateOptions);
        });

        $('#form-pegawai').on('submit', function (e) {
            event.preventDefault();

            let url;
            var text = "Data sukses ditambahkan";

            if ($('#action').val() == 'add') {
                url = "{{ route('admin.fungsionaris.pegawai.store') }}";
                text = "Data sukses ditambahkan";
            }

            if ($('#action').val() == 'edit') {
                url = "{{ route('admin.fungsionaris.pegawai.update') }}";
                text = "Data sukses diupdate";
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
                        data.errors.nik ? $('#nik').addClass('is-invalid') : $('#nik').removeClass('is-invalid');
                        data.errors.nip ? $('#nip').addClass('is-invalid') : $('#nip').removeClass('is-invalid');
                        data.errors.agama ? $('#agama').addClass('is-invalid') : $('#agama').removeClass('is-invalid');
                        data.errors.alamat_tinggal ? $('#alamat_tinggal').addClass('is-invalid') : $('#alamat_tinggal').removeClass('is-invalid');
                        data.errors.bagian ? $('#bagian').addClass('is-invalid') : $('#bagian').removeClass('is-invalid');
                        data.errors.dusun ? $('#dusun').addClass('is-invalid') : $('#dusun').removeClass('is-invalid');
                        data.errors.email ? $('#email').addClass('is-invalid') : $('#email').removeClass('is-invalid');
                        data.errors.gelar_depan ? $('#gelar_depan').addClass('is-invalid') : $('#gelar_depan').removeClass('is-invalid');
                        data.errors.gelar_belakang ? $('#gelar_belakang').addClass('is-invalid') : $('#gelar_belakang').removeClass('is-invalid');
                        data.errors.is_menikah ? $('#is_menikah').addClass('is-invalid') : $('#is_menikah').removeClass('is-invalid');
                        data.errors.jenjang ? $('#jenjang').addClass('is-invalid') : $('#jenjang').removeClass('is-invalid');
                        data.errors.jk ? $('#jk').addClass('is-invalid') : $('#jk').removeClass('is-invalid');
                        data.errors.provinsi ? $('#provinsi').addClass('is-invalid') : $('#provinsi').removeClass('is-invalid');
                        data.errors.kabupaten ? $('#kabupaten').addClass('is-invalid') : $('#kabupaten').removeClass('is-invalid');
                        data.errors.kecamatan ? $('#kecamatan').addClass('is-invalid') : $('#kecamatan').removeClass('is-invalid');
                        data.errors.kode_pos ? $('#kode_pos').addClass('is-invalid') : $('#kode_pos').removeClass('is-invalid');
                        data.errors.no_telepon ? $('#no_telepon').addClass('is-invalid') : $('#no_telepon').removeClass('is-invalid');
                        data.errors.no_telepon_rumah ? $('#no_telepon_rumah').addClass('is-invalid') : $('#no_telepon_rumah').removeClass('is-invalid');
                        data.errors.rt ? $('#rt').addClass('is-invalid') : $('#rt').removeClass('is-invalid');
                        data.errors.rw ? $('#rw').addClass('is-invalid') : $('#rw').removeClass('is-invalid');
                        data.errors.tahun_ajaran ? $('#tahun_ajaran').addClass('is-invalid') : $('#tahun_ajaran').removeClass('is-invalid');
                        data.errors.tanggal_mulai ? $('#tanggal_mulai').addClass('is-invalid') : $('#tanggal_mulai').removeClass('is-invalid');
                        data.errors.tanggal_lahir ? $('#tanggal_lahir').addClass('is-invalid') : $('#tanggal_lahir').removeClass('is-invalid');
                        data.errors.tempat_lahir ? $('#tempat_lahir').addClass('is-invalid') : $('#tempat_lahir').removeClass('is-invalid');
                        data.errors.semester ? $('#semester').addClass('is-invalid') : $('#semester').removeClass('is-invalid');
                        toastr.error("data masih kosong");
                    }

                    // success error message
                    if (data.success) {
                        Swal.fire("Berhasil", text, "success");
                        $('#modal-pegawai').modal('hide');
                        $('.form-control').removeClass('is-invalid');
                        $('#form-pegawai')[0].reset();
                        $('#action').val('add');
                        $('#btn').removeClass('btn-info').addClass('btn-success').text('Simpan');
                        $('#btn-cancel').removeClass('btn-outline-info').addClass('btn-outline-success').text('Batal');
                        $('#pegawai-table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                }
            });
        });

        $(document).on('click', '.edit', function () {
            var id = $(this).attr('id');
            $.ajax({
                url: '/admin/fungsionaris/pegawai/edit/'+id,
                dataType: 'JSON',
                success: function (data) {
                        $('#action').val('edit');
                        $('#btn').removeClass('btn-success').addClass('btn-info').text('Update');
                        $('#btn-cancel').removeClass('btn-outline-success').addClass('btn-outline-info').text('Batal');
                        $('#name').val(data.name);
                        $('#nik').val(data.nik);
                        $('#nip').val(data.nip);
                        $('#agama').val(data.agama);
                        $('#alamat_tinggal').val(data.alamat_tinggal);
                        $('#bagian_pegawai_id').val(data.bagian_pegawai_id);
                        $('#dusun').val(data.dusun);
                        $('#email').val(data.email);
                        $('#gelar_belakang').val(data.gelar_belakang);
                        $('#gelar_depan').val(data.gelar_depan);
                        $('#is_menikah').val(data.is_menikah);
                        $('#jenjang').val(data.jenjang);
                        $('#jk').val(data.jk);
                        $('#provinsi').val(data.provinsi_id);
                        // Auto Change Provinsi
                        $("#provinsi").change();
                        $('#kabupaten').val(data.kabupaten_kota_id);
                        $('#kecamatan').val(data.kecamatan_id);
                        $('#kode_pos').val(data.kode_pos);
                        $('#no_telepon').val(data.no_telepon);
                        $('#no_telepon_rumah').val(data.no_telepon_rumah);
                        $('#rt').val(data.rt);
                        $('#rw').val(data.rw);
                        $('#tahun_ajaran').val(data.tahun_ajaran);
                        $('#tanggal_mulai').val(data.tanggal_mulai);
                        $('#tempat_lahir').val(data.tempat_lahir);
                        $('#tanggal_lahir').val(data.tanggal_lahir);
                        $('#semester').val(data.semester);

                        $('#password-lama-group').css('display', 'block');
                        $('#password-baru-group').css('display', 'block');
                        $('#password-konfirmasi-group').css('display', 'block');
                        $('#default-password-group').css('display', 'none');
                        
                        $('#hidden_id').val(data.id);
                        $('#username').val(data.username).attr('readonly', true);
                        $('#password').val(data.password).attr('readonly', true);
                        $('#modal-pegawai').modal('show');
                    }
                });
            });

            let user_id;
            $(document).on('click', '.delete', function () {
                console.log(user_id)
                user_id = $(this).attr('id');
                $('#ok_button').text('Hapus');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function () {
                $.ajax({
                    url: '/admin/fungsionaris/pegawai/delete/'+user_id,
                    beforeSend: function () {
                        $('#ok_button').text('Menghapus...');
                    }, success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            $('#pegawai-table').DataTable().ajax.reload();
                            Swal.fire("Berhasil", "Data dihapus!", "success");
                        }, 1000);
                    }
                });
            });

    </script>
@endpush
