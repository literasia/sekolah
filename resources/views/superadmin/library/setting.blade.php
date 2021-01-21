@extends('layouts.superadmin')

@section('title', 'Library Setting')
@section('title-2', 'Library Setting')
@section('title-3', 'Library Setting')
@section('describ')
    Ini adalah halaman library setting untuk superadmin
@endsection
@section('icon-l', 'icon-settings')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('superadmin.library-setting') }}
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

        #tambah-div {
            display: none;
        }
        
        #update-div, #batal {
            display: none;
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

            $('#tambah').on('click', function () {
                $('#tambah-div').toggle(500);
                if ($(this).text() == 'Tambah') {
                    $(this).text('Batal').removeClass('btn-primary').addClass('btn-danger');
                } else {
                    $(this).text('Tambah').removeClass('btn-danger').addClass('btn-primary');
                    $('#form-tipe')[0].reset();
                }
            });

            $('#batal').on('click', function () {
                $('#update-div').hide(500);
                $('#tambah').show();
                $('#batal').hide();
                $('#form-tipe-update')[0].reset();
                $('#form-tipe')[0].reset();
            });

            $(document).on('click', '#edit-tipe', function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: '/superadmin/library/setting/tipe/'+id,
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data.tipe.name);
                        $('#tipe-update').val(data.tipe.name);
                        $('#hidden_id').val(data.tipe.id);
                        $('#update-div').show(500);
                        $('#tambah-div').hide();
                        $('#tambah').hide();
                        $('#batal').show();
                    }
                });
            });

            var user_id;
            $(document).on('click', '#delete-tipe', function () {
                user_id = $(this).attr('data-id');
                $('#confirmModal').modal('show');
                $('#hidden').val(user_id);
            });

            @if (Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";
                switch (type) {
                    case 'info':
                        toastr.info("{{ Session::get('message') }}");
                        break;
                    
                    case 'warning':
                        toastr.warning("{{ Session::get('message') }}");
                        break;

                    case 'success':
                        toastr.success("{{ Session::get('message') }}");
                        break;

                    case 'error':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                }
            @endif
        });
    </script>
@endpush