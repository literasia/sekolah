@extends('layouts.siswa')

{{-- config 1 --}}
@section('title', 'E-Voting')
@section('title-2', 'E-Voting')
@section('title-3', 'E-Voting')

@section('describ')
    Ini adalah halaman E-Voting untuk admin
@endsection

@section('icon-l', 'fa fa-vote-yea')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('siswa.e-voting.e-voting') }}
@endsection

{{-- main content --}}
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                            <thead class="text-left">
                                <tr>
                                    <th>No</th>
                                    <th>Pemilihan</th>
                                    <th>Tanggal</th>
                                    <th>Kandidat</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-left">
                                <tr>
                                    <td>1</td>
                                    <td>Position 2</td>
                                    <td>12 Desember 2020</td>
                                    <td>Test 1234</td>
                                    <td>
                                        <button class="btn btn-success btn-sm shadow-sm">Vote</button>
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
@endsection

{{-- CSS --}}
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
@endpush

{{-- JS --}}
@push('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#order-table').DataTable();
        });
    </script>
@endpush