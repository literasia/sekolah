@extends('layouts.guru')

{{-- config 1 --}}
@section('title', 'E-Voting | Pemilihan')
@section('title-2', 'Pemilihan')
@section('title-3', 'Pemilihan')

@section('describ')
    Ini adalah halaman Pemilihan untuk guru
@endsection

@section('icon-l', 'fa fa-vote-yea')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('guru.e-voting.pemilihan') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card glass-card d-flex justify-content-center align-items-center p-2">
                <div class=" col-xl-12 card shadow mb-0 p-0">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                                    <thead class="text-left">
                                        <tr>
                                            <th>No.</th>
                                            <th>Kandidat</th>
                                            <th>Jenis Pemilihan</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-left">
                                        @foreach($data_pemilihan as $dt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <ol>
                                                    @foreach($dt->calons as $nk)
                                                    <li>{{ $nk->name }}</li>
                                                    @endforeach
                                                </ol>
                                            </td>
                                            <td>{{ $dt->posisi }}</td>
                                            <td>{{ $dt->start_date }}</td>
                                            <td>{{ $dt->end_date }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
    <!-- Select 2 css -->
    <link rel="stylesheet" href="{{ asset('bower_components/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datedropper/css/datedropper.min.css') }}" />
    <style>
        .btn i {
            margin-right: 0px;
        }
        .glass-card {
            background: rgba( 255, 255, 255, 0.40 );
            box-shadow: 0 8px 32px 0 rgb(31 38 135 / 22%);
            backdrop-filter: blur( 17.5px );
            -webkit-backdrop-filter: blur( 17.5px );
            border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );
        }
        .select2-container {
            width: 100% !important;
            padding: 0;
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
    <script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script> 
    <script>
        $(document).ready(function () {
            $('#nama_calon').select2();

            $('#tanggal_mulai').dateDropper({
                theme: 'leaf',
                format: 'd-m-Y'
            });

            $('#tanggal_selesai').dateDropper({
                theme: 'leaf',
                format: 'd-m-Y'
            });

            $('#order-table').DataTable();

            if($('.pilih').is(':selected')){
                    $('#kelas').prop('disabled',true);
                };
            });


            $('#kelas').on('change', function() {
                var id = $(this).val();
                
                $.ajax({
                    url: "/guru/e-voting/pemilihan/kelas/" + id,
                    method: 'GET',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    success: function (data) {
                        $('#nama_calon')
                            .find('option')
                            .remove()
                        data.forEach(function(siswa){
                            console.log(siswa);
                            var elem = $("<option></option>");
                            elem.attr("value", siswa.id);
                            elem.text(siswa.name);
                            elem.appendTo($("select#nama_calon"));  
                        });
                    }
                });
            });
    </script>
@endpush
