<?php


Route::get('/', 'GuruController@index')->name('index');
Route::get("/guru/profile", "GuruController@show")->name("show");
Route::post("/guru/profile/update", "GuruController@update")->name("profile.update");

// Pengumuman
Route::namespace('Pengumuman')->group(function () {
    Route::get('/guru/pengumuman/pesan', 'PesanController@index')
        ->name('pengumuman.pesan');
    Route::post('/guru/pengumuman/pesan', 'PesanController@store');
    Route::get('/guru/pengumuman/pesan/{id}', 'PesanController@edit');
    Route::post('/guru/pengumuman/pesan/update', 'PesanController@update')
        ->name('pengumuman.pesan-update');
    Route::post('/guru/pengumuman/pesan/hapus/{id}', 'PesanController@destroy');
});

// Kalender
Route::namespace('Kalender')->group(function () {
    Route::get('/guru/kalender/kalender-akademik', 'KalenderAkademikController@index')
        ->name('kalender.kalender-akademik');
    Route::post('/guru/kalender/tambah', 'KalenderAkademikController@store')
        ->name('kalender.tambah-event');
    Route::post('/guru/kalender/update/{id}', 'KalenderAkademikController@update')
        ->name('kalender.edit-event');
    Route::get('/guru/kalender/hapus/{id}', 'KalenderAkademikController@destroy');
});

Route::namespace('Fungsionaris')
    ->group(function () {
        Route::get('/guru/fungsionaris/pegawai', 'PegawaiController@index')
        ->name('fungsionaris.pegawai');
        Route::get('/guru/fungsionaris/guru', 'GuruuController@index')
        ->name('fungsionaris.guru');
});

// Sekolah
Route::namespace('Sekolah')->group(function () {
    // Jurusan
    Route::get('/guru/sekolah/jurusan', 'JurusanController@index')
     ->name('sekolah.jurusan');
    Route::post('/guru/sekolah/jurusan', 'JurusanController@store');
    Route::get('/guru/sekolah/jurusan/{id}', 'JurusanController@edit');
    Route::post('/guru/sekolah/jurusan/update', 'JurusanController@update')
        ->name('sekolah.jurusan-update');
    Route::get('/guru/sekolah/jurusan/hapus/{id}', 'JurusanController@destroy');

    // Kelas
    Route::get('/guru/sekolah/kelas', 'KelasController@index')
    ->name('sekolah.kelas');
    Route::post('/guru/sekolah/kelas', 'KelasController@store');
    Route::get('/guru/sekolah/kelas/{id}', 'KelasController@edit')
        ->name('sekolah.kelas-edit');
    Route::post('/guru/sekolah/kelas/update', 'KelasController@update')
       ->name('sekolah.kelas-update');
    Route::get('/guru/sekolah/kelas/hapus/{id}', 'KelasController@destroy');

     // Jam Pelajaran
     Route::get('/guru/sekolah/jam-pelajaran', 'JamPelajaranController@index')
         ->name('sekolah.jam-pelajaran');
     Route::post('/guru/sekolah/jam-pelajaran', 'JamPelajaranController@write')
         ->name('sekolah.jam-pelajaran.write');
});

// Pelajaran
Route::namespace('Pelajaran')->prefix('/pelajaran')->name('pelajaran.')->group(function () {
    // Pelajaran
    Route::get('mata-pelajaran', 'MataPelajaranController@index')->name('mata-pelajaran');
    // Jadwal Pelajaran
    Route::get('/guru/pelajaran/jadwal-pelajaran', 'JadwalPelajaranController@index')->name('jadwal-pelajaran');
});

// Peserta Didik
Route::namespace('PesertaDidik')->prefix('/peserta-didik')->name('pesertadidik.')->group(function () {
        Route::get('siswa', 'SiswaController@index')->name('siswa');

        // Route::get('alumni', 'AlumniController@index')
        //     ->name('alumni');
        // Route::get('pindah-kelas', 'PindahKelasController@index')
        //     ->name('pindah-kelas');
        // Route::get('tidak-naik-kelas', 'TidakNaikKelasController@index')
        //     ->name('tidak-naik-kelas');
        // Route::get('pengaturan-siswa-per-kelas', 'PengaturanSiswaPerKelasController@index')
        //     ->name('pengaturan-siswa-per-kelas');
        // Route::get('siswa-pindahan', 'SiswaPindahanController@index')
        //     ->name('siswa-pindahan');
});

// Absensi

Route::namespace('Absensi')->prefix('/absensi')->name('absensi.')->group(function () {
    Route::get('siswa', 'SiswaGuruController@index')->name('siswa');
    Route::post('approve', 'SiswaGuruController@approve')->name('siswa.approve');
    Route::post('approve-all', 'SiswaGuruController@approveAll')->name('siswa.approve-all');

    Route::get('rekap-siswa', 'RekapSiswaGuruController@index')->name('rekap-siswa');
});

// Daftar Nilai
Route::resource('daftar-nilai', 'DaftarNilai\DaftarNilaiController');
Route::namespace('DaftarNilai')->group(function () {
    Route::get('/guru/daftar-nilai', 'DaftarNilaiController@index')
        ->name('daftar-nilai');
    Route::post('/guru/daftar-nilai', 'DaftarNilaiController@store')
        ->name('daftar-nilai.store');
    Route::put('/guru/daftar-nilai', 'DaftarNilaiController@update')
        ->name('daftar-nilai.update');
    Route::delete('/guru/daftar-nilai', 'DaftarNilaiController@destroy')
        ->name('daftar-nilai.destroy');
});

// E-Rapor
Route::namespace('ERapor')->group(function () {
    Route::get('/guru/e-rapor/kenaikan-kelas', 'KenaikanKelasController@index')
        ->name('e-rapor.kenaikan-kelas');
});

// Pelanggaran
Route::namespace('Pelanggaran')->group(function () {
    Route::get('/guru/pelanggaran/siswa', 'SiswaController@index')
        ->name('pelanggaran.siswa');
    Route::post('/guru/pelanggaran/siswa', 'SiswaController@store');
    Route::get('/guru/pelanggaran/siswa/{id}', 'SiswaController@edit');
    Route::post('/guru/pelanggaran/siswa/update', 'SiswaController@update')
        ->name('pelanggaran.siswa-update');
    Route::get('/guru/pelanggaran/siswa/hapus/{id}', 'SiswaController@destroy');
});

// Referensi
Route::namespace('Referensi')->group(function () {
    // Bagian Pegawai
    Route::get('/guru/referensi/bagian-pegawai', 'BagianPegawaiController@index')
        ->name('referensi.bagian-pegawai');
    Route::post('/guru/referensi/bagian-pegawai', 'BagianPegawaiController@store');
    Route::get('/guru/referensi/bagian-pegawai/{id}', 'BagianPegawaiController@edit');
    Route::post('/guru/referensi/bagian-pegawai/update', 'BagianPegawaiController@update')
        ->name('referensi.bagian-pegawai-update');
    Route::get('/guru/referensi/bagian-pegawai/hapus/{id}', 'BagianPegawaiController@destroy');

    // Semester
    Route::get('/guru/referensi/semester', 'SemesterController@index')
        ->name('referensi.semester');
    Route::post('/guru/referensi/semester', 'SemesterController@store');
    Route::get('/guru/referensi/semester/{id}', 'SemesterController@edit');
    Route::post('/guru/referensi/semester/update', 'SemesterController@update')
        ->name('referensi.semester-update');
    Route::get('/guru/referensi/semester/hapus/{id}', 'SemesterController@destroy');

    // Status Guru
    Route::get('/guru/referensi/status-guru', 'StatusGuruController@index')
        ->name('referensi.status-guru');
    Route::post('/guru/referensi/status-guru', 'StatusGuruController@store');
    Route::get('/guru/referensi/status-guru/{id}', 'StatusGuruController@edit');
    Route::post('/guru/referensi/status-guru/update', 'StatusGuruController@update')
        ->name('referensi.status-guru-update');
    Route::get('/guru/referensi/status-guru/hapus/{id}', 'StatusGuruController@destroy');

    // Jenjang pegawai
    Route::get('/guru/referensi/jenjang-pegawai', 'JenjangPegawaiController@index')
        ->name('referensi.jenjang-pegawai');
    Route::post('/guru/referensi/jenjang-pegawai', 'JenjangPegawaiController@store');
    Route::get('/guru/referensi/jenjang-pegawai/{id}', 'JenjangPegawaiController@edit');
    Route::post('/guru/referensi/jenjang-pegawai/update', 'JenjangPegawaiController@update')
        ->name('referensi.jenjang-pegawai-update');
    Route::get('/guru/referensi/jenjang-pegawai/hapus/{id}', 'JenjangPegawaiController@destroy');

    Route::get('/guru/referensi/pengaturan-hak-akses', 'PengaturanHakAksesController@index')
        ->name('referensi.pengaturan-hak-akses');
    Route::post('/guru/referensi/pengaturan-hak-akses/update', 'PengaturanHakAksesController@update')
        ->name('referensi.pengaturan-hak-akses-update');

    // Tingkatan Kelas
    Route::get('/guru/referensi/tingkatan-kelas', 'TingkatanKelasController@index')
        ->name('referensi.tingkatan-kelas');
    Route::post('/guru/referensi/tingkatan-kelas', 'TingkatanKelasController@store');
    Route::get('/guru/referensi/tingkatan-kelas/{id}', 'TingkatanKelasController@edit');
    Route::post('/guru/referensi/tingkatan-kelas/update', 'TingkatanKelasController@update')
        ->name('referensi.tingkatan-kelas-update');
    Route::get('/guru/referensi/tingkatan-kelas/hapus/{id}', 'TingkatanKelasController@destroy');
});

// E-Voting
Route::namespace('EVoting')->group(function () {
    Route::get('/guru/e-voting/calon', 'CalonController@index')
        ->name('e-voting.calon');
    Route::post('/guru/e-voting/calon', 'CalonController@store');
    Route::get('/guru/e-voting/calon/{id}', 'CalonController@edit');
    Route::post('/guru/e-voting/calon/update', 'CalonController@update')
        ->name('e-voting.calon-update');
    Route::get('/guru/e-voting/calon/hapus/{id}', 'CalonController@destroy');


    Route::get('/guru/e-voting/posisi', 'PosisiController@index')
        ->name('e-voting.posisi');
    Route::post('/guru/e-voting/posisi', 'PosisiController@store');
    Route::get('/guru/e-voting/posisi/{id}', 'PosisiController@edit');
    Route::post('/guru/e-voting/posisi/update', 'PosisiController@update')
        ->name('e-voting.posisi-update');
    Route::get('/guru/e-voting/posisi/hapus/{id}', 'PosisiController@destroy');



    Route::get('/guru/e-voting/pemilihan', 'PemilihanController@index')
        ->name('e-voting.pemilihan');
    Route::post('/guru/e-voting/pemilihan', 'PemilihanController@store');
    Route::get('/guru/e-voting/pemilihan/{id}', 'PemilihanController@edit');
    Route::post('/guru/e-voting/pemilihan/update', 'PemilihanController@update')
        ->name('e-voting.pemilihan-update');
    Route::get('/guru/e-voting/pemilihan/hapus/{id}', 'PemilihanController@destroy')->name('e-voting.pemilihan-destroy');

    Route::get('/guru/e-voting/vote', 'VoteController@index')
        ->name('e-voting.vote');
    Route::post('/guru/e-voting/vote', 'VoteController@store');
    Route::get('/guru/e-voting/vote/{id}', 'VoteController@edit');
    Route::post('/guru/e-voting/vote/update', 'VoteController@update')
        ->name('e-voting.vote-update');
    Route::get('/guru/e-voting/vote/hapus/{id}', 'VoteController@destroy');
});

// E-learning
Route::namespace('ELearning')->group(function () {
    // Materi
    Route::get('e-learning/materi', 'MateriController@index')->name('e-learning.materi');
    Route::post('e-learning/materi', 'MateriController@store')->name('e-learning.materi.store');
    Route::get('e-learning/materi/{id}', 'MateriController@edit')->name('e-learning.materi.edit');
    Route::post('e-learning/materi/update', 'MateriController@update')->name('e-learning.materi.update');
    Route::get('e-learning/materi/hapus/{id}', 'MateriController@destroy')->name('e-learning.materi.delete');

    // Kuis
    Route::get('e-learning/kuis', 'KuisController@index')->name('e-learning.kuis');
    Route::post('e-learning/kuis', 'KuisController@store')->name('e-learning.kuis.store');
    Route::get('e-learning/kuis/{id}', 'KuisController@edit')->name('e-learning.kuis.edit');
    Route::post('e-learning/kuis/update', 'KuisController@update')->name('e-learning.kuis.update');
    Route::get('e-learning/kuis/hapus/{id}', 'KuisController@destroy')->name('e-learning.kuis.delete');

    // Soal
    Route::get('e-learning/soal', 'SoalController@index')->name('e-learning.soal');
    Route::post('e-learning/soal', 'SoalController@store')->name('e-learning.soal.store');
    Route::get('e-learning/soal/{id}', 'SoalController@edit')->name('e-learning.soal.edit');
    Route::post('e-learning/soal/update', 'SoalController@update')->name('e-learning.soal.update');
    Route::get('e-learning/soal/hapus/{id}', 'SoalController@destroy')->name('e-learning.soal.delete');

    // Butir Soal
    Route::get('e-learning/butir-soal', 'ButirSoalController@index')->name('e-learning.butir-soal');
    Route::post('e-learning/butir-soal', 'ButirSoalController@store')->name('e-learning.butir-soal.store');
    Route::get('e-learning/butir-soal/{id}', 'ButirSoalController@edit')->name('e-learning.butir-soal.edit');
    Route::post('e-learning/butir-soal/update', 'ButirSoalController@update')->name('e-learning.butir-soal.update');
    Route::get('e-learning/butir-soal/hapus/{id}', 'ButirSoalController@destroy')->name('e-learning.butir-soal.delete');

    // Nilai
    Route::get('e-learning/nilai', 'NilaiController@index')->name('e-learning.nilai');
    Route::post('e-learning/nilai', 'NilaiController@store')->name('e-learning.nilai.store');
    Route::get('e-learning/nilai{id}', 'NilaiController@edit');
    Route::post('e-learning/nilai/update', 'NilaiController@update')
        ->name('e-learning.nilai-update');
});

// Forum
Route::namespace('Forum')->group(function () {
    // Dashboard
    Route::get('/guru/forum/dashboard', 'DashboardController@index')
        ->name('forum.dashboard');
    Route::post('/guru/forum/dashboard', 'DashboardController@store')
        ->name('forum.dashboard.store');
    Route::get('/guru/forum/dashboard/{id}', 'DashboardController@edit');
    Route::post('/guru/forum/dashboard/update', 'DashboardController@update')
        ->name('forum.dashboard-update');
    Route::get('/guru/forum/dashboard/hapus/{id}', 'DashboardController@destroy');
    
    // Pengguna
    Route::get('/guru/forum/pengguna', 'PenggunaController@index')
        ->name('forum.pengguna');
    Route::post('/guru/forum/pengguna', 'PenggunaController@store');
    Route::get('/guru/forum/pengguna/{id}', 'PenggunaController@edit');
    Route::post('/guru/forum/pengguna/update', 'PenggunaController@update')
        ->name('forum.pengguna.update');
    Route::get('/guru/forum/pengguna/hapus/{id}', 'PenggunaController@destroy');

    // Balasan
    Route::get('/guru/forum/balasan', 'BalasanController@index')
        ->name('forum.balasan');
    Route::get('guru/forum/balasan/edit/{id}', 'BalasanController@edit')
        ->name('balasan.edit');
    Route::post('guru/forum/balasan', 'BalasanController@store')
        ->name('balasan.store');
    Route::post('guru/forum/balasan/update', 'BalasanController@update')
        ->name('balasan.update');
    Route::get('guru/forum/balasan/delete/{id}', 'BalasanController@destroy');

    // Pengaturan
    Route::get('/guru/forum/pengaturan-forum', 'PengaturanController@index')
        ->name('forum.pengaturan-forum');
    Route::post('/guru/forum/pengaturan-forum', 'PengaturanController@store')
        ->name('forum.pengaturan-forum.store');
    Route::get('/guru/forum/pengaturan-forum/{id}', 'PengaturanController@edit')
        ->name('forum.pengaturan-forum.edit');
    Route::post('/guru/forum/pengaturan-forum/update', 'PengaturanController@update')
        ->name('forum.pengaturan-forum.update');
    Route::get('/guru/forum/pengaturan-forum/hapus/{id}', 'PengaturanController@destroy')
        ->name('forum.pengaturan-forum.delete');
});
