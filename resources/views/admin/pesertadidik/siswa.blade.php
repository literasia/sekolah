@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Peserta Didik | Siswa')
@section('title-2', 'Siswa')
@section('title-3', 'Siswa')

@section('describ')
    Ini adalah halaman siswa untuk admin
@endsection

@section('icon-l', 'icon-people')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.pesertadidik.siswa.index') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table id="siswa-table" class="table table-striped table-bordered nowrap shadow-sm">
                                <thead class="text-left">
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama Lengkap</th>
                                        <th>Kelas</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Poin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-left">
                                    @forelse($siswas as $siswa)
                                        <tr>
                                            <td>{{ $siswa->nis }}</td>
                                            <td>{{ $siswa->nama_lengkap }}</td>
                                            <td>{{ $siswa->kelas->name }}</td>
                                            <td>{{ $siswa->jk }}</td>
                                            <td>{{ $siswa->alamat }}</td>

                                            <td>{{ $siswa->poin_sp}}</td>
                                            <td>
                                                <button type="button" class="btn btn-mini btn-info shadow-sm">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </button>
                                                &nbsp;&nbsp;
                                                <button type="button" class="btn btn-mini btn-danger shadow-sm" 
                                                    data-url="{{ route('admin.pesertadidik.siswa.destroy', $siswa->id) }}" 
                                                    data-toggle="modal" data-target="#confirmDeleteModal">
                                                        <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @include('admin.pesertadidik.modals._siswa')
    @include('components.modals._confirm-delete-modal')
@endsection

{{-- addons css --}}
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <link href="{{ asset('assets/pages/jquery.filer/css/jquery.filer.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datedropper/css/datedropper.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/switchery/css/switchery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <style>
        .btn i {
            margin-right: 0px;
        }
    </style>
@endpush

{{-- addons javascript --}}
@push('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/pages/file-upload/dropzone-amd-module.min.js') }}"></script>
    <script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
    <script src="{{ asset('bower_components/switchery/js/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/pages/advance-elements/swithces.js') }}"></script>
    <script>
        const confirmDeleteModal = document.getElementById('confirmDeleteModal');
        const dateOptions = {
            theme: 'leaf',
            format: 'd-m-Y'
        };

        $(document).ready(function () {
            try {
                $('#siswa-table').DataTable();
            } catch (error) {
            }

            $('#dropper-default').dateDropper(dateOptions);

            $('#tanggal_lahir').dateDropper(dateOptions);

            $('#tanggal_lahir_ayah').dateDropper(dateOptions);

            $('#tanggal_lahir_ibu').dateDropper(dateOptions);

            $('#tanggal_lahir_wali').dateDropper(dateOptions);

            $('#add').on('click', function () {
                $('#modal-siswa').modal('show');
            });
        });
        
        $("#confirmDeleteModal").on('shown.bs.modal', function(e) {
            const url = $(e.relatedTarget).data('url');
            const form = confirmDeleteModal.querySelector('#deleteForm');
            form.action = url;
        });

        const createForm = (e) => {
            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("password_confirmation");
            let errMsg;

            if (password.value != confirmPassword.value) {
                errMsg = 'Maaf, konfirmasi password belum sama pada data login siswa';
            } else if (password.value.length < 6) {
                errMsg = 'Password min. 6 karakter';
            }

            if (errMsg) {
                toastr.error(errMsg);
                e.preventDefault();
                return false;
            }
        }

        document.addEventListener('submit', (e) => {
            const id = e.target.id;
            switch(e.target.id) {
                case "createForm": createForm(e); break;
            }
        });
    </script>
@endpush