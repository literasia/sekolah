@extends('layouts.superadmin')

@section('title', 'Dashboard')
@section('title-2', 'Dashboard')
@section('title-3', 'Dashboard')
@section('describ')
    Ini adalah halaman dashboard awal untuk superadmin
@endsection
@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('superadmin.index') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tipe" role="tab">Tipe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kategori" role="tab">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#penulis-penerbit" role="tab">Penulis/Penerbit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tingkat" role="tab">Tingkat</a>
                    </li>
                </ul>
                <div class="tab-content modal-body">
                    {{-- Tipe --}}
                    <div class="tab-pane active" id="tipe" role="tabpanel">
                        @include('superadmin.library.tabs._tipe')
                    </div>

                    {{-- Kategori --}}
                    <div class="tab-pane" id="kategori" role="tabpanel">
                        @include('superadmin.library.tabs._kategori')
                    </div>

                    {{-- Penulis/Penerbit --}}
                    <div class="tab-pane" id="penulis-penerbit" role="tabpanel">
                        @include('superadmin.library.tabs._penulis-penerbit')
                    </div>

                    {{-- Tingkat --}}
                    <div class="tab-pane" id="tingkat" role="tabpanel">
                        @include('superadmin.library.tabs._tingkat')
                    </div>
                </div>
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
            $('#table-tipe').DataTable();
            $('#table-kategori').DataTable();
            $('#table-penulis-penerbit').DataTable();
            $('#table-tingkat').DataTable();

            $('#form-tipe').on('submit', function (event) {
                event.preventDefault();
                var url = '';

                if ($('#action').val() == 'add') {
                    url = "{{ route('superadmin.library-tipe') }}";
                }
                
                if ($('#action').val() == 'edit') {
                    url = "";
                }

                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            // for (var count = 0; count <= data.errors.length; count++) {
                            html = data.errors[0];
                            // }
                            $('#tipe').addClass('is-invalid');
                            toastr.error(html);
                        }

                        if (data.success) {
                            $('#tipe').removeClass('is-invalid');
                            $('#form-tipe')[0].reset();
                            $('#action').val('add');
                            $('#btn')
                                .removeClass('btn-outline-info')
                                .addClass('btn-outline-success')
                                .val('Simpan');
                            toastr.success(data.success);
                        }
                        $('#tipe_result').html(html);
                    }
                });
            });

            // $(document).on('click', '.edit', function () {
            //     var id = $(this).attr('id');
            //     $.ajax({
            //         url: '/superadmin/referensi/agama/'+id,
            //         dataType: 'JSON',
            //         success: function (data) {
            //             $('#agama').val(data.agama.name);
            //             $('#hidden_id').val(data.agama.id);
            //             $('#action').val('edit');
            //             $('#btn')
            //                 .removeClass('btn-outline-success')
            //                 .addClass('btn-outline-info')
            //                 .val('Update');
            //         }
            //     });
            // });

            // var user_id;
            // $(document).on('click', '.delete', function () {
            //     user_id = $(this).attr('id');
            //     $('#ok_button').text('Hapus');
            //     $('#confirmModal').modal('show');
            // });

            // $('#ok_button').click(function () {
            //     $.ajax({
            //         url: '/superadmin/referensi/agama/hapus/'+user_id,
            //         beforeSend: function () {
            //             $('#ok_button').text('Menghapus...');
            //         }, success: function (data) {
            //             setTimeout(function () {
            //                 $('#confirmModal').modal('hide');
            //                 $('#order-table').DataTable().ajax.reload();
            //                 toastr.success('Data berhasil dihapus');
            //             }, 1000);
            //         }
            //     });
            // });
        });
        toastr.options.timeOut = 1000;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            // this will be executed after fadeout, i.e. 2secs after notification has been show
            window.location.reload();
        };
    </script>
@endpush