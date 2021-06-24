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
                                <input type="text" name="kelas_id" value="{{ $kelas_id }}">
                                <input type="text" name="tanggal" value="{{ $tanggal }}">
                                <input type="text" name="hadir_collect" id="hadir-collect" value="">
                                <input type="text" name="absen_collect" id="absen-collect" value="">
                                <input type="text" name="sakit_collect" id="sakit-collect" value="">
                                <input type="text" name="izin_collect" id="izin-collect" value="">
                                <input type="text" name="lainnya_collect" id="lainnya-collect" value="">
                            </form>

                            <p></p>
                            <table id="order-table" class="table table-striped table-bordered nowrap shadow-sm">
                                <thead class="text-left">
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">H
                                            <span style="padding-left: 25px">
                                                <input type="checkbox" 
                                                            class="form-check-input" 
                                                            onclick="toggleAllHadir(this)" 
                                                            id="radio-hadir-all">
                                            </span>
                                        </th>
                                        <th class="text-center">A
                                            <span style="padding-left: 25px">
                                                <input type="checkbox" 
                                                            class="form-check-input" 
                                                            onclick="toggleAllAbsen(this)" 
                                                            id="radio-absen-all">
                                            </span>
                                        </th>
                                        <th class="text-center">S
                                            <span style="padding-left: 25px">
                                                <input type="checkbox" 
                                                            class="form-check-input" 
                                                            onclick="toggleAllSakit(this)" 
                                                            id="radio-sakit-all">
                                            </span>
                                        </th>
                                        <th class="text-center">I
                                            <span style="padding-left: 25px">
                                                <input type="checkbox" 
                                                            class="form-check-input" 
                                                            onclick="toggleAllIzin(this)" 
                                                            id="radio-izin-all">
                                            </span>
                                        </th>
                                        <th class="text-center">Lainnya
                                            <span style="padding-left: 25px">
                                                <input type="checkbox" 
                                                            class="form-check-input radio-hadir-all" 
                                                            onclick="toggleAllLainnya(this)" 
                                                            id="radio-lainnya-all">
                                            </span>
                                        </th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-left">
                                    @foreach($data as $obj)
                                    <form class="form-absensi" action="{{ route('admin.absensi.siswa.approve') }}" method="post">
                                        @csrf @method('POST')
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
                                                           name="status" 
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
                                                        name="status" 
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
                                                        name="status" 
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
                                                        name="status" 
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
                                                        name="status" 
                                                        onclick="toggleLainnya(this)" 
                                                        id="radio-lainnya" 
                                                        value="L"
                                                        {{$obj->absensi && $obj->absensi->status == 'L' ? 'checked' : ''}}
                                                        data-id="{{ $obj->id }}">
                                                    </label>
                                                </div>
                                            </td>
                                            <td id="submit_{{$obj->id}}" class="text-center">
                                                {{-- @if($obj->absensi)
                                                <label class="badge badge-success" id="approved">APPROVED</label>
                                                @else
                                                <input type="submit" disabled="true" class="btn btn-success approve-button" data-id="{{ $obj->id }}" id="approve" value="approve">
                                                @endif --}}
                                                <input type="submit" disabled="true" class="btn btn-success approve-button" data-id="{{ $obj->id }}" id="approve" value="approve">
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
            $('#tanggal').dateDropper({
                theme: 'leaf',
                format: 'Y-m-d'
            });
        });
    </script>

    <script>
    let radioHadir = document.getElementsByClassName('radio-hadir');
    let radioIzin = document.getElementsByClassName('radio-izin');
    let radioSakit = document.getElementsByClassName('radio-sakit');
    let radioAbsen = document.getElementsByClassName('radio-absen');
    let radioLainnya = document.getElementsByClassName('radio-lainnya');
    let approveButton = document.getElementsByClassName('approve-button');
    let radioHadirAll = document.getElementById('radio-hadir-all');
    let radioIzinAll = document.getElementById('radio-izin-all');
    let radioSakitAll = document.getElementById('radio-sakit-all');
    let radioAbsenAll = document.getElementById('radio-absen-all');
    let radioLainnyaAll = document.getElementById('radio-lainnya-all');
    // Enable Button when checkbox on checked
    const enabledAllApproveButton = () => {
        Array.from(approveButton).forEach(function(obj){
            obj.removeAttribute('disabled');
        });
    }
    // uncheck another checkbox when another toggle all checkbox has checked
    const uncheckMultipleCheckbox = (toggleAllCheckbox, el) => {
        toggleAllCheckbox.checked = false;
        Array.from(el).forEach(function(obj){
            obj.checked = false;
        });
    }
    // clear all value collection
    const clearItems = () => {
        document.getElementById('hadir-collect').value = "";
        document.getElementById('absen-collect').value = "";
        document.getElementById('izin-collect').value = "";
        document.getElementById('sakit-collect').value = "";
        document.getElementById('lainnya-collect').value = "";
    }
    // clear all checkbox item per column
    const clearAllCheckboxItem = (obj, absensiCheckbox) => {
        if(obj.checked == false){
            Array.from(absensiCheckbox).forEach(function(obj){
                clearItems();
                obj.checked = false;
            }); 
        }
    }
    // Toggle All Hadir
    const toggleAllHadir = (obj) => {
        clearItems();
        Array.from(radioHadir).forEach(function(obj){
            obj.checked = true;
            addItems(obj.getAttribute('data-id').toString(), document.getElementById('hadir-collect'));
        });
        clearAllCheckboxItem(obj, radioHadir);
        enabledAllApproveButton();
        
        uncheckMultipleCheckbox(radioLainnyaAll, radioLainnya);
        uncheckMultipleCheckbox(radioAbsenAll, radioAbsen);
        uncheckMultipleCheckbox(radioSakitAll, radioSakit);
        uncheckMultipleCheckbox(radioIzinAll, radioIzin);
    }
    // Toggle All Absen
    const toggleAllAbsen = (obj) => {
        clearItems();
        // Add Items
        Array.from(radioAbsen).forEach(function(obj){
            obj.checked = true;
            addItems(obj.getAttribute('data-id').toString(), document.getElementById('absen-collect'));
        });
        clearAllCheckboxItem(obj, radioAbsen);
        enabledAllApproveButton();
        
        uncheckMultipleCheckbox(radioLainnyaAll, radioLainnya);
        uncheckMultipleCheckbox(radioHadirAll, radioHadir);
        uncheckMultipleCheckbox(radioSakitAll, radioSakit);
        uncheckMultipleCheckbox(radioIzinAll, radioIzin);
    }
    // Toggle All Sakit
    const toggleAllSakit = (obj) => {
        clearItems();
        // Add Items
        Array.from(radioSakit).forEach(function(obj){
            obj.checked = true;
            addItems(obj.getAttribute('data-id').toString(), document.getElementById('sakit-collect'));
        });
        clearAllCheckboxItem(obj, radioSakit);
        enabledAllApproveButton();
        
        uncheckMultipleCheckbox(radioLainnyaAll, radioLainnya);
        uncheckMultipleCheckbox(radioAbsenAll, radioAbsen);
        uncheckMultipleCheckbox(radioHadirAll, radioHadir);
        uncheckMultipleCheckbox(radioIzinAll, radioIzin);
    }
    // Toggle All Izin
    const toggleAllIzin = (obj) => {
        clearItems();
        // Add Items
        Array.from(radioIzin).forEach(function(obj){
            obj.checked = true;
            addItems(obj.getAttribute('data-id').toString(), document.getElementById('izin-collect'));
        });
        clearAllCheckboxItem(obj, radioIzin);
        enabledAllApproveButton();
        uncheckMultipleCheckbox(radioLainnyaAll, radioLainnya);
        uncheckMultipleCheckbox(radioAbsenAll, radioAbsen);
        uncheckMultipleCheckbox(radioSakitAll, radioSakit);
        uncheckMultipleCheckbox(radioHadirAll, radioHadir);
    }
    // Toggle All Lainnya
    const toggleAllLainnya = (obj) => {
        clearItems();
        // Add Items
        Array.from(radioLainnya).forEach(function(obj){
            obj.checked = true;
            addItems(obj.getAttribute('data-id').toString(), document.getElementById('lainnya-collect'));
        });
        clearAllCheckboxItem(obj, radioLainnya);
        enabledAllApproveButton();
        uncheckMultipleCheckbox(radioHadirAll, radioHadir);
        uncheckMultipleCheckbox(radioAbsenAll, radioAbsen);
        uncheckMultipleCheckbox(radioSakitAll, radioSakit);
        uncheckMultipleCheckbox(radioIzinAll, radioIzin);
    }
    // Add Items to input when checkbox has checked
    const addItems = (newId, el) => {
        if (el.value == "") {
            el.value = newId;
        }else{
            el.value = el.value + ";" + newId;
        }
    }
    // delete item when checkbox has unchecked
    const deleteItems = (newId, el) => {
        let itemIdCollect = el.value;
        let oldValues = itemIdCollect.split(';');
        let filter = oldValues.filter(function(oldValue){
            return oldValue === newId.toString();
        });
        let removeData = itemIdCollect.split(filter);
        el.value = removeData.join('');
    }
    // unchecked another checkbox when another checbox has checked
    const uncheckedSingleItem = (itemChecked, newItem) => {
        Array.from(itemChecked).forEach(function(item){
            if(item.getAttribute('data-id') == newItem){
                item.checked = false;
            }
        });
    }
    // eabled singgle approve button when single checbox has checked
    const enabledSingleApproveButton = (obj, newId) => {
        Array.from(approveButton).forEach(function(objButton){
            if (obj.checked == true) {
                if (objButton.getAttribute('data-id').toString() == newId.toString()) {
                    objButton.removeAttribute('disabled');
                }
            }else{
                if (objButton.getAttribute('data-id').toString() == newId.toString()) {
                    objButton.setAttribute('disabled', true);
                }   
            }
        });
    }
    // Toggle Hadir
    const toggleHadir = (obj) => {
        let newId = obj.getAttribute('data-id');
        uncheckedSingleItem(radioAbsen, newId);
        uncheckedSingleItem(radioIzin, newId);
        uncheckedSingleItem(radioSakit, newId);
        uncheckedSingleItem(radioLainnya, newId);
        
        enabledSingleApproveButton(obj, newId);
        
        deleteItems(newId, document.getElementById('absen-collect'));
        deleteItems(newId, document.getElementById('sakit-collect'));
        deleteItems(newId, document.getElementById('izin-collect'));
        deleteItems(newId, document.getElementById('lainnya-collect'));
        if (obj.checked == true) {
            addItems(newId, document.getElementById('hadir-collect'));
        }
        if (obj.checked == false) {
            deleteItems(newId, document.getElementById('hadir-collect'));
        }
    }
    const toggleAbsen = (obj) => {
        let newId = obj.getAttribute('data-id');
        uncheckedSingleItem(radioHadir, newId);
        uncheckedSingleItem(radioIzin, newId);
        uncheckedSingleItem(radioSakit, newId);
        uncheckedSingleItem(radioLainnya, newId);
        enabledSingleApproveButton(obj, newId);
        deleteItems(newId, document.getElementById('hadir-collect'));
        deleteItems(newId, document.getElementById('sakit-collect'));
        deleteItems(newId, document.getElementById('izin-collect'));
        deleteItems(newId, document.getElementById('lainnya-collect'));
      
        if (obj.checked == true) {
            addItems(newId, document.getElementById('absen-collect'));
        }
        if (obj.checked == false) {
            deleteItems(newId, document.getElementById('absen-collect'));
        }
    }
    const toggleSakit = (obj) => {
        let newId = obj.getAttribute('data-id');
        
        uncheckedSingleItem(radioHadir, newId);
        uncheckedSingleItem(radioIzin, newId);
        uncheckedSingleItem(radioAbsen, newId);
        uncheckedSingleItem(radioLainnya, newId);
        enabledSingleApproveButton(obj, newId);
        deleteItems(newId, document.getElementById('absen-collect'));
        deleteItems(newId, document.getElementById('hadir-collect'));
        deleteItems(newId, document.getElementById('izin-collect'));
        deleteItems(newId, document.getElementById('lainnya-collect'));
        if (obj.checked == true) {
            addItems(newId, document.getElement ById('sakit-collect'));
        }
        if (obj.checked == false) {
            deleteItems(newId, document.getElementById('sakit-collect'));
        }
    }
    const toggleIzin = (obj) => {
        let newId = obj.getAttribute('data-id');
        
        uncheckedSingleItem(radioHadir, newId);
        uncheckedSingleItem(radioAbsen, newId);
        uncheckedSingleItem(radioSakit, newId);
        uncheckedSingleItem(radioLainnya, newId);
        enabledSingleApproveButton(obj, newId);
        deleteItems(newId, document.getElementById('absen-collect'));
        deleteItems(newId, document.getElementById('sakit-collect'));
        deleteItems(newId, document.getElementById('hadir-collect'));
        deleteItems(newId, document.getElementById('lainnya-collect'));
        if (obj.checked == true) {
            addItems(newId, document.getElementById('izin-collect'));
        }
        if (obj.checked == false) {
            deleteItems(newId, document.getElementById('izin-collect'));
        }
    }
    const toggleLainnya = (obj) => {
        let newId = obj.getAttribute('data-id');
        uncheckedSingleItem(radioHadir, newId);
        uncheckedSingleItem(radioIzin, newId);
        uncheckedSingleItem(radioSakit, newId);
        uncheckedSingleItem(radioAbsen, newId);
        enabledSingleApproveButton(obj, newId);
   
        deleteItems(newId, document.getElementById('absen-collect'));
        deleteItems(newId, document.getElementById('sakit-collect'));
        deleteItems(newId, document.getElementById('izin-collect'));
        deleteItems(newId, document.getElementById('hadir-collect'));
        if (obj.checked == true) {
            addItems(newId, document.getElementById('lainnya-collect'));
        }
        if (obj.checked == false) {
            deleteItems(newId, document.getElementById('lainnya-collect'));
        }
    }
</script>
@endpush
