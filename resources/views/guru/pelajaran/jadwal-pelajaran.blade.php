@extends('layouts.guru')

{{-- config 1 --}}
@section('title', 'Pelajaran | Jadwal Pelajaran')
@section('title-2', 'Jadwal Pelajaran')
@section('title-3', 'Jadwal Pelajaran')

@section('describ')
    Ini adalah halaman Jadwal Pelajaran untuk guru
@endsection

@section('icon-l', 'fa fa-list-alt')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('guru.pelajaran.jadwal-pelajaran') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-block">
                      <form method="get" action="{{route('guru.pelajaran.jadwal-pelajaran')}}">
                        <div class="dt-responsive ">
                            <div class="row">
                                <div class="col">
                                    <label for="nama_calon">Tampil Jadwal</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="kelas2">Kelas</label>
                                    <select name="kelas_id" id="kelas2" class="form-control form-control-sm" required>
                                        <option>-- Kelas --</option>
                                        @foreach($kelas as $item)
                                          <option value="{{$item->id}}" @if ($kelas_id == $item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select name="semester" id="semester2" class="form-control form-control-sm" required>
                                        <option>-- Semester --</option>
                                        <option value="Ganjil" @if ($semester == "Ganjil") selected @endif>Ganjil</option>
                                        <option value="Genap" @if ($semester == "Genap") selected @endif>Genap</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="agama">Tahun Ajaran</label>
                                    <select name="tahun_ajaran" id="tahun_ajaran2" class="form-control form-control-sm" required>
                                        <option>-- Tahun Ajaran --</option>
                                        <option value="2018/2019" @if ($tahun_ajaran == "2018/2019") selected @endif>2018/2019</option>
                                        <option value="2019/2020" @if ($tahun_ajaran == "2019/2020") selected @endif>2019/2020</option>
                                        <option value="2020/2021" @if ($tahun_ajaran == "2020/2021") selected @endif>2020/2021</option>
                                        <option value="2021/2022" @if ($tahun_ajaran == "2021/2022") selected @endif>2021/2022</option>
                                        <option value="2022/2023" @if ($tahun_ajaran == "2022/2023") selected @endif>2022/2023</option>
                                        <option value="2023/2024" @if ($tahun_ajaran == "2023/2024") selected @endif>2023/2024</option>
                                        <option value="2024/2025" @if ($tahun_ajaran == "2024/2025") selected @endif>2024/2025</option>
                                        <option value="2025/2026" @if ($tahun_ajaran == "2025/2026") selected @endif>2025/2026</option>
                                        <option value="2026/2027" @if ($tahun_ajaran == "2026/2027") selected @endif>2026/2027</option>
                                        <option value="2027/2028" @if ($tahun_ajaran == "2027/2028") selected @endif>2027/2028</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="hidden" name="req" value="table">
                                    <input type="submit" class="btn btn-sm btn-success" value="Tampil" id="tampil">
                                </div>
                            </div>
                        </div>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>   


    <div class="row" id="showjpcard">
        <div class="col-md-12">

        <div class="row">
          <div class="col-md-4">
            @include('guru.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Senin', 'data' => $data['senin'] ?? []])
          </div>
          <div class="col-md-4">
            @include('guru.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Selasa', 'data' => $data['selasa'] ?? []])
          </div>
          <div class="col-md-4">
            @include('guru.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Rabu', 'data' => $data['rabu'] ?? []])
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            @include('guru.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Kamis', 'data' => $data['kamis'] ?? []])
          </div>
          <div class="col-md-4">
            @include('guru.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Jumat', 'data' => $data['jumat'] ?? []])
          </div>
          <div class="col-md-4">
            @include('guru.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Sabtu', 'data' => $data['sabtu'] ?? []])
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
    <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            loadData();
        });
    </script>
@endpush