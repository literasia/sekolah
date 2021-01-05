@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Absensi | Absesnsi Siswa')
@section('title-2', 'Absesnsi Siswa')
@section('title-3', 'Absesnsi Siswa')

@section('describ')
    Ini adalah halaman absensi siswa per kelas untuk admin
@endsection

@section('icon-l', 'fa fa-clipboard-list')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.absensi.siswa') }}
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
                                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
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
                                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <input type="text" name="tanggal" id="tanggal" class="form-control form-control-sm" placeholder="Tanggal" readonly>
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

            $('#tanggal').dateDropper({
                theme: 'leaf',
                format: 'd-m-Y'
            });
        });
    </script>
@endpush