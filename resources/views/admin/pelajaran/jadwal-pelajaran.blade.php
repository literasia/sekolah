@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Pelajaran | Jadwal Pelajaran')
@section('title-2', 'Jadwal Pelajaran')
@section('title-3', 'Jadwal Pelajaran')

@section('describ')
    Ini adalah halaman jadwal pelajaran untuk admin
@endsection

@section('icon-l', 'fa fa-list-alt')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.pelajaran.jadwal-pelajaran') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-block">
                        <div class="dt-responsive">
                          <form id="form-jadwal-pelajaran">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kelas">Kelas</label>
                                        <select name="kelas_id" id="kelas" class="form-control form-control-sm">
                                            <option value="">-- Kelas --</option>
                                            @foreach($kelas as $obj)
                                            <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="hari">Hari</label>
                                        <select name="hari" id="hari" class="form-control form-control-sm">
                                            <option value="">-- Hari --</option>
                                            <option value="senin">Senin</option>
                                            <option value="selasa">Selasa</option>
                                            <option value="rabu">Rabu</option>
                                            <option value="kamis">Kamis</option>
                                            <option value="jumat">Jumat</option>
                                            <option value="sabtu">Sabtu</option>
                                            <option value="minggu">Minggu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="semester">Semester</label>
                                        <input type="text" name="semester" id="semester" value="{{ $sekolah->semester }}" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tahun_ajaran">Tahun Ajaran</label>
                                        <input type="text" name="tahun_ajaran" id="tahun_ajaran" value="{{ $sekolah->tahun_ajaran }}" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label class="d-block mb-3">Mata Pelajaran</label>
                                    <input type='button' value='Tambah Mata Pelajaran' id='addButton' class="btn btn-primary btn-mini" disabled>
                                    <input type='button' value='Hapus Mata Pelajaran' id='removeButton' class="btn btn-outline-primary btn-mini" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" id="subject-wrapper">
                                    <div class="row border rounded mata-pelajaran mt-3" id="subject-group">
                                        <div class="col px-0">
                                            <div class="form-group p-3">
                                                <label>Jam Ke</label>
                                                <select name="jam_pelajaran_id[]" id="jam_pelajaran" class="form-control form-control-sm">
                                                    <option value="">Pilih hari terlebih dahulu</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col px-0">
                                            <div class="form-group p-3">
                                                <label for="pelajaran">Pelajaran</label>
                                                <select name="mata_pelajaran_id[]" id="mata_pelajaran_id" class="form-control form-control-sm">
                                                    <option value="">-- Pelajaran --</option>
                                                    @foreach($pelajaran as $obj)
                                                    <option value="{{$obj->id}}">{{$obj->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="id" id="id">
                                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                    <button id="reset-form" type="button" class="btn btn-sm btn-outline-success">Batal</button>
                                </div>
                            </div>
                          </form>
                        </div>
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
                      <form method="get" action="{{route('admin.pelajaran.jadwal-pelajaran')}}">
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
            @include('admin.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Senin', 'data' => $data['senin'] ?? []])
          </div>
          <div class="col-md-4">
            @include('admin.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Selasa', 'data' => $data['selasa'] ?? []])
          </div>
          <div class="col-md-4">
            @include('admin.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Rabu', 'data' => $data['rabu'] ?? []])
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            @include('admin.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Kamis', 'data' => $data['kamis'] ?? []])
          </div>
          <div class="col-md-4">
            @include('admin.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Jumat', 'data' => $data['jumat'] ?? []])
          </div>
          <div class="col-md-4">
            @include('admin.pelajaran.jadwal-pelajaran-table-hari', ['hari' => 'Sabtu', 'data' => $data['sabtu'] ?? []])
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
            let counter = 1;
            
            $("#addButton").click(function () {                   
                $.ajax({
                    url: "{{ route('admin.pelajaran.jadwal-pelajaran.getJamPelajaran') }}",
                    method: 'POST',
                    data: {hari: $('#hari').val()},
                    success: function (data) {
                        if(counter >= 15){
                            Swal.fire('Perhatian!', 'Hanya boleh 15 mata pelajaran saja! Silahkan isi kembali nanti.', 'warning');
                            return false;
                        } 
                        let newSubjectField =  `<div class="row border rounded mata-pelajaran mt-3" id="subject-group${counter}">
                                                    <div class="col px-0">
                                                        <div class="form-group p-3">
                                                            <label>Jam Ke</label>
                                                            <select name="jam_pelajaran_id[]" id="jam_pelajaran_${counter}" class="form-control form-control-sm">
                                                                <option value="">-- Jam Ke --</option>
                                                                <option value=""></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col px-0">
                                                        <div class="form-group p-3">
                                                            <label for="pelajaran">Pelajaran</label>
                                                            <select name="mata_pelajaran_id[]" id="mata_pelajaran_id" class="form-control form-control-sm">
                                                                <option value="">-- Pelajaran --</option>
                                                                @foreach($pelajaran as $obj)
                                                                <option value="{{$obj->id}}">{{$obj->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>`;
                        
                        $('#subject-wrapper').append(newSubjectField);

                        let jam_pelajarans = data;
                        $(`#jam_pelajaran_${counter}`).html("");
                        $(`#jam_pelajaran_${counter}`).append(`<option value="">-- Jam Ke --</option>`);
                        jam_pelajarans.forEach(data => {
                            let jam_mulai = data.jam_mulai.split(":");
                            let jam_selesai = data.jam_selesai.split(":");
                            $(`#jam_pelajaran_${counter}`).append(`<option value='${data.id}'>
                                ${jam_mulai[0]} : ${jam_mulai[1]} - ${jam_selesai[0]} : ${jam_selesai[1]}</option>`);
                        });

                        counter++;
                    }
                });

            });
            $("#removeButton").click(function () {
                if(counter==1){
                    Swal.fire('Perhatian!', 'Tidak ada yang dapat di hapus lagi', 'warning');
                    return false;
                }      
                counter--;       
                $("#subject-group" + counter).remove();    
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#showjpcard');
            table.hide();
            @if(request()->req == 'table')
            table.show();
            @endif
            $("#hari").change(function(){
                _this = $(this);
                $('#addButton').removeAttr('disabled');
                $('#removeButton').removeAttr('disabled');
                $.ajax({
                    url: "{{ route('admin.pelajaran.jadwal-pelajaran.getJamPelajaran') }}",
                    method: 'POST',
                    data: {hari:_this.val()},
                    success: function (data) {
                        let jam_pelajarans = data;
                        $('#jam_pelajaran').html("");
                        $('#jam_pelajaran').append(`<option value="">-- Jam Ke --</option>`);
                        jam_pelajarans.forEach(data => {
                            let jam_mulai = data.jam_mulai.split(":");
                            let jam_selesai = data.jam_selesai.split(":");
                            $('#jam_pelajaran').append(`<option value='${data.id}'>
                                ${jam_mulai[0]} : ${jam_mulai[1]} - ${jam_selesai[0]} : ${jam_selesai[1]}</option>`);
                        });
                        // console.log(data);
                    }
                });
            })
            var resetForm = () => {
              $('select[name=kelas_id]').val("{{ $kelas[0] ?? null }}");
              $('select[name=mata_pelajaran_id]').val("{{ $mata_pelajaran[0]->id ?? null }}");
              $('select[name=hari]').val("senin");
              $('select[name=semester]').val("ganjil");
              $('select[name=tahun_ajaran]').val("{{ $tahun_ajaran[0] ?? null}}");
              $('textarea[name=keterangan]').val('');
              var $radios = $('input:radio[name=jam_pelajaran]');
              $radios.prop('checked', false);
              $radios.filter('[value=1]').prop('checked', true);
            };
            $("#reset-form").click(() => {
              resetForm();
            });
            $('#form-jadwal-pelajaran').on('submit', function (event) {
                console.log('tes');
                event.preventDefault();
                var text = "Data sukses ditambahkan";
                var url = "{{ route('admin.pelajaran.jadwal-pelajaran.write') }}?req=write";
                $.ajax({
                    url: url,
                    method: 'POST',
                    // dataType: 'JSON',
                    data: $("#form-jadwal-pelajaran").serialize(),
                    success: function (data) {
                        console.log(data);
                        Swal.fire("Berhasil", text, "success");
                        resetForm();
                        table.hide();
                    },
                    error: function(data) {
                      if(typeof data.responseJSON.message == 'string')
                        return Swal.fire('Error', data.responseJSON.message, 'error');
                      else if(typeof data.responseJSON == 'string')
                        return Swal.fire('Error', data.responseJSON, 'error');
                    }
                });
            });
            $("#showjpcard").on('click', '.btn-delete', function(ev, data) {
                var id = ev.currentTarget.getAttribute('data-id');
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: "Apa anda yakin untuk menghapus data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.pelajaran.jadwal-pelajaran.write') }}?req=delete&id=" + id,
                            cache: false,
                            method: "POST",
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                toastr.success('Data berhasil dihapus');
                                setTimeout(() => {
                                 window.location.reload();
                                }, 500)
                            },
                            error: function(data) {
                                if(typeof data.responseJSON.message == 'string')
                                    return Swal.fire('Error', data.responseJSON.message, 'error');
                                else if(typeof data.responseJSON == 'string')
                                    return Swal.fire('Error', data.responseJSON, 'error');
                            }
                        });
                    }
                    })
            });
        });
    </script>
@endpush