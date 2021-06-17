@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Absensi | Absesnsi Siswa')
@section('title-2', 'Absesnsi Siswa')
@section('title-3', 'Absesnsi Siswa')

@section('describ')
    Ini adalah halaman Absensi Siswa untuk admin
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
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card-block">
                        <h6>Pilih Kelas</h6>
                        <form id="form-absensi" action="{{route('admin.absensi.siswa')}}" method="get">
                            <input type="hidden" name="req" value="table">
                            <div class="row">
                                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <select name="kelas_id" id="pilih" class="form-control form-control-sm" required>
                                        <option value="">-- Kelas --</option>
                                        @foreach($kelas as $obj)
                                            <option value="{{$obj->id}}" {{ request()->kelas_id == $obj->id ? 'selected' : '' }}>{{$obj->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <input type="text" name="tanggal" id="tanggal" class="form-control form-control-sm" placeholder="Tanggal" readonly required value="{{request()->tanggal ?? ''}}">
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                                    <input type="submit" value="Pilih" class="btn btn-block btn-sm btn-primary shadow-sm">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">

                            {{-- input collect array --}}
                            <form action="{{ route('admin.absensi.siswa.approve-all') }}" method="POST">
                                @csrf @method('POST')
                                <button type="submit" class="btn btn-success" id="approve-all">Simpan Semua</button>
                                <input type="hidden" name="kelas_id" value="{{ $kelas_id }}">
                                <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                                <input type="hidden" name="hadir_collect" id="hadir-collect" value="">
                                <input type="hidden" name="absen_collect" id="absen-collect" value="">
                                <input type="hidden" name="sakit_collect" id="sakit-collect" value="">
                                <input type="hidden" name="izin_collect" id="izin-collect" value="">
                                <input type="hidden" name="lainnya_collect" id="lainnya-collect" value="">
                            </form>

                            <p></p>
                            <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                                <thead class="text-left">
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">H</th>
                                        <th class="text-center">A</th>
                                        <th class="text-center">S</th>
                                        <th class="text-center">I</th>
                                        <th class="text-center">Lainnya</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-left">
                                    @foreach($data as $obj)
                                    <form class="form-absensi">
                                        <input type="hidden" name="siswa_id" value="{{$obj->id}}">
                                        <input type="hidden" name="kelas_id" value="{{ request()->kelas_id }}">
                                        <input type="hidden" name="tanggal" value="{{ request()->tanggal }}">
                                        <tr>
                                            <td>{{ $obj->nama_lengkap}}</td>
                                            <td class="text-center">{{ $obj->kelas->name ?? ''}}</td>
                                            <td class="text-center">
                                                {{-- <input type="radio" name="status" value="H" required {{$obj->absensi && $obj->absensi->status == 'H' ? 'checked' : ''}}> --}}
                                                <div class="form-check">
                                                  <label class="form-check-label">
                                                    <input type="checkbox" 
                                                           class="form-check-input radio-hadir" 
                                                           name="radio_hadir" 
                                                           onclick="toggleHadir(this)" 
                                                           id="radio-hadir" 
                                                           value="H"
                                                           {{$obj->absensi && $obj->absensi->status == 'H' ? 'checked' : ''}}
                                                           data-id="{{ $obj->id }}">
                                                  </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{-- <input type="radio" name="status" value="A" required {{$obj->absensi && $obj->absensi->status == 'A' ? 'checked' : ''}}> --}}
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                      <input 
                                                        type="checkbox" 
                                                        class="form-check-input radio-absen" 
                                                        name="radio_absen" 
                                                        id="radio-absen" 
                                                        onclick="toggleAbsen(this)" 
                                                        value="A"
                                                        {{$obj->absensi && $obj->absensi->status == 'A' ? 'checked' : ''}}
                                                        data-id="{{ $obj->id }}">
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{-- <input type="radio" name="status" value="S" required {{$obj->absensi && $obj->absensi->status == 'S' ? 'checked' : ''}}> --}}
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                      <input 
                                                        type="checkbox" 
                                                        class="form-check-input radio-sakit" 
                                                        name="radio-sakit" 
                                                        onclick="toggleSakit(this)" 
                                                        id="radio-sakit" 
                                                        value="S"
                                                        {{$obj->absensi && $obj->absensi->status == 'S' ? 'checked' : ''}}
                                                        data-id="{{ $obj->id }}">
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{-- <input type="radio" name="status" value="I" required {{$obj->absensi && $obj->absensi->status == 'I' ? 'checked' : ''}}> --}}
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                      <input 
                                                        type="checkbox" 
                                                        class="form-check-input radio-izin" 
                                                        name="radio_izin" 
                                                        id="radio-izin" 
                                                        onclick="toggleIzin(this)" 
                                                        value="I"
                                                        {{$obj->absensi && $obj->absensi->status == 'I' ? 'checked' : ''}}
                                                        data-id="{{ $obj->id }}">
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{-- <input type="radio" name="status" value="L" required {{$obj->absensi && $obj->absensi->status == 'L' ? 'checked' : ''}}> --}}
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                      <input 
                                                        type="checkbox" 
                                                        class="form-check-input radio-lainnya" 
                                                        name="radio_lainnya" 
                                                        onclick="toggleLainnya(this)" 
                                                        id="radio-lainnya" 
                                                        value="L"
                                                        {{$obj->absensi && $obj->absensi->status == 'L' ? 'checked' : ''}}
                                                        data-id="{{ $obj->id }}">
                                                    </label>
                                                </div>
                                            </td>
                                            <td id="submit_{{$obj->id}}" class="text-center">
                                                @if($obj->absensi)
                                                <label class="badge badge-success" id="approved">APPROVED</label>
                                                @else
                                                <input type="submit" class="btn btn-success" id="approve" value="approve">
                                                @endif
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach
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
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function () {

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

            $('#tanggal').dateDropper({
                theme: 'leaf',
                format: 'Y-m-d'
            });

        //     $(".form-absensi").on('submit', function(ev){
        //         ev.preventDefault();
        //         var params = {};
        //         $.each($(this).serializeArray(), function() {
        //             params[this.name] = this.value;
        //         }); 
        //         params = {
        //             ...params,
        //             req: 'write'
        //         };

        //         $.post("{{route('admin.absensi.siswa.write')}}", params).done(data => {
        //             Swal.fire("Berhasil","Data sukses ditambahkan", "success");
        //             var approved = '<label class="badge badge-success" id="approved">APPROVED</label>'
        //             $('#approve').hide();
        //             $(`#submit_${params.siswa_id}`).append(approved);
        //         }).fail((data) => {
        //             if(typeof data.responseJSON.message == 'string')
        //                 return Swal.fire('Error', data.responseJSON.message, 'error');
        //             else if(typeof data.responseText == 'string')
        //                 return Swal.fire('Error', data.responseText, 'error');
        //         })

        //         //console.log(`#submit_${data.siswa_id}`);
        //     })
        });
    </script>

    <script>
    let radioHadir = document.getElementsByClassName('radio-hadir');
    let radioIzin = document.getElementsByClassName('radio-izin');
    let radioSakit = document.getElementsByClassName('radio-sakit');
    let radioAbsen = document.getElementsByClassName('radio-absen');
    let radioLainnya = document.getElementsByClassName('radio-lainnya');

    // Hadir
    const addItemHadir = (newId) => {
        let itemIdCollect = document.getElementById('hadir-collect');
        if (itemIdCollect.value == "") {
            itemIdCollect.value = newId;
        }else{
            itemIdCollect.value = itemIdCollect.value + ";" + newId;
        }
    }

    const deleteItemHadir = (newId) => {
        let itemIdCollect = document.getElementById('hadir-collect').value;
        let oldValues = itemIdCollect.split(';');
        let filter = oldValues.filter(function(oldValue){
            return oldValue === newId.toString();
        });
        let removeData = itemIdCollect.split(filter);
        document.getElementById('hadir-collect').value = removeData.join('');
    }

    // Absen
    const addItemAbsen = (newId) => {
        let itemIdCollect = document.getElementById('absen-collect');
        if (itemIdCollect.value == "") {
            itemIdCollect.value = newId;
        }else{
            itemIdCollect.value = itemIdCollect.value + ";" + newId;
        }
    }

    const deleteItemAbsen = (newId) => {
        let itemIdCollect = document.getElementById('absen-collect').value;
        let oldValues = itemIdCollect.split(';');
        let filter = oldValues.filter(function(oldValue){
            return oldValue === newId.toString();
        });
        let removeData = itemIdCollect.split(filter);
        document.getElementById('absen-collect').value = removeData.join('');
    }

    // Sakit
    const addItemSakit = (newId) => {
        let itemIdCollect = document.getElementById('sakit-collect');
        if (itemIdCollect.value == "") {
            itemIdCollect.value = newId;
        }else{
            itemIdCollect.value = itemIdCollect.value + ";" + newId;
        }
    }

    const deleteItemSakit = (newId) => {
        let itemIdCollect = document.getElementById('sakit-collect').value;
        let oldValues = itemIdCollect.split(';');
        let filter = oldValues.filter(function(oldValue){
            return oldValue === newId.toString();
        });
        let removeData = itemIdCollect.split(filter);
        document.getElementById('sakit-collect').value = removeData.join('');
    }

    // Izin
    const addItemIzin = (newId) => {
        let itemIdCollect = document.getElementById('izin-collect');
        if (itemIdCollect.value == "") {
            itemIdCollect.value = newId;
        }else{
            itemIdCollect.value = itemIdCollect.value + ";" + newId;
        }
    }

    const deleteItemIzin = (newId) => {
        let itemIdCollect = document.getElementById('izin-collect').value;
        let oldValues = itemIdCollect.split(';');
        let filter = oldValues.filter(function(oldValue){
            return oldValue === newId.toString();
        });
        let removeData = itemIdCollect.split(filter);
        document.getElementById('izin-collect').value = removeData.join('');
    }

    // lainnya
    const addItemLainnya = (newId) => {
        let itemIdCollect = document.getElementById('lainnya-collect');
        if (itemIdCollect.value == "") {
            itemIdCollect.value = newId;
        }else{
            itemIdCollect.value = itemIdCollect.value + ";" + newId;
        }
    }

    const deleteItemLainnya = (newId) => {
        let itemIdCollect = document.getElementById('lainnya-collect').value;
        let oldValues = itemIdCollect.split(';');
        let filter = oldValues.filter(function(oldValue){
            return oldValue === newId.toString();
        });
        let removeData = itemIdCollect.split(filter);
        document.getElementById('lainnya-collect').value = removeData.join('');
    }


    const toggleHadir = (obj) => {
        let newId = obj.getAttribute('data-id');

        Array.from(radioAbsen).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioSakit).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioIzin).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioLainnya).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        deleteItemAbsen(newId);
        deleteItemSakit(newId);
        deleteItemIzin(newId);
        deleteItemLainnya(newId);

        if (obj.checked == true) {
            addItemHadir(newId);
        }

        if (obj.checked == false) {
            deleteItemHadir(newId);
        }
    }

    const toggleAbsen = (obj) => {
        let newId = obj.getAttribute('data-id');

        Array.from(radioHadir).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioSakit).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioIzin).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioLainnya).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        deleteItemHadir(newId);
        deleteItemSakit(newId);
        deleteItemIzin(newId);
        deleteItemLainnya(newId);

        if (obj.checked == true) {
            addItemAbsen(newId);
        }

        if (obj.checked == false) {
            deleteItemAbsen(newId);
        }
    }

    const toggleSakit = (obj) => {
        let newId = obj.getAttribute('data-id');

        Array.from(radioHadir).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioAbsen).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioIzin).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioLainnya).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        deleteItemAbsen(newId);
        deleteItemHadir(newId);
        deleteItemIzin(newId);
        deleteItemLainnya(newId);

        if (obj.checked == true) {
            addItemSakit(newId);
        }

        if (obj.checked == false) {
            deleteItemSakit(newId);
        }
    }

    const toggleIzin = (obj) => {
        let newId = obj.getAttribute('data-id');

        Array.from(radioHadir).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioSakit).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioAbsen).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioLainnya).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        
        deleteItemAbsen(newId);
        deleteItemHadir(newId);
        deleteItemSakit(newId);
        deleteItemLainnya(newId);


        if (obj.checked == true) {
            addItemIzin(newId);
        }

        if (obj.checked == false) {
            deleteItemIzin(newId);
        }
    }

    const toggleLainnya = (obj) => {
        let newId = obj.getAttribute('data-id');

        Array.from(radioHadir).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioSakit).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioAbsen).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });

        Array.from(radioIzin).forEach(function(item){
            if(item.getAttribute('data-id') == obj.getAttribute('data-id')){
                item.checked = false;
            }
        });
   
        deleteItemAbsen(newId);
        deleteItemHadir(newId);
        deleteItemIzin(newId);
        deleteItemSakit(newId);

        if (obj.checked == true) {
            addItemLainnya(newId);
        }

        if (obj.checked == false) {
            deleteItemLainnya(newId);
        }
    }
</script>
@endpush
