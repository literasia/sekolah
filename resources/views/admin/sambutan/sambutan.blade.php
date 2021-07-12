@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Sambutan Kepala Sekolah | Sambutan')
@section('title-2', 'Sambutan Kepala Sekolah')
@section('title-3', 'Sambutan Kepala Sekolah')

@section('describ')
    Ini adalah halaman sambutan kepala sekolah untuk Admin
@endsection

@section('icon-l', 'fa fa-user')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.sambutan.sambutan') }}
@endsection

{{-- main content --}}
@section('content')
    <form id="sambutan-form"  action="{{ route('admin.sambutan.sambutan.store') }}" method="POST">
    @csrf @method('POST')
        <div class="row"> 
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
               <div class="card glass-card d-flex justify-content-center align-items-center p-2">
                    <div class=" col-xl-12 card shadow mb-0 p-0">
                        <div class="card-body">
                            <div class="card-block">
                                <div class="col-12 text-center">
                                    <div class="form-group">
                                        <h4 class="mb-4">Foto Kepala Sekolah</h4>
                                        <img id="thumb_gallery" class="" src="" />
                                        <div class="input-file">
                                            <span class="btn-upload" target="#gallery1">Pilih Gambar</span>
                                            <span class="file-selected"></span>
                                            <input type="file" name="foto" id="gallery1" class="gallery"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="card glass-card d-flex justify-content-center align-items-center p-2">
                    <div class=" col-xl-12 card shadow mb-0 p-0">
                        <div class="card-body">
                            <div class="card-block">
                                <h4>Sambutan</h4>
                                <div class="form-group row">
                                    <input type="hidden" name="hidden_id" value="">
                                    <label for="title" class="col-sm-3 col-form-label">Judul</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Judul" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="content" class="col-sm-3 col-form-label">Isi Sambutan</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control" rows="10" id="content" name="content" placeholder="Isi"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn-success btn-mini">Simpan</button>
                                        <!-- <button type="submit" href="" id="btn-profil" class="btn btn-success">Simpan</button>   -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

{{-- addons css --}}
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <style>
        img {
            width: 150px;
        }

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

        #gallery1, #gallery2 {
            visibility: hidden;
            width: 1px;
            height: 1px;
        }
        .btn-upload {
            background: #00bcbe;
            -webkit-border-radius: .25rem;
            -moz-border-radius: .25rem;
            border-radius: .25rem;
            color: #fff;
            padding: .375rem .75rem;
        }

        .btn-upload:hover, .btn-upload:active, .btn-upload:focus {
            background: #00a2a4;
            cursor: pointer;
        }
            
        .file-selected {
            font-size: 10px;
            text-align: center;
            width: 100%;
            display: block;
            margin-top: 5px;
        }

        #thumb_gallery {
            display: none;
        }

        #thumb_gallery.not_empty {
            width: 200px;
            object-fit: cover;
        }

        #thumb_gallery.not_empty, .thumb_pict.not_empty {
            display: inline-block;
            margin-bottom: 30px;
        }
        .thumb-img-container {
            position: relative;
            margin-bottom:5px;
        }

        .thumb-img-container::after {
            content: "";
            display: block;
            padding-bottom: 100%;
        }

        .thumb-img-container img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumb_pict {
            margin-bottom:30px;
            padding: 20px;
            -webkit-box-shadow: 0 0 5px 0 rgb(43 43 43 / 10%), 0 11px 6px -7px rgb(43 43 43 / 10%);
            box-shadow: 0 0 5px 0 rgb(43 43 43 / 10%), 0 11px 6px -7px rgb(43 43 43 / 10%);
            border-radius: .25rem;
        }

        .thumb_pict img{
            width:100%;
            max-height:500px
        }
    </style>
@endpush

{{-- addons js --}}
@push('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        function thumb_gallery(inputFile){
            var file = inputFile[0].files[0];
            if(file){
                var reader = new FileReader();
     
                reader.onload = function(){
                    $("#thumb_gallery").attr("src", reader.result);
                }
     
                reader.readAsDataURL(file);
                $("#thumb_gallery").addClass("not_empty");
            }
        }

        var count = 0;
        $(document).ready(function(){
            if (window.File && window.FileList && window.FileReader && window.Blob) {
                $('body').on('click', '.btn-upload', function(){
                    $($(this).attr("target")).trigger('click');
                });

                $('body').on("change","#gallery1",function(){
                    thumb_gallery($(this))
                });
            } else {
                alert("Your browser doesn't support to File API");
            }
        });
    </script>
@endpush