@extends('layouts.guru')

@section('title', 'E-Learning | Nilai Kuis')
@section('title-2', 'Nilai Kuis')
@section('title-3', 'Nilai Kuis')

@section('describ')
    Ini adalah halaman Nilai Kuis untuk Guru
@endsection

@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('guru.e-learning.nilai') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-block">
                    <h6>Filter</h6>
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-xl-4">
                                <select name="kuis_id" id="pilih" class="form-control form-control-sm">
                                    <option value="">-- Kuis --</option>
                                    @foreach ($kuis as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == $kuis_id)
                                                selected
                                            @endif>{{ $item->soal->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-4">
                                <select name="kelas_id" id="kelas_id" class="form-control form-control-sm" required>
                                    <option value="">-- Kelas --</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == $kelas_id)
                                                selected
                                            @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-2">
                                <input type="submit" value="Pilih" class="btn btn-block btn-sm btn-primary shadow-sm">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-block">
                    <div class="dt-responsive table-responsive mt-3">
                       <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>Jumlah Benar</th>
                                    <th>Jumlah Salah</th>
                                    <th>Nilai Pilihan Ganda</th>
                                    <th>Nilai Essai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Dina</td>
                                    <td class="text-center"><label class="badge badge-success py-2 px-3">45</label></td>
                                    <td class="text-center"><label class="badge badge-danger py-2 px-3">5</label></td>
                                    <td>70</td>
                                    <td><input type="number" class="col-8 form-control form-control-sm"></td>
                                    <td>
                                        <input type="button" class="btn btn-success btn-mini" value="Simpan">
                                        <button class="btn btn-warning btn-mini">Cek Essai</button>
                                    </td>
                                </tr>
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
    .modal-dialog {
        margin-bottom: 6rem!important;
    }
    .family-modal-wrapper {
        position: relative;
    }
    .family-modal-caption {
        position: absolute; 
        top: -35px; 
        left: 20px; 
        background: rgb(255 255 255 / 57%);
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
<script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
<script type="text/javascript">
    $('document').ready(function() {
        if(`{{ $kelas_id }}` != "" || `{{ $kuis_id }}` != ""){
            $('#order-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('guru.e-learning.nilai') }}",
                    type: "GET",
                    data: {
                        'kuis_id' : `{{ $kuis_id }}`,
                        'kelas_id' : `{{ $kelas_id }}`,
                    }
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'siswa',
                        name: 'siswa'
                    },
                    {
                        data: 'jumlah_benar'
                        name: 'jumlah_benar'
                    },
                    {
                        data: 'jumlah_salah',
                        name: 'jumlah_salah'
                    },
                    {
                        data: 'nilai_pilgan',
                        name: 'nilai_pilgan'
                    },
                    {
                        data: 'nilai_essai',
                        name: 'nilai_essai'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        }
    });
</script>
@endpush
