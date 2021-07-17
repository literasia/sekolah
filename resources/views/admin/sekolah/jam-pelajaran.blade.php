@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Sekolah | Jam Pelajaran')
@section('title-2', 'Jam Pelajaran')
@section('title-3', 'Jam Pelajaran')

@section('describ')
    Ini adalah halaman jam pelajaran untuk sekolah
@endsection

@section('icon-l', 'fa fa-list-alt')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.sekolah.jam-pelajaran') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-block">
                        <div class="dt-responsive">
                          <form id="form-jam-pelajaran">
                            <div class="row">
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
                                <div class="col-12">
                                    <label class="d-block mb-3">Jam Pelajaran</label>
                                    <input type='button' value='Tambah Jam Pelajaran' id='addButton' class="btn btn-primary btn-mini">
                                    <input type='button' value='Hapus Jam Pelajaran' id='removeButton' class="btn btn-outline-primary btn-mini">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" id="subject-wrapper">
                                    <div class="row border rounded jam-pelajaran mt-3" id="subject-group">
                                        <div class="col px-0">
                                            <div class="form-group p-3">
                                                <label for="jam_ke">Jam ke</label>
                                                <input id="jam_ke" type="number" class="form-control form-control-sm" placeholder="Jam ke" name="jam_ke[]">
                                            </div>
                                        </div>
                                        <div class="col px-0">
                                            <div class="form-group p-3">
                                                <label for="jam_mulai">Jam Mulai</label>
                                                <input id="jam_mulai" type="text" class="clockpicker form-control form-control-sm" placeholder="Jam Mulai" name="jam_mulai[]" required readonly>
                                            </div>
                                        </div>
                                        <div class="col px-0">
                                            <div class="form-group p-3">
                                                <label for="jam_selesai">Jam Selesai</label>
                                                <input id="jam_selesai" type="text" class="clockpicker form-control form-control-sm" placeholder="Jam Selesai" name="jam_selesai[]" required readonly>
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
                                    <button id="reset-form" type="button" class="btn btn-sm btn-outline-success" id="btn-cancel">Batal</button>
                                </div>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row" >
        <div class="col-xl-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-block">
                      <form method="get" action="{{route('admin.sekolah.jam')}}">
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
    </div> --}}


    <div class="row" id="showjpcard">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    @include('admin.sekolah.jam-pelajaran-table-hari', ['hari' => 'Senin', 'data' => $data['senin'] ?? []])
                </div>
                <div class="col-md-4">
                    @include('admin.sekolah.jam-pelajaran-table-hari', ['hari' => 'Selasa', 'data' => $data['selasa'] ?? []])
                </div>
                <div class="col-md-4">
                    @include('admin.sekolah.jam-pelajaran-table-hari', ['hari' => 'Rabu', 'data' => $data['rabu'] ?? []])
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    @include('admin.sekolah.jam-pelajaran-table-hari', ['hari' => 'Kamis', 'data' => $data['kamis'] ?? []])
                </div>
                <div class="col-md-4">
                    @include('admin.sekolah.jam-pelajaran-table-hari', ['hari' => 'Jumat', 'data' => $data['jumat'] ?? []])
                </div>
                <div class="col-md-4">
                    @include('admin.sekolah.jam-pelajaran-table-hari', ['hari' => 'Sabtu', 'data' => $data['sabtu'] ?? []])
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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-clockpicker.min.css') }}" />
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
    <script src="{{ asset('js/bootstrap-clockpicker.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
     <script>
        $(document).ready(function () {
            $('.clockpicker').clockpicker({donetext: 'Done', autoclose: true});

            let counter = 1;
            
            $("#addButton").click(function () {                  

                if(counter >= 15){
                    Swal.fire('Perhatian!', 'Hanya boleh 15 jam pelajaran saja! Silahkan isi kembali nanti.', 'warning');
                    return false;
                } 
                let newSubjectField =  `<div class="row border rounded jam-pelajaran mt-3" id="subject-group${counter}">
                                            <div class="col px-0">
                                                <div class="form-group p-3">
                                                    <label for="jam_ke">Jam ke</label>
                                                    <input id="jam_ke" type="number" class="form-control form-control-sm" placeholder="Jam ke" name="jam_ke[]">
                                                </div>
                                            </div>
                                            <div class="col px-0">
                                                <div class="form-group p-3">
                                                    <label for="jam_mulai">Jam Mulai</label>
                                                    <input id="jam_mulai" type="text" class="clockpicker form-control form-control-sm" placeholder="Jam Mulai" name="jam_mulai[]" required readonly>
                                                </div>
                                            </div>
                                            <div class="col px-0">
                                                <div class="form-group p-3">
                                                    <label for="jam_selesai">Jam Selesai</label>
                                                    <input id="jam_selesai" type="text" class="clockpicker form-control form-control-sm" placeholder="Jam Selesai" name="jam_selesai[]" required readonly>
                                                </div>
                                            </div>
                                        </div>`;
                                        
                $('#subject-wrapper').append(newSubjectField);
    
                counter++;
                $('.clockpicker').clockpicker({donetext: 'Done', autoclose: true});
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

            var resetForm = () => {
              $('select[name=hari]').val("senin");
              $('input[name=jam_ke]').val("");
              $('input[name=jam_mulai]').val("");
              $('input[name=jam_selesai]').val("");
            };

            $("#reset-form").click(() => {
              resetForm();
            });

            $('#form-jam-pelajaran').on('submit', function (event) {
                event.preventDefault();
                var url = "{{ route('admin.sekolah.jam-pelajaran.write') }}?req=write";
                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    success: function (data) {
                        Swal.fire("Berhasil", "Data sukses ditambahkan", "success");
                        resetForm();
                        window.location.reload();
                    },
                    error: function(data) {
                      if(typeof data.responseJSON.message == 'string')
                        return Swal.fire('Error', data.responseJSON.message, 'error');
                      else if(typeof data.responseJSON == 'string')
                        return Swal.fire('Error', data.responseJSON, 'error');
                    }
                });
            });

            var id;
            $(document).on('click', '.delete', function () {
                id = $(this).attr('data-id');
                $('#ok_button').text('Hapus');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function () {
                $.ajax({
                    url: "{{ route('admin.sekolah.jam-pelajaran.write') }}?req=delete&id=" + id,
                    cache: false,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#ok_button').text('Menghapus...');
                    }, 
                    success: function (data) {
                        $('#confirmModal').modal('hide');
                        Swal.fire("Berhasil", "Data dihapus!", "success");
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
            });
            loadData();
        });
    </script>
@endpush
