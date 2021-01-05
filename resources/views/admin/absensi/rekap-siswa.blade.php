@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Absensi | Rekap Siswa')
@section('title-2', 'Rekap Siswa')
@section('title-3', 'Rekap Siswa')

@section('describ')
    Ini adalah halaman rekap siswa untuk admin
@endsection

@section('icon-l', 'fa fa-clipboard-check')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.absensi.rekap-siswa') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="card-block">
                        <h6>Pilih Kelas</h6>
                        <form action="">
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
                                    <select name="pilih" id="pilih" class="form-control form-control-sm">
                                        <option value="">-- Kelas --</option>
                                        <option value="X TKJ">X TKJ</option>
                                        <option value="X OTKP">X OTKP</option>
                                        <option value="X MM">X MM</option>
                                        <option value="XI TKJ">XI TKJ</option>
                                        <option value="XI OTKP">XI OTKP</option>
                                        <option value="XI MM">XI MM</option>
                                        <option value="XII TKJ">XII TKJ</option>
                                        <option value="XII OTKP">XII OTKP</option>
                                        <option value="XII MM">XII MM</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
                                    <input type="text" name="tanggal_mulai" id="tanggal_mulai" class="form-control form-control-sm" placeholder="Start Date" readonly>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
                                    <input type="text" name="tanggal_selesai" id="tanggal_selesai" class="form-control form-control-sm" placeholder="End Date" readonly>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                                    <input type="submit" value="Pilih" class="btn btn-block btn-sm btn-primary shadow-sm">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                                <thead class="text-left">
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th>Kelas</th>
                                        <th>H</th>
                                        <th>A</th>
                                        <th>S</th>
                                        <th>I</th>
                                        <th>Lainnya</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-left">
                                    <tr>
                                        <td>Afifah Sakinah</td>
                                        <td>XI MM</td>
                                        <td>2 <span class="text-danger">(0,55 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td><button class="btn btn-success shadow-sm nobradius" type="button" disabled>Cetak</button></td>
                                    </tr>
                                    <tr>
                                        <td>Aidil Syahputra</td>
                                        <td>XI MM</td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>2 <span class="text-danger">(0,55 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td><button class="btn btn-success shadow-sm nobradius" type="button" disabled>Cetak</button></td>
                                    </tr>
                                    <tr>
                                        <td>Apfis Satria</td>
                                        <td>XI MM</td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>2 <span class="text-danger">(0,55 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td><button class="btn btn-success shadow-sm nobradius" type="button" disabled>Cetak</button></td>
                                    </tr>
                                    <tr>
                                        <td>Azzahra Putri Hermaya</td>
                                        <td>XI MM</td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>2 <span class="text-danger">(0,55 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td><button class="btn btn-success shadow-sm nobradius" type="button" disabled>Cetak</button></td>
                                    </tr>
                                    <tr>
                                        <td>Balqist</td>
                                        <td>XI MM</td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>1 <span class="text-danger">(0,27 %)</span></td>
                                        <td>1 <span class="text-danger">(0,27 %)</span></td>
                                        <td><button class="btn btn-success shadow-sm nobradius" type="button" disabled>Cetak</button></td>
                                    </tr>
                                    <tr>
                                        <td>Daffa Adinata</td>
                                        <td>XI MM</td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td>1 <span class="text-danger">(0,27 %)</span></td>
                                        <td>0 <span class="text-danger">(0,00 %)</span></td>
                                        <td><button class="btn btn-success shadow-sm nobradius" type="button" disabled>Cetak</button></td>
                                    </tr>
                                </tbody>
                            </table>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datedropper/css/datedropper.min.css') }}" />
@endpush

{{-- addons js --}}
@push('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#order-table').DataTable();

            $('#tanggal_mulai').dateDropper({
                theme: 'leaf',
                format: 'd-m-Y'
            });

            $('#tanggal_selesai').dateDropper({
                theme: 'leaf',
                format: 'd-m-Y'
            });
        });
    </script>
@endpush