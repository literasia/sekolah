@extends('layouts.superadmin')

{{-- config 1 --}}
@section('title', 'Keuangan | Keuangan')
@section('title-2', 'Keuangan')
@section('title-3', 'Keuangan')

@section('describ')
Ini adalah halaman keuangan untuk superadmin
@endsection

@section('icon-l', 'fa fa-book')
@section('icon-r', 'icon-home')

@section('link')
{{ route('superadmin.keuangan.keuangan') }}
@endsection

{{-- main content --}}
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-block">
                    <button id="add" class="btn btn-outline-primary shadow-sm"><i class="fa fa-plus"></i></button>
                    <div class="dt-responsive table-responsive mt-3">
                        <table id="keuangan-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead class="text-left">
                                <tr>
                                    <th>Nomor Tagihan</th>
                                    <th>Nomor Faktur</th>
                                    <th>Jenis Pesanan</th>
                                    <th>Deskripsi Barang</th>
                                    <th>NPWP</th>
                                    <th>Nama Sekolah</th>
                                    <th>Biaya</th>
                                    <th>Metode Pembayaran</th>
                                    <th>PPN 10%</th>
                                    <th>PPH 1.5%</th>
                                    <th>Siplah 2.5%</th>
                                    <th>Biaya</th>
                                    <th>Total Biaya</th>
                                    <th>Kepala Sekolah</th>
                                    <th>Bendahara</th>
                                    <th>Penerima</th>
                                    <th>Nama Pemesan</th>
                                    <th>Jabatan</th>
                                    <th>Hari</th>
                                    <th>Tanggal Berita Acara</th>
                                    <th>Tanggal Surat Pesanan</th>
                                    <th>Tanggal Tagihan</th>
                                    <th>Tanggal Faktur</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-left">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="dropdown no-arrow d-inline-block">
                                            <a class="dropdown-toggle btn btn-warning btn-mini" href="#" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="{{route('superadmin.keuangan.laporan-tagihan')}}" target="_blank">Cetak Tagihan</a>
                                                <a class="dropdown-item" href="{{route('superadmin.keuangan.laporan-faktur')}}" target="_blank">Cetak Faktur Penjualan</a>
                                                <a class="dropdown-item" href="{{route('superadmin.keuangan.laporan-berita-acara')}}" target="_blank">Cetak Berita Acara</a>
                                            </div>
                                        </div>
                                        <button class="btn btn-info btn-mini"><i class="fa fa-pencil-alt"></i></button>
                                        <button class="btn btn-danger btn-mini"><i class="fa fa-trash"></i></button>
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

{{-- Modal --}}
@include('superadmin.keuangan.modals._tambah-keuangan')
@endsection

{{-- addons css --}}
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<style>
    .dropdown.no-arrow .dropdown-toggle::after {
        display: none;
    }
    .dropdown-menu-right {
        left: 0!important;
        right: auto!important;
    }

    .btn i {
        margin-right: 0px!important;
    }

    .select2-container {
        width: 100% !important;
        padding: 0!important;
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
    $(document).ready(function() {
        $('#keuangan-table').DataTable();

        $('#tanggal_tagihan').dateDropper({
            theme: 'leaf',
            format: 'd-m-Y'
        });

        $('#tanggal_faktur').dateDropper({
            theme: 'leaf',
            format: 'd-m-Y'
        });

        $('#tanggal_berita_acara').dateDropper({
            theme: 'leaf',
            format: 'd-m-Y'
        });

        $('#add').on('click', function() {
            $('.modal-title').html('Tambah Data Keuangan');
            $('#btn')
                .removeClass('btn-info')
                .addClass('btn-success')
                .val('Simpan');
            $('#btn-cancel')
                .removeClass('btn-outline-info')
                .addClass('btn-outline-success')
                .val('Batal');
            $('#modal-keuangan').modal('show');
        });
    });
</script>
<script type="text/javascript">
    function calculate() {
        var biaya = document.getElementById('biaya').value;
        var ppn = 1.1;
        var pph = 1.015;
        // ].var siplah = 1.025;

        var ppn_result = parseFloat(biaya) / ppn;
        if (!isNaN(ppn_result)) {
           document.getElementById('ppn').value = ppn_result.toFixed(2);
        }

        var pph_result =  ppn_result / pph;
         if (!isNaN(pph_result)) {
           document.getElementById('pph').value = pph_result.toFixed(2);
        }
    }
</script>
@endpush