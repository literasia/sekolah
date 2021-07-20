@extends('layouts.guru')

@section('title', 'Forum | Pengaturan')
@section('title-2', 'Pengaturan')
@section('title-3', 'Pengaturan')

@section('describ')
    Ini adalah halaman Pengaturan Forum untuk guru
@endsection

@section('icon-l', 'icon-home')
@section('icon-r', 'icon-home')
@section('link')
    {{ route('guru.forum.pengaturan-forum') }}
@endsection

@section('content')
<form id="form-pengaturan">
	@csrf @method("POST")
	<div class="row">
    	<div class="col-xl-12">
        	<div class="card glass-card d-flex justify-content-center align-items-center p-2">
            	<div class=" col-xl-12 card shadow mb-0 p-0">
                	<div class="card-body">
                    	<div class="mt-3 mb-5 quiz-modal-wrapper">
                        	<h5 class="d-inline-block quiz-modal-caption mt-4 px-2 text-info">Pengaturan Pengguna Forum</h5>
                            	<div class="border rounded p-3">
                            		<small class="d-block mb-2">Menetapkan batas waktu dan kemampuan posting pengguna lainnya.</small>
		                        	<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Peran Forum</h6>
                                            	<div class="form-check mb-2" action="/action_page.php">
													<label class="form-check-label" for="peran_forum">
                                                		<input class="form-check-input" type="checkbox" name="hide_peran_forum" id="peran_forum">
                                							Secara otomatis memberikan pengunjung terdaftar sebagai peran forum Peserta
                                                	</label>
													<div class="mt-2 form-group">
                                                    	<select name="show_peran" id="peran" class="form-control form-control-sm col-6">
                                                    	<option value="">-- Pilih --</option>
                                                    	<option value="keymaster">Keymaster</option>
                                                    	<option value="moderator">Moderator</option>
                                                    	<option value="peserta">Peserta</option>
                                                    	<option value="blokir">Blokir Pengguna</option>
                                                    	</select>
                                                	</div>
                                            	</div>
                                        	<small class="d-block mb-2">Hapus centang ini untuk menetapkan secara manual semua akses pengguna ke forum Anda.</small>      
		                            	</div>  
		                        	</div>
		                        	<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Spam</h6>
                                        	<div class="form-check mb-2" action="/action_page.php">
												<label class="form-check-label">
													<input class="form-check-input mt-2" type="checkbox" name="nonaktif_spam" id="" checked> 
                                                		Izinkan perlindungan <i>flooding</i> dengan membatasi pengguna selama <input class="col-1 form-control-sm form-control d-inline-block" type="number" name="batas_waktu" id="batas-waktu">  detik setelah memposting
                                            	</label>
                                        	</div>
                                        	<small class="d-block mb-2">Gunakan ini untuk mencegah pengguna mengirim spam ke forum Anda.</small>
			                        	</div>
                                	</div>
		                        	<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Edit Forum</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php">
												<label class="form-check-label">
                                            		<input class="form-check-input mt-2" type="checkbox" name="edit_forum" id="" checked>
                                                		Izinkan pengguna untuk mengedit konten mereka selama <input class="col-1 form-control form-control-sm d-inline-block" type="number" name="batas_waktu" id="batas-waktu"> menit setelah memposting
                                            	</label>
                                        	</div>
                                        	<small class="d-block mb-2">Jika dicentang, pengaturan ke "0 menit" memungkinkan pengeditan selamanya.</small>
			                        	</div>
                                	</div>
									<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Anonymous</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php"> 
                                            	<input class="form-check-input" type="checkbox" name="anonymous" id="">
												<label class="form-check-label">       
                                                	Izinkan pengguna tamu tanpa akun untuk membuat topik dan balasan
                                            	</label>
                                        	</div>
                                        	<small class="d-block mb-2">Bekerja paling baik di intranet atau dipasangkan dengan tindakan antispam.</small>
			                        	</div>
                                	</div>
								</div>
						</div>
						<div class="mt-3 mb-5 quiz-modal-wrapper">
                        	<h5 class="d-inline-block quiz-modal-caption mt-4 px-2 text-info">Fitur Forum</h5>
                            	<div class="border rounded p-3">
                            		<small class="d-block mb-2">Fitur forum yang dapat diaktifkan dan dinonaktifkan</small>
		                        	<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Auto-embed links</h6>
                                            	<div class="form-group form-check mb-2" action="/action_page.php">
                                                	<input class="form-check-input" type="checkbox" name="autoembed_links" id="" checked>
													<label class="form-check-label">     
                                                    	Sematkan media (YouTube, Twitter, Flickr, dll...) langsung ke topik dan balasan
                                                	</label>
                                            	</div>      
		                            	</div>  
		                        	</div>
		                        	<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Reply Threading</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php">
												<div class="form-row">
													<div class="col-auto mt-1">
                                            			<input class="form-check-input" type="checkbox" name="reply" id="">
														<label class="form-check-label"> Aktifkan balasan berulir (bersarang) sedalam</label>
													</div>
													<div class="col-auto">
														<select name="level" id="level" class="form-control-sm form-control d-inline-block">
															<option value="">--Pilih Level--</option>
                                                			<option value="2">2 level</option>
                                                    		<option value="3">3 level</option>
                                                    		<option value="4">4 level</option>
                                                    		<option value="5">5 level</option>
															<option value="6">6 level</option>
                                                		</select>
													</div>
												</div>
                                        	</div>
			                        	</div>
                                	</div>
		                        	<div class="row mt-3 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Revisions</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php">
                                            	<label class="form-check-label">
                                                	<input class="form-check-input" type="checkbox" name="revisi" id="" checked>       
                                                	<div>Izinkan revisi pada topik dan balas pesan</div> 
                                            	</label>
                                        	</div>
			                        	</div>
                                	</div>
									<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Favorites</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php">
                                            	<label class="form-check-label">
                                                	<input class="form-check-input" type="checkbox" name="favorites" id="" checked>       
                                                	<div>Izinkan pengguna untuk menandai topik sebagai favorit</div> 
                                            	</label>
                                        	</div>
			                        	</div>
                                	</div>
									<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Subscriptions</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php">
                                            	<label class="form-check-label">
                                                	<input class="form-check-input" type="checkbox" name="subscribe" id="" checked>       
                                                	<div>Izinkan pengguna untuk berlanggganan forum dan topik</div> 
                                            	</label>
                                        	</div>
			                        	</div>
                                	</div>
									<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Engagements</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php">
                                            	<label class="form-check-label">
                                                	<input class="form-check-input" type="checkbox" name="engagements" id="" checked>       
                                                	<div>Izinkan pelacakan topik yang melibatkan setiap pengguna</div> 
                                            	</label>
                                        	</div>
			                        	</div>
                                	</div>
									<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Topic tags</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php">
                                            	<label class="form-check-label">
                                                	<input class="form-check-input" type="checkbox" name="tag_topik" id="" checked>       
                                                	<div>Izinkan topik memiliki tautan</div> 
                                            	</label>
                                        	</div>
			                        	</div>
                                	</div>
									<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Search</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php">
                                            	<label class="form-check-label">
                                                	<input class="form-check-input" type="checkbox" name="search" id="" checked>       
                                                	<div>Izinkan pencarian di seluruh forum</div> 
                                            	</label>
                                        	</div>
			                        	</div>
                                	</div>
									<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Post Formatting</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php">
                                            	<label class="form-check-label">
                                                	<input class="form-check-input" type="checkbox" name="format_post" id="">       
                                                	<div>Tambahkan bilah alat dan tombol ke area teks untuk membantu pemformatan HTML</div> 
                                            	</label>
                                        	</div>
			                        	</div>
                                	</div>
									<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Forum Moderators</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php">
                                            	<label class="form-check-label">
                                                	<input class="form-check-input" type="checkbox" name="moderator_forum" id="">       
                                                	<div>Izinkan forum memiliki moderator khusus</div>
                                            	</label>
                                        	</div>
											<small class="d-block mb-2">Ini tidak termasuk kemampuan untuk mengedit pengguna.</small>
			                        	</div>
                                	</div>
									<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Super Moderators</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php">
                                            	<label class="form-check-label">
                                                	<input class="form-check-input" type="checkbox" name="super" id="">       
                                                	<div>Izinkan Moderator dan Keymaster untuk mengedit pengguna</div>
                                            	</label>
                                        	</div>
											<small class="d-block mb-2">Ini termasuk peran, kata sandi, dan alamat email.</small>
			                        	</div>
                                	</div>
								</div>
						</div>
						<div class="mt-3 mb-5 quiz-modal-wrapper">
							<h5 class="d-inline-block quiz-modal-caption mt-4 px-2 text-info">Fitur Topik dan Balasan per Halaman</h5>
                            	<div class="border rounded p-3">
                            		<small class="d-block mb-2">Berapa banyak topik dan balasan yang ditampilkan per halaman</small>
		                        	<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Topics</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php">
                                            	<label class="form-check-label">       
                                                	<div><input class="col-3 form-control form-control-sm d-inline-block" type="number" name="halaman_topik" id="batas-topik"> per halaman</div> 
                                            	</label>
                                        	</div>
			                        	</div>
                                	</div>
									<div class="row mt-4 mb-2">
			                        	<div class="col-md-12">
				                        	<h6 class="font-weight-bold">Balasan</h6>
                                        	<div class="form-group form-check mb-2" action="/action_page.php">
                                            	<label class="form-check-label">       
                                                	<div><input class="col-3 form-control form-control-sm d-inline-block" type="number" name="halaman_balasan" id="batas-balasan"> per halaman</div> 
                                            	</label>
                                        	</div>
			                        	</div>
                                	</div>
								</div>
						</div>
						<div class="my-3" style="margin-left: 90%;">
		        			<button class="btn-success btn btn-info btn-sm" style="">Simpan</button>
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
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datedropper/css/datedropper.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-clockpicker.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
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
    .rotate{
        -moz-transition: all .2s linear;
        -webkit-transition: all 2s linear;
        transition: all .2s linear;
    }
    .rotate.down{
        -moz-transform:rotate(90deg);
        -webkit-transform:rotate(90deg);
        transform:rotate(90deg);
    }
    .badge-secondary {
        background-color: #6c757d6b;
    }
    .duration-option, .duration-option:focus {
        border: 1px solid #ced4da!important;
        background-color: #85ccff4a;
    }
    .quiz-modal-wrapper {
        position: relative;
    }

    .quiz-modal-caption {
        position: absolute;
        top: -35px;
        left: 20px;
        background: #fff;
    }
    .demo-content {
        visibility: hidden;
        display: none;
        z-index: 9999999!important;
        background: #fff;
    }
    .demo-wrapper a:hover + .demo-content, .demo-wrapper a:active + .demo-content, .demo-wrapper a:focus + .demo-content {
        visibility: visible;
        display: block;
    }
    .form-check-input-custom {
        margin-left: -1rem!important;
    }
    .btn-next {
        border-radius: 30px;
    }
    .border-bottom-custom {
        border-bottom: 2px solid red;
    }
    .modal-dialog {
        margin-bottom: 20rem!important;
    }
    .nav-link.active {
        font-weight: bold;
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
<script src="{{ asset('js/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('bower_components/datedropper/js/datedropper.min.js') }}"></script>
<script>
    $('document').ready(function() {
        $("input[type='checkbox']").click(function() {
            $('#peran_forum').change(function(){
                if ($("#peran_forum").is(':checked')){
                    $('#peran').hide();
                } else {
                    $('#peran').show();
                }
            });
        });
    })
</script>
@endpush