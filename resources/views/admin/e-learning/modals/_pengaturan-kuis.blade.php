<div class="mt-3 mb-5 quiz-modal-wrapper">
   <h5 class="d-inline-block quiz-modal-caption mt-4 px-2 text-info">Pilihan</h5>
   <div class="border rounded p-3">
		<div class="row mt-2 mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan judul kuis</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="is_hide_title" id="hide-quiz">
		            <label class="custom-control-label" for="hide-quiz">Aktifkan</label>
		        </div>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan tombol "Mulai ulang kuis"</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="restart_quiz" id="restart-quiz">
		            <label class="custom-control-label" for="restart-quiz">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Sembunyikan tombol "Mulai ulang kuis" pada tampilan aplikasi</small>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Tampilkan kuis secara acak</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="random_question" id="random-quiz" checked>
		            <label class="custom-control-label" for="random-quiz">Aktif</label>
		        </div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Tampilkan jawaban secara acak</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="random_option" id="random-answer" checked>
		            <label class="custom-control-label" for="random-answer">Aktif</label>
		        </div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Statistik</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="statistic" id="quiz-statistic" checked>
		            <label class="custom-control-label" for="quiz-statistic">Aktif</label>
		        </div>
		        <small class="d-block mt-2">Statistik mengenai jawaban benar dan salah. Statistik akan disimpan saat kuis selesai, bukan setelah setiap pertanyaan.</small>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Kerjakan kuis hanya sekali</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="once-quiz" id="take_quiz_only_once">
		            <label class="custom-control-label" for="once-quiz">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Jika mengaktifkan pilihan ini, pengguna dapat melengkapi kuis hanya sekli saja. Setelah itu, kuis akan diblokir untuk pengguna tersebut.</small>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Tampilkan hanya nomor pertanyaan sepisifik</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="only_show_specific_question" id="specific-number" checked="">
		            <label class="custom-control-label" for="specific-number">Aktif</label>
		        </div>
		        <small class="d-block my-2">Jika mengaktifkan pilihan ini, maksimal nomor pertanyaan yang ditampilkan akan menjadi X dari X pertanyaan.</small>
		        <p class="mb-1">Berapa banyak pertayaan yang harus ditampilkan? <input type="number" class="d-inline-block col-2 form-control ml-2" value="50" name="many_questions_should_be_displayed"></p>
		        <p class="m-0"><input type="checkbox" value="50" class="d-inline-block checkbox mr-2" name="in_percent">dalam persen</p>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Lewatkan pertanyaan</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="skip_question" id="skip-quiz">
		            <label class="custom-control-label" for="skip-quiz">Nonaktifkan</label>
		        </div>
		        <small class="d-block mt-2">Jika memilih pilihan ini, pengguna tidak dapat melewatkan pertanyaan.</small>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Autostart</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="autostart" id="autostart">
		            <label class="custom-control-label" for="autostart">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Jika memilih pilihan ini, kuis kan dimulai secara otomatis setelah halaman tampil.</small>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Hanya pengguna terdaftar yang bisa memulai kuis</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="only_registered" id="registered-user" checked="">
		            <label class="custom-control-label" for="registered-user">Aktif</label>
		        </div>
		        <small class="d-block mt-2">Jika memilih pilihan ini, hanya pengguna terdaftar yang dapat memulai kuis.</small>
			</div>
		</div>
	</div>
</div>

<div class="my-5 quiz-modal-wrapper">
   <h5 class="d-inline-block quiz-modal-caption mt-4 px-2 text-info">Pilihan Pertanyaan</h5>
   <div class="border rounded p-3">
		<div class="row mt-2 mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Tampilkan poin</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="show_point" id="show-point">
		            <label class="custom-control-label" for="show-point">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Tampilkan di kuis, berapa banyak poin untuk masing-masing pertanyaan.</small>
		    </div>
		</div>
		<div class="row mb-4 ">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Penomoran jawaban</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="with_number_in_option" id="number-answers">
		            <label class="custom-control-label" for="number-answers">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Jika pilihan ini diaktifkan, maka semua jawaban akan diberi nomor (hanya untuk single dan multiple choice.</small>
		        <div class="demo-wrapper position-relative">
		        	<a href="#" class="text-info"><u>Demo</u></a>
		        	<div class="demo-content position-absolute p-3 shadow rounded">
		        		<div class="row p-2">
		        			<div class="col-md-6 border p-3">
		        				<p>Pertanyaan 3 dari 7</p>
		        				<div class="d-flex justify-content-between">
		        					<p class="font-weight-bold m-0">3. Pertanyaan</p>
		        					<label class="badge badge-warning p-1 ml-5">1 poin</label>
		        				</div>
		        				<p class="my-2">Teks pertanyaan</p>
		        				<div class="p-3 border bg-light">
		        					<div class="form-check">
									  	<input class="form-check-input position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 1</label>
									</div>
									<div class="form-check">
									  	<input class="form-check-input position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 2</label>
									</div>
									<div class="form-check">
									  	<input class="form-check-input position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 3</label>
									</div>
		        				</div>
		        				<h6 class="font-weight-bold mt-3">Tanpa penomoran</h6>
		        			</div>
		        			<div class="col-md-6 border p-3">
		        				<p>Pertanyaan 3 dari 7</p>
		        				<div class="d-flex justify-content-between">
		        					<p class="font-weight-bold m-0">3. Pertanyaan</p>
		        					<label class="badge badge-warning p-1 ml-5">1 poin</label>
		        				</div>
		        				<p class="my-2">Tes pertanyaan</p>
		        				<div class="p-3 border bg-light">
		        					<div class="form-check pl-0">
		        						<p class="d-inline-block mb-0 mr-1">1.</p>
									  	<input class="position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 1</label>
									</div>
									<div class="form-check pl-0">
										<p class="d-inline-block mb-0 mr-1">2.</p>
									  	<input class="position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 2</label>
									</div>
									<div class="form-check pl-0">
									  	<p class="d-inline-block mb-0 mr-1">3.</p>
									  	<input class="position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 3</label>
									</div>
		        				</div>
		        				<h6 class="font-weight-bold mt-3">Dengan penomoran</h6>
		        			</div>
		        		</div>
		        	</div>
		        </div>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan pemberitahuan Benar-Salah</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="show_correct_option" id="hide-message" checked>
		            <label class="custom-control-label" for="hide-message">Aktif</label>
		        </div>
		        <small class="d-block mt-2">Jika memilih pilihan ini, maka pesan benar atau salah dari suatu jawaban tidak akan ditampilkan.</small>
		        <div class="demo-wrapper position-relative">
		        	<a href="#" class="text-info"><u>Demo</u></a>
		        	<div class="demo-content position-absolute p-3 shadow rounded">
		        		<div class="row p-2">
		        			<div class="col-md-6 border p-3">
		        				<p>Pertanyaan 3 dari 7</p>
		        				<div class="d-flex justify-content-between">
		        					<p class="font-weight-bold m-0">3. Pertanyaan</p>
		        					<label class="badge badge-warning p-1 ml-5">1 poin</label>
		        				</div>
		        				<p class="my-2">Teks pertanyaan</p>
		        				<div class="p-3 border bg-light">
		        					<div class="form-check bg-success">
									  	<input class="form-check-input form-check-input-custom position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 1</label>
									</div>
									<div class="form-check">
									  	<input class="form-check-input form-check-input-custom position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 2</label>
									</div>
									<div class="form-check">
									  	<input class="form-check-input form-check-input-custom position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 3</label>
									</div>
		        				</div>
		        				<div class="p-3 border bg-light mt-2">
		        					<p class="font-weight-bold mb-2">Benar</p>
		        					<p>Isi pesan...</p>
		        				</div>
		        				<div class="mt-3">
		        					<button class="d-block btn btn-info btn-next mr-0 ml-auto">Next</button>
		        				</div>
		        				<h5 class="font-weight-bold mt-3">Normal</h5>
		        			</div>
		        			<div class="col-md-6 border p-3">
		        				<p>Pertanyaan 3 dari 7</p>
		        				<div class="d-flex justify-content-between">
		        					<p class="font-weight-bold m-0">3. Pertanyaan</p>
		        					<label class="badge badge-warning p-1 ml-5">1 poin</label>
		        				</div>
		        				<p class="my-2">Teks pertanyaan</p>
		        				<div class="p-3 border bg-light">
		        					<div class="form-check bg-success">
									  	<input class="form-check-input form-check-input-custom position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 1</label>
									</div>
									<div class="form-check">
									  	<input class="form-check-input form-check-input-custom position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 2</label>
									</div>
									<div class="form-check">
									  	<input class="form-check-input form-check-input-custom position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 3</label>
									</div>
		        				</div>
		        				<div class="mt-3">
		        					<button class="d-block btn btn-info btn-next mr-0 ml-auto">Next</button>
		        				</div>
		        				<div class="p-3 border bg-light mt-2 invisible">
		        					<p class="font-weight-bold mb-2">Benar</p>
		        					<p>Isi pesan...</p>
		        				</div>
		        				<h5 class="font-weight-bold mt-3">Diaktifkan</h5>
		        			</div>
		        		</div>
		        	</div>
		        </div>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Tanda jawaban Benar-Salah</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="answer_mark" id="answer-mark" checked>
		            <label class="custom-control-label" for="answer-mark">Nonaktif</label>
		        </div>
		        <small class="d-block mt-2">Jika memilih pilihan ini, maka jawaban tidak akan diberi warna sebagai tanda benar atau salah.</small>
		        <div class="demo-wrapper position-relative">
		        	<a href="#" class="text-info"><u>Demo</u></a>
		        	<div class="demo-content position-absolute p-3 shadow rounded">
		        		<div class="row p-2">
		        			<div class="col-md-6 border p-3">
		        				<p>Pertanyaan 3 dari 7</p>
		        				<div class="d-flex justify-content-between">
		        					<p class="font-weight-bold m-0">3. Pertanyaan</p>
		        					<label class="badge badge-warning p-1 ml-5">1 poin</label>
		        				</div>
		        				<p class="my-2">Teks pertanyaan</p>
		        				<div class="p-3 border bg-light">
		        					<div class="form-check bg-success my-1">
									  	<input class="checkbox form-check-input-custom position-static" type="checkbox">
									  	<label>Tes 1</label>
									</div>
									<div class="form-check bg-success my-1">
									  	<input class="checkbox form-check-input-custom position-static" type="checkbox">
									  	<label>Tes 2</label>
									</div>
									<div class="form-check bg-danger my-1">
									  	<input class="checkbox form-check-input-custom position-static" type="checkbox">
									  	<label>Tes 3</label>
									</div>
		        				</div>
		        				<div class="p-3 border bg-light mt-2">
		        					<p class="font-weight-bold mb-2">Salah</p>
		        					<p>Isi pesan...</p>
		        				</div>
		        				<div class="mt-3">
		        					<button class="d-block btn btn-info btn-next mr-0 ml-auto">Next</button>
		        				</div>
		        				<h5 class="font-weight-bold mt-3">Normal</h5>
		        			</div>
		        			<div class="col-md-6 border p-3">
		        				<p>Pertanyaan 3 dari 7</p>
		        				<div class="d-flex justify-content-between">
		        					<p class="font-weight-bold m-0">3. Pertanyaan</p>
		        					<label class="badge badge-warning p-1 ml-5">1 poin</label>
		        				</div>
		        				<p class="my-2">Teks pertanyaan</p>
		        				<div class="p-3 border bg-light">
		        					<div class="form-check my-1">
									  	<input class="checkbox form-check-input-custom position-static" type="checkbox">
									  	<label>Tes 1</label>
									</div>
									<div class="form-check my-1">
									  	<input class="checkbox form-check-input-custom position-static" type="checkbox">
									  	<label>Tes 2</label>
									</div>
									<div class="form-check my-1">
									  	<input class="checkbox form-check-input-custom position-static" type="checkbox">
									  	<label>Tes 3</label>
									</div>
		        				</div>
		        				<div class="p-3 border bg-light mt-2">
		        					<p class="font-weight-bold mb-2">Benar</p>
		        					<p>Isi pesan...</p>
		        				</div>
		        				<div class="mt-3">
		        					<button class="d-block btn btn-info btn-next mr-0 ml-auto">Next</button>
		        				</div>
		        				<h5 class="font-weight-bold mt-3">Dinonaktifkan</h5>
		        			</div>
		        		</div>
		        	</div>
		        </div>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Wajibkan pengguna untuk menjawab setiap pertanyaan</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="force_answer" id="force-answer">
		            <label class="custom-control-label" for="force-answer">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Jika pilihan ini diaktifkan, pengguna diwajibkan untuk menjawab setiap pertanyaan.</small>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan penomoran pertanyaan</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="hide_numbering" id="hide-numbering" checked>
		            <label class="custom-control-label" for="hide-numbering">Aktif</label>
		        </div>
		        <small class="d-block mt-2">Jika pilihan ini diaktifkan, penomoran pertanyaan disembunyikan</small>
		        <div class="demo-wrapper position-relative">
		        	<a href="#" class="text-info"><u>Demo</u></a>
		        	<div class="demo-content position-absolute p-3 shadow rounded">
		        		<div class="row p-2">
		        			<div class="col-md-6 border p-3">
		        				<p>Pertanyaan 3 dari 7</p>
		        				<div class="d-flex justify-content-between">
		        					<p class="font-weight-bold m-0 border-bottom-custom">3. Pertanyaan</p>
		        					<label class="badge badge-warning p-1 ml-5">1 poin</label>
		        				</div>
		        				<p class="my-2">Teks pertanyaan</p>
		        				<div class="p-3 border bg-light">
		        					<div class="form-check">
									  	<input class="form-check-input position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 1</label>
									</div>
									<div class="form-check">
									  	<input class="form-check-input position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 2</label>
									</div>
									<div class="form-check">
									  	<input class="form-check-input position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 3</label>
									</div>
		        				</div>
		        				<div class="mt-3">
		        					<button class="d-block btn btn-info btn-next mr-0 ml-auto">Next</button>
		        				</div>
		        				<h5 class="font-weight-bold mt-3">Normal</h5>
		        			</div>
		        			<div class="col-md-6 border p-3">
		        				<p>Pertanyaan 3 dari 7</p>
		        				<div class="d-flex justify-content-between invisible">
		        					<p class="font-weight-bold m-0">3. Pertanyaan</p>
		        					<label class="badge badge-warning p-1 ml-5">1 poin</label>
		        				</div>
		        				<p class="my-2">Tes pertanyaan</p>
		        				<div class="p-3 border bg-light">
		        					<div class="form-check pl-0">
									  	<input class="position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 1</label>
									</div>
									<div class="form-check pl-0">
									  	<input class="position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 2</label>
									</div>
									<div class="form-check pl-0">
									  	<input class="position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
									  	<label>Tes 3</label>
									</div>
		        				</div>
		        				<div class="mt-3">
		        					<button class="d-block btn btn-info btn-next mr-0 ml-auto">Next</button>
		        				</div>
		        				<h5 class="font-weight-bold mt-3">Diaktifkan</h5>
		        			</div>
		        		</div>
		        	</div>
		        </div>
		    </div>
		</div>
	</div>
</div>

<div class="my-5 quiz-modal-wrapper">
   <h5 class="d-inline-block quiz-modal-caption mt-4 px-2 text-info">Pilihan Hasil</h5>
   <div class="border rounded p-3">
		<div class="row mt-2 mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Tampilkan poin rata-rata</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="show_average_point" id="average-point" checked>
		            <label class="custom-control-label" for="average-point">Aktif</label>
		        </div>
		        <div class="demo-wrapper position-relative">
		        	<a href="#" class="text-info"><u>Demo</u></a>
		        	<div class="demo-content position-absolute p-3 shadow rounded">
		        		<div class="row p-2">
		        			<div class="col-md-12">
		        				<h5 class="font-weight-bold">Kuis Tes</h5>
		        				<h6 class="font-weight-bold">Hasil</h6>
		        				<p class="mb-2">1 dari 11 pertanyaan terjawab dengan benar</p>
		        				<p>Waktu kamu: 00:00:07</p>
		        				<div class="px-3 text-center">
		        					<p class="font-weight-bold">Kamu telah menjangkau 10 dari 37 poin, (27,03%)</p>
		        					<div class="border p-2">
		        						<div class="row">
		        							<div class="col-4 border-right">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12">
		        											<small>Nilai rata-rata</small>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12">
		        											<small>Nilai kamu</small>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        							<div class="col-8 text-left">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 21%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4">
		        												<p>21,17%</p>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 27%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4">
		        												<p>27,03%</p>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        						</div>
		        					</div>
		        				</div>
		        				<div class="mt-3">
		        					<button class="d-inline-block btn btn-info btn-next">Mulai ulang kuis</button>
		        					<button class="d-inline-block btn btn-info btn-next">Lihat pertanyaan</button>
		        				</div>
		        			</div>
		        		</div>
		        	</div>
		        </div>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan tampilan pertanyaan yang benar</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="hide_correct_question" id="hide-correct-question">
		            <label class="custom-control-label" for="hide-correct-question">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Jika pilihan ini diaktifkan, maka jumlah pertanyaan yang di jawab dengan benar tidak lagi ditampilkan.</small>
		        <div class="demo-wrapper position-relative">
		        	<a href="#" class="text-info"><u>Demo</u></a>
		        	<div class="demo-content position-absolute p-3 shadow rounded">
		        		<div class="row p-2">
		        			<div class="col-md-6 border p-3">
		        				<h5 class="font-weight-bold">Kuis Tes</h5>
		        				<h6 class="font-weight-bold">Hasil</h6>
		        				<p class="mb-2 border-bottom-custom">1 dari 11 pertanyaan terjawab dengan benar</p>
		        				<p>Waktu kamu: 00:00:07</p>
		        				<div class="px-3 text-center">
		        					<p class="font-weight-bold">Kamu telah menjangkau 10 dari 37 poin, (27,03%)</p>
		        					<div class="border p-2">
		        						<div class="row">
		        							<div class="col-4 border-right">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12" style="line-height: 1;">
		        											<small>Nilai rata-rata</small>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12 pt-0" style="line-height: 1;">
		        											<small>Nilai kamu</small>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        							<div class="col-8 text-left">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8 p-0">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 21%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4 pr-0 pl-2">
		        												<small>21,17%</small>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8 p-0">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 27%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4 pr-0 pl-2">
		        												<small>27,03%</small>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        						</div>
		        					</div>
		        				</div>
		        				<div class="my-3">
		        					<button class="d-inline-block btn btn-info btn-next btn-sm">Mulai ulang kuis</button>
		        					<button class="d-inline-block btn btn-info btn-next btn-sm">Lihat pertanyaan</button>
		        				</div>
		        				<h5 class="font-weight-bold mt-4">Normal</h5>
		        			</div>
		        			<div class="col-md-6 border p-3">
		        				<h5 class="font-weight-bold">Kuis Tes</h5>
		        				<h6 class="font-weight-bold">Hasil</h6>
		        				<p class="mb-2 invisible">1 dari 11 pertanyaan terjawab dengan benar</p>
		        				<p>Waktu kamu: 00:00:07</p>
		        				<div class="px-3 text-center">
		        					<p class="font-weight-bold">Kamu telah menjangkau 10 dari 37 poin, (27,03%)</p>
		        					<div class="border p-2">
		        						<div class="row">
		        							<div class="col-4 border-right">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12" style="line-height: 1;">
		        											<small>Nilai rata-rata</small>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12  pt-0" style="line-height: 1;">
		        											<small>Nilai kamu</small>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        							<div class="col-8 text-left">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8 p-0">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 21%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4 pr-0 pl-2">
		        												<small>21,17%</small>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8 p-0">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 27%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4 pr-0 pl-2">
		        												<small>27,03%</small>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        						</div>
		        					</div>
		        				</div>
		        				<div class="my-3">
		        					<button class="d-inline-block btn btn-info btn-next btn-sm">Mulai ulang kuis</button>
		        					<button class="d-inline-block btn btn-info btn-next btn-sm">Lihat pertanyaan</button>
		        				</div>
		        				<h5 class="font-weight-bold mt-4">Diaktifkan</h5>
		        			</div>
		        		</div>
		        	</div>
		        </div>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan tampilan waktu kuis</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="hide_quiz_time" id="hide-quiz-time">
		            <label class="custom-control-label" for="hide-quiz-time">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Jika pilihan ini diaktifkan, maka waktu untuk menyelesaikan kuis ini tidak akan ditampilkan.</small>
		        <div class="demo-wrapper position-relative">
		        	<a href="#" class="text-info"><u>Demo</u></a>
		        	<div class="demo-content position-absolute p-3 shadow rounded">
		        		<div class="row p-2">
		        			<div class="col-md-6 border p-3">
		        				<h5 class="font-weight-bold">Kuis Tes</h5>
		        				<h6 class="font-weight-bold">Hasil</h6>
		        				<p class="mb-2">1 dari 11 pertanyaan terjawab dengan benar</p>
		        				<p class="border-bottom-custom">Waktu kamu: 00:00:07</p>
		        				<div class="px-3 text-center">
		        					<p class="font-weight-bold">Kamu telah menjangkau 10 dari 37 poin, (27,03%)</p>
		        					<div class="border p-2">
		        						<div class="row">
		        							<div class="col-4 border-right">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12" style="line-height: 1;">
		        											<small>Nilai rata-rata</small>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12 pt-0" style="line-height: 1;">
		        											<small>Nilai kamu</small>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        							<div class="col-8 text-left">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8 p-0">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 21%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4 pr-0 pl-2">
		        												<small>21,17%</small>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8 p-0">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 27%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4 pr-0 pl-2">
		        												<small>27,03%</small>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        						</div>
		        					</div>
		        				</div>
		        				<div class="my-3">
		        					<button class="d-inline-block btn btn-info btn-next btn-sm">Mulai ulang kuis</button>
		        					<button class="d-inline-block btn btn-info btn-next btn-sm">Lihat pertanyaan</button>
		        				</div>
		        				<h5 class="font-weight-bold mt-4">Normal</h5>
		        			</div>
		        			<div class="col-md-6 border p-3">
		        				<h5 class="font-weight-bold">Kuis Tes</h5>
		        				<h6 class="font-weight-bold">Hasil</h6>
		        				<p class="mb-2">1 dari 11 pertanyaan terjawab dengan benar</p>
		        				<p class="invisible">Waktu kamu: 00:00:07</p>
		        				<div class="px-3 text-center">
		        					<p class="font-weight-bold">Kamu telah menjangkau 10 dari 37 poin, (27,03%)</p>
		        					<div class="border p-2">
		        						<div class="row">
		        							<div class="col-4 border-right">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12" style="line-height: 1;">
		        											<small>Nilai rata-rata</small>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12  pt-0" style="line-height: 1;">
		        											<small>Nilai kamu</small>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        							<div class="col-8 text-left">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8 p-0">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 21%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4 pr-0 pl-2">
		        												<small>21,17%</small>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8 p-0">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 27%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4 pr-0 pl-2">
		        												<small>27,03%</small>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        						</div>
		        					</div>
		        				</div>
		        				<div class="my-3">
		        					<button class="d-inline-block btn btn-info btn-next btn-sm">Mulai ulang kuis</button>
		        					<button class="d-inline-block btn btn-info btn-next btn-sm">Lihat pertanyaan</button>
		        				</div>
		        				<h5 class="font-weight-bold mt-4">Diaktifkan</h5>
		        			</div>
		        		</div>
		        	</div>
		        </div>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan tampilan skor</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="hide_quiz_score" id="hide-score">
		            <label class="custom-control-label" for="hide-score">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Jika pilihan ini diaktifkan, maka skor akhir tidak akan ditampilkan.</small>
		        <div class="demo-wrapper position-relative">
		        	<a href="#" class="text-info"><u>Demo</u></a>
		        	<div class="demo-content position-absolute p-3 shadow rounded">
		        		<div class="row p-2">
		        			<div class="col-md-6 border p-3">
		        				<h5 class="font-weight-bold">Kuis Tes</h5>
		        				<h6 class="font-weight-bold">Hasil</h6>
		        				<p class="mb-2">1 dari 11 pertanyaan terjawab dengan benar</p>
		        				<p>Waktu kamu: 00:00:07</p>
		        				<div class="px-3 text-center">
		        					<p class="font-weight-bold border-bottom-custom">Kamu telah menjangkau 10 dari 37 poin, (27,03%)</p>
		        					<div class="border p-2">
		        						<div class="row">
		        							<div class="col-4 border-right">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12" style="line-height: 1;">
		        											<small>Nilai rata-rata</small>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12 pt-0" style="line-height: 1;">
		        											<small>Nilai kamu</small>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        							<div class="col-8 text-left">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8 p-0">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 21%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4 pr-0 pl-2">
		        												<small>21,17%</small>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8 p-0">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 27%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4 pr-0 pl-2">
		        												<small>27,03%</small>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        						</div>
		        					</div>
		        				</div>
		        				<div class="my-3">
		        					<button class="d-inline-block btn btn-info btn-next btn-sm">Mulai ulang kuis</button>
		        					<button class="d-inline-block btn btn-info btn-next btn-sm">Lihat pertanyaan</button>
		        				</div>
		        				<h5 class="font-weight-bold mt-4">Normal</h5>
		        			</div>
		        			<div class="col-md-6 border p-3">
		        				<h5 class="font-weight-bold">Kuis Tes</h5>
		        				<h6 class="font-weight-bold">Hasil</h6>
		        				<p class="mb-2">1 dari 11 pertanyaan terjawab dengan benar</p>
		        				<p>Waktu kamu: 00:00:07</p>
		        				<div class="px-3 text-center">
		        					<p class="font-weight-bold invisible">Kamu telah menjangkau 10 dari 37 poin, (27,03%)</p>
		        					<div class="border p-2">
		        						<div class="row">
		        							<div class="col-4 border-right">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12" style="line-height: 1;">
		        											<small>Nilai rata-rata</small>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-12  pt-0" style="line-height: 1;">
		        											<small>Nilai kamu</small>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        							<div class="col-8 text-left">
		        								<ul class="list-group border-0 text-left">
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8 p-0">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 21%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4 pr-0 pl-2">
		        												<small>21,17%</small>
		        											</div>
		        										</div>
		        									</li>
		        									<li class="list-group-item border-0 px-0">
		        										<div class="row">
		        											<div class="col-sm-8 p-0">
		        												<div class="progress">
		  															<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 27%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
		        											</div>
		        											<div class="col-sm-4 pr-0 pl-2">
		        												<small>27,03%</small>
		        											</div>
		        										</div>
		        									</li>
		        								</ul>
		        							</div>
		        						</div>
		        					</div>
		        				</div>
		        				<div class="my-3">
		        					<button class="d-inline-block btn btn-info btn-next btn-sm">Mulai ulang kuis</button>
		        					<button class="d-inline-block btn btn-info btn-next btn-sm">Lihat pertanyaan</button>
		        				</div>
		        				<h5 class="font-weight-bold mt-4">Diaktifkan</h5>
		        			</div>
		        		</div>
		        	</div>
		        </div>
		    </div>
		</div>
	</div>
</div>
