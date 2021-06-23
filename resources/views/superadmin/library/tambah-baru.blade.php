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
@include('components.modals._confirm-delete-modal')
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
</script>
@endpush