@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Sekolah | Tahun Ajaran')
@section('title-2', 'Tahun Ajaran')
@section('title-3', 'Tahun Ajaran')

@section('describ')
    Ini adalah halaman tahun ajaran untuk admin
@endsection

@section('icon-l', 'fa fa-list-alt')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.sekolah.tahun-ajaran') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5>Tahun Ajaran</h5>
                </div>
                <div class="card-body" style="margin-top: -20px">
                    <div class="card-block">
                        <div class="row">
                            <div class="col">
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                  <input type="radio" class="btn-check" name="radioBtn" id="tahun_ajaran" autocomplete="off" {{ $tahun_ajaran[0]->tahun_ajaran=='Ganjil'?"checked":"" }} onclick="check('{{ $tahun_ajaran[0]->id }}', '#tahun_ajaran', 'tahun_ajaran');">
                                  <label for="Ganjil">Ganjil</label>

                                  <input type="radio" class="btn-check" name="radioBtn" id="tahun_ajaran" autocomplete="off" {{ $tahun_ajaran[0]->tahun_ajaran=='Genap'?"checked":"" }} onclick="check('{{ $tahun_ajaran[0]->id }}', '#tahun_ajaran', 'tahun_ajaran');">
                                  <label for="Genap">Genap</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                                <thead class="text-left">
                                    <tr>
                                        <th>No</th>
                                        <th>tahun_ajaran</th>
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
        </div> --}}
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
    <script>
        $(document).ready(function () {
            // $('#order-table').DataTable();
        });

        function check(id, id_check_form, structure){
            var isChecked = jQuery(id_check_form).is(":checked");
            $.ajax({
                url : "{{ route('admin.sekolah.tahun_ajaran-update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id,
                    isChecked,
                    structure
                }
           //      ,
           //      success : function(data){
                    // $(id_check_form).attr("checked", "checked");
           //      },
           //      error : function(jqXHR, errorThrown, textStatus){
                    // swal({
                    //  title: "Failed!",
                    //  text: "Gagal Mengubah Akses",
                    //  type: "error",
                    //  buttonsStyling: false,
                    //  confirmButtonClass: "btn btn-danger"
                    // }).then(function(){
                    //  location.reload();
                    // });
           //      }
        });
        
    }
    </script>
    {{-- <script>
        $(document).ready(function () {
            $('#order-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.sekolah.tahun_ajaran') }}",
                },
                columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action'
                }
                ]
            });

            $('#form-tahun_ajaran').on('submit', function (event) {
                event.preventDefault();

                var url = '';
                if ($('#action').val() == 'add') {
                    url = "{{ route('admin.sekolah.tahun_ajaran') }}";
                }

                if ($('#action').val() == 'edit') {
                    url = "{{ route('admin.sekolah.tahun_ajaran-update') }}";
                }

                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    success: function (data) {
                        var html = ''
                        if (data.errors) {
                            html = data.errors[0];
                            $('#tahun_ajaran').addClass('is-invalid');
                            toastr.error(html);
                        }

                        if (data.success) {
                            toastr.success('Sukses!');
                            $('#tahun_ajaran').removeClass('is-invalid');
                            $('#form-tahun_ajaran')[0].reset();
                            $('#action').val('add');
                            $('#btn')
                                .removeClass('btn-outline-info')
                                .addClass('btn-outline-success')
                                .val('Simpan');
                            $('#order-table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: '/admin/sekolah/tahun_ajaran/'+id,
                    dataType: 'JSON',
                    success: function (data) {
                        $('#tahun_ajaran').val(data.tahun_ajaran.name);
                        $('#hidden_id').val(data.tahun_ajaran.id);
                        $('#action').val('edit');
                        $('#btn')
                            .removeClass('btn-outline-success')
                            .addClass('btn-outline-info')
                            .val('Update');
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
                    url: '/admin/sekolah/tahun_ajaran/hapus/'+user_id,
                    beforeSend: function () {
                        $('#ok_button').text('Menghapus...');
                    }, success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            $('#order-table').DataTable().ajax.reload();
                            toastr.success('Data berhasil dihapus');
                        }, 1000);
                    }
                });
            });
        });
    </script> --}}
@endpush
