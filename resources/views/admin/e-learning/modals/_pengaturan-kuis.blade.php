<div class="mt-3 mb-5 quiz-modal-wrapper">
   <h5 class="d-inline-block quiz-modal-caption mt-4 px-2 text-info">Pilihan</h5>
   <div class="border rounded p-3">
		<div class="row mt-2 mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan judul kuis</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="hide-quiz" id="hide-quiz">
		            <label class="custom-control-label" for="hide-quiz">Aktifkan</label>
		        </div>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan tombol "Mulai ulang kuis"</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="restart-quiz" id="restart-quiz">
		            <label class="custom-control-label" for="restart-quiz">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Sembunyikan tombol "Mulai ulang kuis" pada tampilan aplikasi</small>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Tampilkan kuis secara acak</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="random-quiz" id="random-quiz" checked>
		            <label class="custom-control-label" for="random-quiz">Aktif</label>
		        </div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Tampilkan jawaban secara acak</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="random-answer" id="random-answer" checked>
		            <label class="custom-control-label" for="random-answer">Aktif</label>
		        </div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Statistik</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="quiz-statistic" id="quiz-statistic" checked>
		            <label class="custom-control-label" for="quiz-statistic">Aktif</label>
		        </div>
		        <small class="d-block mt-2">Statistik mengenai jawaban benar dan salah. Statistik akan disimpan saat kuis selesai, bukan setelah setiap pertanyaan.</small>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Kerjakan kuis hanya sekali</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="once-quiz" id="once-quiz">
		            <label class="custom-control-label" for="once-quiz">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Jika mengaktifkan pilihan ini, pengguna dapat melengkapi kuis hanya sekli saja. Setelah itu, kuis akan diblokir untuk pengguna tersebut.</small>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Tampilkan hanya nomor pertanyaan sepisifik</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="specific-number" id="specific-number" checked="">
		            <label class="custom-control-label" for="specific-number">Aktif</label>
		        </div>
		        <small class="d-block my-2">Jika mengaktifkan pilihan ini, maksimal nomor pertanyaan yang ditampilkan akan menjadi X dari X pertanyaan.</small>
		        <p class="mb-1">Berapa banyak pertayaan yang harus ditampilkan? <input type="number" class="d-inline-block col-2 form-control ml-2" value="50"></p>
		        <p class="m-0"><input type="checkbox" value="50" class="d-inline-block checkbox mr-2">dalam persen</p>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Lewatkan pertanyaan</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="skip-quiz" id="skip-quiz">
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
		            <input type="checkbox" class="custom-control-input" name="registered-user" id="registered-user" checked="">
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
		            <input type="checkbox" class="custom-control-input" name="show-point" id="show-point">
		            <label class="custom-control-label" for="show-point">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Tampilkan di kuis, berapa banyak poin untuk masing-masing pertanyaan.</small>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan pemberitahuan Benar-Salah</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="hide-message" id="hide-message" checked>
		            <label class="custom-control-label" for="hide-message">Aktif</label>
		        </div>
		        <small class="d-block mt-2">Jika memilih pilihan ini, maka pesan benar atau salah dari suatu jawaban tidak akan ditampilkan.</small>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Tanda jawaban Benar-Salah</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="answer-mark" id="answer-mark" checked>
		            <label class="custom-control-label" for="answer-mark">Nonaktif</label>
		        </div>
		        <small class="d-block mt-2">Jika memilih pilihan ini, maka jawaban tidak akan diberi warna sebagai tanda benar atau salah.</small>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Wajibkan pengguna untuk menjawab setiap pertanyaan</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="force-answer" id="force-answer">
		            <label class="custom-control-label" for="force-answer">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Jika pilihan ini diaktifkan, pengguna diwajibkan untuk menjawab setiap pertanyaan.</small>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan penomoran pertanyaan</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="hide-numbering" id="hide-numbering" checked>
		            <label class="custom-control-label" for="hide-numbering">Aktif</label>
		        </div>
		        <small class="d-block mt-2">Jika pilihan ini diaktifkan, penomoran pertanyaan disembunyikan</small>
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
		            <input type="checkbox" class="custom-control-input" name="average-point" id="average-point" checked>
		            <label class="custom-control-label" for="average-point">Aktif</label>
		        </div>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan tampilan pertanyaan yang benar</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="hide-correct-question" id="hide-correct-question">
		            <label class="custom-control-label" for="hide-correct-question">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Jika pilihan ini diaktifkan, maka jumlah pertanyaan yang di jawab dengan benar tidak lagi ditampilkan.</small>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan tampilan waktu kuis</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="hide-quiz-time" id="hide-quiz-time">
		            <label class="custom-control-label" for="hide-quiz-time">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Jika pilihan ini diaktifkan, maka waktu untuk menyelesaikan kuis ini tidak akan ditampilkan.</small>
		    </div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<h6 class="font-weight-bold">Sembunyikan tampilan skor</h6>
				<div class="custom-control custom-switch">
		            <input type="checkbox" class="custom-control-input" name="hide-score" id="hide-score">
		            <label class="custom-control-label" for="hide-score">Aktifkan</label>
		        </div>
		        <small class="d-block mt-2">Jika pilihan ini diaktifkan, maka skor akhir tidak akan ditampilkan.</small>
		    </div>
		</div>
	</div>
</div>