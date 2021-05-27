@extends('layouts.superadmin')

{{-- config 1 --}}
@section('title', 'Slider')
@section('title-2', 'Slider')
@section('title-3', 'Slider')

@section('describ')
Ini adalah halaman slider untuk Superadmin
@endsection

@section('icon-l', 'fa fa-images')
@section('icon-r', 'icon-home')

@section('link')
{{ route('superadmin.slider') }}
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
                        <table id="slider-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead class="text-left">
                                <tr>
                                    <th>No.</th>
                                    <th>Judul</th>
                                    <th>Foto</th>
                                    <th>Keterangan</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Kabupaten</th>
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

{{-- Modal --}}
@include('superadmin.modals._slider')
@endsection

{{-- addons css --}}
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('bower_components/select2/css/select2.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datedropper/css/datedropper.min.css') }}" />
<style>
    .btn i {
        margin-right: 0px;
    }

    .select2-container {
        width: 100% !important;
        padding: 0;
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
<script type="text/javascript" src="{{ asset('bower_components/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
<script>
    $(document).ready(function() {

        $('#add').on('click', function() {
            $('#modal-slider').modal('show');
        });

        $('#sekolah').select2();

        $('#start_date').dateDropper({
            theme: 'leaf',
            format: 'd-m-Y'
        });

        $('#end_date').dateDropper({
            theme: 'leaf',
            format: 'd-m-Y'
        });

        $('#slider-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('superadmin.slider') }}",
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
                    data: 'foto',
                    name: 'foto'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'kabupaten_kota_id',
                    name: 'kabupaten_kota_id'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
        });

        $("#kabupaten_kota").change(function() {
            _this = $(this);
            $.ajax({
                url: "{{ route('superadmin.referensi.kabupaten-kota-getSchools') }}",
                dataType: 'JSON',
                data: {
                    kabupaten_id: _this.val()
                },
                success: function(data) {
                    $("#sekolah").html("");
                    var options = "";
                    for (let key in data) {
                        options += `<option value="${data[key].id}">${data[key].name}</option>`;
                    }
                    $("#sekolah").html(options);
                }
            });
        });

        function getSekolahKabupaten(kabupaten_id, sekolah){
            $.ajax({
                url: "{{ route('superadmin.referensi.kabupaten-kota-getSchools') }}",
                dataType: 'JSON',
                data: {
                    kabupaten_id: kabupaten_id
                },
                success: function(data) {
                    $("#sekolah").html("");
                    var options = "";
                    for (let key in data) {
                        options += `<option value="${data[key].id}">${data[key].name}</option>`;
                    }
                    $("#sekolah").html(options);
                    
                    sekolah.forEach(item => {
                        $(`#sekolah option[value=${item.sekolah_id}]`).attr("selected","selected");
                    });
                }
            });
        }

        $('#form-slider').on('submit', function (e) {
            event.preventDefault();

            let url = '';
            if ($('#action').val() == 'add') {
                url = "{{ route('superadmin.slider.store') }}";
            }

            if ($('#action').val() == 'edit') {
                url = "{{ route('superadmin.slider.update') }}";
            }

            var formData = new FormData($('#form-slider')[0]);

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    let html = ''

                    // rules error message
                    if (data.error) {
                        data.errors.judul ? $('#judul').addClass('is-invalid') : $('#judul').removeClass('is-invalid');
                        data.errors.sekolah ? $('#sekolah').addClass('is-invalid') : $('#sekolah').removeClass('is-invalid');
                        data.errors.kabupaten_kota ? $('#kabupaten_kota').addClass('is-invalid') : $('#kabupaten_kota').removeClass('is-invalid');
                        data.errors.keterangan ? $('#keterangan').addClass('is-invalid') : $('#keterangan').removeClass('is-invalid');
                        data.errors.start_date ? $('#start_date').addClass('is-invalid') : $('#start_date').removeClass('is-invalid');
                        data.errors.end_date ? $('#end_date').addClass('is-invalid') : $('#end_date').removeClass('is-invalid');
                        toastr.error("data masih kosong");
                    }

                    // Succes
                    if (data.success) {
                        Swal.fire("Berhasil", data.success, "success");
                        $('#modal-slider').modal('hide');
                        $('#judul').removeClass('is-invalid');
                        $('#form-slider')[0].reset();
                        $('#action').val('add');
                        $('#btn')
                            .removeClass('btn-info')
                            .addClass('btn-success')
                            .val('Simpan');
                        $('#btn-cancel')
                            .removeClass('btn-outline-info')
                            .addClass('btn-outline-success')
                            .val('Batal');
                        $('#slider-table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                }
            });
        });

        $(document).on('click', '.edit', function () {
            let id = $(this).attr('id');
            $.ajax({
                url: '/superadmin/slider/edit/'+id,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $('#action').val('edit');
                    $('#btn').removeClass('btn-outline-success').addClass('btn-outline-info').val('Update');
                    $('#judul').val(data.judul);
                    $('#kabupaten_kota').val(data.kabupaten_kota_id);
                    getSekolahKabupaten(data.kabupaten_kota_id, data.sekolah);
                    $('#start_date').val(data.start_date);
                    $('#end_date').val(data.end_date);
                    $('#keterangan').val(data.keterangan);
                    $('#hidden_id').val(data.id);
                    $('#modal-slider').modal('show');
                }
            });
        });

        let user_id;
        $(document).on('click', '.delete', function() {
            user_id = $(this).attr('id');
            $('#ok_button').text('Hapus');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function() {
            $.ajax({
                url: '/superadmin/slider/' + user_id,
                beforeSend: function() {
                    $('#ok_button').text('Menghapus...');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('#slider-table').DataTable().ajax.reload();
                        Swal.fire("Berhasil", data.success, "success");
                    }, 1000);
                }
            });
        });

    });
</script>
@endpush