@extends('layouts.superadmin')

{{-- config 1 --}}
@section('title', 'Berita')
@section('title-2', 'Berita')
@section('title-3', 'Berita')

@section('describ')
    Ini adalah halaman Berita untuk Superadmin
@endsection

@section('icon-l', 'icon-list')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('superadmin.berita.berita') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h5>Edit Berita | {{ $berita->name }}</h5>
            </div>
            <div class="card-body">
                <form id="form-berita" method="POST" action="{{ route('superadmin.berita.update', $berita->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control form-control-sm" value="{{ $berita->name }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control form-control-sm">
                                    <option value="">Pilih</option>
                                    @foreach($katbe as $kb)
                                    <option value="{{ $kb->name }}">{{ $kb->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="isi">Isi Berita</label>
                                <textarea name="isi" id="isi" cols="10" rows="3" class="form-control form-control-sm" placeholder="Isi Berita"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <input type="file" class="form-control form-control-sm" name="thumbnail" id="thumbnail" accept="image/*" value="" autocomplete="off">
                                <label for="thumbnail" class="mt-1">
                                    thumbnail:
                                    <small class="text-muted">max. 3MB</small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-sm btn-outline-success">Ubah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- addons css --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <style>
        .btn i {
            margin-right: 0px;
        }
    </style>
@endpush

{{-- addons js --}}
@push('js')
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
        });
    </script>
@endpush