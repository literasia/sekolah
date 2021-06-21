<?php


Route::get('/admin', 'AdminController@index')
            ->name('index');
Route::get('/siswa-by-tahun', 'AdminController@getSiswasByTahun')
    ->name('siswa.by.tahun');

// Peserta Didik
Route::namespace('PesertaDidik')
    ->prefix('admin/peserta-didik')
    ->name('pesertadidik.')
    ->group(function () {
        Route::resource('siswa', 'SiswaController');
        // Route::get('/admin/peserta-didik/siswa', 'SiswaController@index')
        //     ->name('pesertadidik.siswa');
        Route::get('alumni', 'AlumniController@index')
            ->name('alumni');
        Route::get('pindah-kelas', 'PindahKelasController@index')
            ->name('pindah-kelas');
        Route::get('tidak-naik-kelas', 'TidakNaikKelasController@index')
            ->name('tidak-naik-kelas');
        Route::get('pengaturan-siswa-per-kelas', 'PengaturanSiswaPerKelasController@index')
            ->name('pengaturan-siswa-per-kelas');
        Route::get('siswa-pindahan', 'SiswaPindahanController@index')
            ->name('siswa-pindahan');
});

// Pelanggaran
Route::namespace('Pelanggaran')->group(function () {
    Route::get('/admin/pelanggaran/siswa', 'SiswaController@index')->name('pelanggaran.siswa');
    Route::post('/admin/pelanggaran/siswa', 'SiswaController@store');
    Route::get('/admin/pelanggaran/siswa/{id}', 'SiswaController@edit');
    Route::post('/admin/pelanggaran/siswa/update', 'SiswaController@update')->name('pelanggaran.siswa-update');
    Route::get('/admin/pelanggaran/siswa/hapus/{id}', 'SiswaController@destroy');

    Route::get('/admin/pelanggaran/kategori-pelanggaran', 'KategoriPelanggaranController@index')->name('pelanggaran.kategori-pelanggaran');
    Route::post('/admin/pelanggaran/kategori-pelanggaran', 'KategoriPelanggaranController@store');
    Route::get('/admin/pelanggaran/kategori-pelanggaran/{id}', 'KategoriPelanggaranController@edit');
    Route::post('/admin/pelanggaran/kategori-pelanggaran/update', 'KategoriPelanggaranController@update')->name('pelanggaran.kategori-pelanggaran-update');
    Route::get('/admin/pelanggaran/kategori-pelanggaran/hapus/{id}', 'KategoriPelanggaranController@destroy');

    Route::get('/admin/pelanggaran/sanksi', 'SanksiController@index')->name('pelanggaran.sanksi');
    Route::post('/admin/pelanggaran/sanksi', 'SanksiController@store');
    Route::get('/admin/pelanggaran/sanksi/{id}', 'SanksiController@edit');
    Route::post('/admin/pelanggaran/sanksi/update', 'SanksiController@update')->name('pelanggaran.sanksi-update');
    Route::get('/admin/pelanggaran/sanksi/hapus/{id}', 'SanksiController@destroy');



    Route::get('/admin/pelanggaran/surat-peringatan', 'SuratPeringatanController@index')->name('pelanggaran.surat-peringatan');
    Route::post('/admin/pelanggaran/surat-peringatan', 'SuratPeringatanController@store');
    Route::get('/admin/pelanggaran/surat-peringatan/{id}', 'SuratPeringatanController@edit');
    Route::post('/admin/pelanggaran/surat-peringatan/update', 'SuratPeringatanController@update')->name('pelanggaran.surat-peringatan-update');
    Route::get('/admin/pelanggaran/surat-peringatan/hapus/{id}', 'SuratPeringatanController@destroy');
});

// E-Voting
Route::namespace('EVoting')->group(function () {
    Route::get('/admin/e-voting/calon', 'CalonController@index')->name('e-voting.calon');
    Route::post('/admin/e-voting/calon', 'CalonController@store');
    Route::get('/admin/e-voting/calon/{id}', 'CalonController@edit');
    Route::post('/admin/e-voting/calon/update', 'CalonController@update')->name('e-voting.calon-update');
    Route::get('/admin/e-voting/calon/hapus/{id}', 'CalonController@destroy');


    Route::get('/admin/e-voting/posisi', 'PosisiController@index')
        ->name('e-voting.posisi');
    Route::post('/admin/e-voting/posisi', 'PosisiController@store');
    Route::get('/admin/e-voting/posisi/{id}', 'PosisiController@edit');
    Route::post('/admin/e-voting/posisi/update', 'PosisiController@update')
        ->name('e-voting.posisi-update');
    Route::get('/admin/e-voting/posisi/hapus/{id}', 'PosisiController@destroy');

    Route::get('/admin/e-voting/pemilihan', 'PemilihanController@index')->name('e-voting.pemilihan');
    Route::post('/admin/e-voting/pemilihan', 'PemilihanController@store');
    Route::get('/admin/e-voting/pemilihan/{id}', 'PemilihanController@edit');
    Route::get('/admin/e-voting/pemilihan/kelas/{id}', 'PemilihanController@getKelas')->name('e-voting.pemilihan.kelas');
    Route::post('/admin/e-voting/pemilihan/update', 'PemilihanController@update')
        ->name('e-voting.pemilihan-update');
    Route::get('/admin/e-voting/pemilihan/hapus/{id}', 'PemilihanController@destroy')->name('e-voting.pemilihan-destroy');

    Route::get('/admin/e-voting/vote', 'VoteController@index')
        ->name('e-voting.vote');
    Route::post('/admin/e-voting/vote', 'VoteController@store');
    Route::get('/admin/e-voting/vote/{id}', 'VoteController@edit');
    Route::post('/admin/e-voting/vote/update', 'VoteController@update')
        ->name('e-voting.vote-update');
    Route::get('/admin/e-voting/vote/hapus/{id}', 'VoteController@destroy');
});

// Fungsionaris
Route::namespace('Fungsionaris')->name('fungsionaris.')->group(function () {
    // Pegawai
    Route::get('admin/fungsionaris/pegawai', 'PegawaiController@index')->name('pegawai');
    Route::get('admin/fungsionaris/pegawai/edit/{id}', 'PegawaiController@edit')->name('pegawai.edit');
    Route::post('admin/fungsionaris/pegawai', 'PegawaiController@store')->name('pegawai.store');
    Route::post('admin/fungsionaris/pegawai/update', 'PegawaiController@update')->name('pegawai.update');
    Route::get('admin/fungsionaris/pegawai/delete/{id}', 'PegawaiController@destroy');
    Route::get('getKabupaten/{id}', 'PegawaiController@getKabupatenKota');
    Route::get('getKecamatan/{id}', 'PegawaiController@getKecamatan');

    // Guru
    Route::get('admin/fungsionaris/guru', 'GuruController@index')->name('guru');
    Route::get('admin/fungsionaris/guru/edit/{id}', 'GuruController@edit')->name('guru.edit');
    Route::post('admin/fungsionaris/guru', 'GuruController@store')->name('guru.store');
    Route::post('admin/fungsionaris/guru/update', 'GuruController@update')->name('guru.update');
    Route::get('admin/fungsionaris/guru/delete/{id}', 'GuruController@destroy');
});

     // Sekolah
Route::namespace('Sekolah')->group(function () {

    // Semester
    Route::get('/admin/sekolah/semester', 'SemesterController@index')
        ->name('sekolah.semester');
    Route::post('/admin/sekolah/semester', 'SemesterController@store');
    Route::get('/admin/sekolah/semester/{id}', 'SemesterController@edit');
    Route::post('/admin/sekolah/semester/update', 'SemesterController@update')
        ->name('sekolah.semester-update');
    Route::get('/admin/sekolah/semester/hapus/{id}', 'SemesterController@destroy');

        // Tahun Ajaran
    Route::get('/admin/sekolah/tahun-ajaran', 'TahunAjaranController@index')
        ->name('sekolah.tahun-ajaran');
    Route::post('/admin/sekolah/tahun-ajaran', 'TahunAjaranController@store');
    Route::get('/admin/sekolah/tahun-ajaran/{id}', 'TahunAjaranController@edit');
    Route::post('/admin/sekolah/tahun-ajaran/update', 'TahunAjaranController@update')
        ->name('sekolah.tahun-ajaran-update');
    Route::get('/admin/sekolah/tahun-ajaran/hapus/{id}', 'TahunAjaranController@destroy');

    // Jurusan
    Route::get('/admin/sekolah/jurusan', 'JurusanController@index')
     ->name('sekolah.jurusan');
    Route::post('/admin/sekolah/jurusan', 'JurusanController@store');
    Route::get('/admin/sekolah/jurusan/{id}', 'JurusanController@edit');
    Route::post('/admin/sekolah/jurusan/update', 'JurusanController@update')
        ->name('sekolah.jurusan-update');
    Route::get('/admin/sekolah/jurusan/hapus/{id}', 'JurusanController@destroy');

    // Kelas
    Route::get('/admin/sekolah/kelas', 'KelasController@index')
    ->name('sekolah.kelas');
    Route::post('/admin/sekolah/kelas', 'KelasController@store');
    Route::get('/admin/sekolah/kelas/{id}', 'KelasController@edit')
        ->name('sekolah.kelas-edit');
    Route::post('/admin/sekolah/kelas/update', 'KelasController@update')
       ->name('sekolah.kelas-update');
    Route::get('/admin/sekolah/kelas/hapus/{id}', 'KelasController@destroy');

    // Jam Pelajaran
    Route::get('/admin/sekolah/jam', 'JamPelajaranController@index')
        ->name('sekolah.jam');
    Route::post('/admin/sekolah/jam', 'JamPelajaranController@write')
        ->name('sekolah.jam.write');
 });

// Pelajaran
Route::namespace('Pelajaran')->group(function () {
    // Pelajaran
    Route::get('/admin/pelajaran/mata-pelajaran', 'MataPelajaranController@index')
        ->name('pelajaran.mata-pelajaran');
    Route::post('/admin/pelajaran/mata-pelajaran', 'MataPelajaranController@write')
        ->name('pelajaran.mata-pelajaran.write');

    // Jadwal Pelajaran
    Route::get('/admin/pelajaran/jadwal-pelajaran', 'JadwalPelajaranController@index')->name('pelajaran.jadwal-pelajaran');
    Route::post('/admin/pelajaran/jadwal-pelajaran/getJamPelajaran', 'JadwalPelajaranController@getJamPelajaran')->name('pelajaran.jadwal-pelajaran.getJamPelajaran');
    Route::post('/admin/pelajaran/jadwal-pelajaran', 'JadwalPelajaranController@write')->name('pelajaran.jadwal-pelajaran.write');
});

// Absensi
Route::namespace('Absensi')->group(function () {
    // Siswa
    Route::get('/admin/absensi/siswa', 'SiswaController@index')
        ->name('absensi.siswa');
    Route::post('/admin/absensi/siswa', 'SiswaController@write')
        ->name('absensi.siswa.write');

    // Rekap Siswa
    Route::get('/admin/absensi/rekap-siswa', 'RekapSiswaController@index')
        ->name('absensi.rekap-siswa');

    //QR Code
    Route::get('/admin/absensi/qr-code', 'QRCodeController@index')
        ->name('absensi.qr-code');
});

// Daftar Nilai
Route::resource('daftar-nilai', 'DaftarNilai\DaftarNilaiController');
Route::namespace('DaftarNilai')->group(function () {

    Route::get('/admin/daftar-nilai', 'DaftarNilaiController@index')
        ->name('daftar-nilai');
    Route::post('/admin/daftar-nilai', 'DaftarNilaiController@store')->name('daftar-nilai.store');
    Route::put('/admin/daftar-nilai', 'DaftarNilaiController@update')->name('daftar-nilai.update');
    Route::delete('/admin/daftar-nilai', 'DaftarNilaiController@destroy')->name('daftar-nilai.destroy');
});

// Kalender
Route::namespace('Kalender')->group(function () {
    Route::get('/admin/kalender/kalender-akademik', 'KalenderAkademikController@index')
        ->name('kalender.kalender-akademik');
    Route::post('/admin/kalender/tambah', 'KalenderAkademikController@store')->name('kalender.tambah-event');
    Route::post('/admin/kalender/update/{id}', 'KalenderAkademikController@update')->name('kalender.edit-event');
    Route::get('/admin/kalender/hapus/{id}', 'KalenderAkademikController@destroy');
});

// Import
Route::namespace('Import')->group(function () {
    Route::get('/admin/import/import-siswa', 'SiswaController@index')
        ->name('import.import-siswa');
    Route::post('/admin/import/import-siswa/import_excel', 'SiswaController@import_excel')
        ->name('import.import-siswa.import_excel');
});

// E-Rapor
Route::namespace('ERapor')->group(function () {
    Route::get('/admin/e-rapor/kenaikan-kelas', 'KenaikanKelasController@index')
        ->name('e-rapor.kenaikan-kelas');
    Route::post('/admin/e-rapor/kenaikan-kelas/get', 'KenaikanKelasController@index')
        ->name('e-rapor.kenaikan-kelas.get');
    Route::post('/admin/e-rapor/kenaikan-kelas/add', 'KenaikanKelasController@store')
        ->name('e-rapor.kenaikan-kelas.add');
});

Route::namespace('Profile')->group(function(){
    Route::get('/admin/profile', 'ProfileController@index')->name('profile.profile');
    Route::post('/admin/profile/update', 'ProfileController@changeProfile')->name('profile.change-profile');
});

// E-Learning
Route::namespace('ELearning')->group(function () {
    // Materi
    Route::get('/admin/e-learning/materi', 'MateriController@index')->name('e-learning.materi');
    Route::post('/admin/e-learning/materi', 'MateriController@store')->name('e-learning.materi.store');
    Route::get('/admin/e-learning/materi/{id}', 'MateriController@edit')->name('e-learning.materi.edit');
    Route::post('/admin/e-learning/materi/update', 'MateriController@update')->name('e-learning.materi.update');
    Route::get('/admin/e-learning/materi/hapus/{id}', 'MateriController@destroy')->name('e-learning.materi.delete');

    // Kuis
    Route::get('/admin/e-learning/kuis', 'KuisController@index')->name('e-learning.kuis');
    Route::post('/admin/e-learning/kuis', 'KuisController@store')->name('e-learning.kuis.store');
    Route::get('/admin/e-learning/kuis/{id}', 'KuisController@edit')->name('e-learning.kuis.edit');
    Route::post('/admin/e-learning/kuis/update', 'KuisController@update')->name('e-learning.kuis.update');
    Route::get('/admin/e-learning/kuis/hapus/{id}', 'KuisController@destroy')->name('e-learning.kuis.delete');

    // Soal
    Route::get('/admin/e-learning/soal', 'SoalController@index')->name('e-learning.soal');
    Route::post('/admin/e-learning/soal', 'SoalController@store')->name('e-learning.soal.store');
    Route::get('/admin/e-learning/soal/{id}', 'SoalController@edit')->name('e-learning.soal.edit');
    Route::post('/admin/e-learning/soal/update', 'SoalController@update')->name('e-learning.soal.update');
    Route::get('/admin/e-learning/soal/hapus/{id}', 'SoalController@destroy')->name('e-learning.soal.delete');

    // Butir Soal
    Route::get('/admin/e-learning/butir-soal', 'ButirSoalController@index')->name('e-learning.butir-soal');
    Route::post('/admin/e-learning/butir-soal', 'ButirSoalController@store')->name('e-learning.butir-soal.store');
    Route::get('/admin/e-learning/butir-soal/{id}', 'ButirSoalController@edit')->name('e-learning.butir-soal.edit');
    Route::post('/admin/e-learning/butir-soal/update', 'ButirSoalController@update')->name('e-learning.butir-soal.update');
    Route::get('/admin/e-learning/butir-soal/hapus/{id}', 'ButirSoalController@destroy')->name('e-learning.butir-soal.delete');
});

// CBT
Route::namespace('CBT')->group(function () {
    // Ujian
    // Route::get('/admin/cbt/ujian', 'UjianController@index')->name('cbt.ujian');
    Route::get('/admin/cbt/ujian', 'UjianController@index')->name('cbt.ujian');
    Route::post('/admin/cbt/ujian', 'UjianController@store')->name('cbt.ujian.store');
    Route::get('/admin/cbt/ujian/{id}', 'UjianController@edit')->name('cbt.ujian.edit');
    Route::post('/admin/cbt/ujian/update', 'UjianController@update')->name('cbt.ujian.update');
    Route::get('/admin/cbt/ujian/hapus/{id}', 'UjianController@destroy')->name('cbt.ujian.delete');

    // Soal
    // Route::get('/admin/cbt/soal-ujian', 'SoalUjianController@index')->name('cbt.soal-ujian');
    Route::get('/admin/cbt/soal-ujian', 'SoalUjianController@index')->name('cbt.soal-ujian');
    Route::post('/admin/cbt/soal-ujian', 'SoalUjianController@store')->name('cbt.soal-ujian.store');
    Route::get('/admin/cbt/soal-ujian/{id}', 'SoalUjianController@edit')->name('cbt.soal-ujian.edit');
    Route::post('/admin/cbt/soal-ujian/update', 'SoalUjianController@update')->name('cbt.soal-ujian.update');
    Route::get('/admin/cbt/soal-ujian/hapus/{id}', 'SoalUjianController@destroy')->name('cbt.soal-ujian.delete');

    // Butir Soal
    // Route::get('/admin/cbt/butir-soal-ujian', 'ButirSoalUjianController@index')->name('cbt.butir-soal-ujian');
    Route::get('/admin/cbt/butir-soal-ujian', 'ButirSoalUjianController@index')->name('cbt.butir-soal-ujian');
    Route::post('/admin/cbt/butir-soal-ujian', 'ButirSoalUjianController@store')->name('cbt.butir-soal-ujian.store');
    Route::get('/admin/cbt/butir-soal-ujian/{id}', 'ButirSoalUjianController@edit')->name('cbt.butir-soal-ujian.edit');
    Route::post('/admin/cbt/butir-soal-ujian/update', 'ButirSoalUjianController@update')->name('cbt.butir-soal-ujian.update');
    Route::get('/admin/cbt/butir-soal-ujian/hapus/{id}', 'ButirSoalUjianController@destroy')->name('cbt.butir-soal-ujian.delete');

    // Penilaian
    Route::get('/admin/cbt/penilaian', 'PenilaianController@index')->name('cbt.penilaian');

    // Ranking
    Route::get('/admin/cbt/ranking', 'RankingController@index')->name('cbt.ranking');
});

// Bank Soal
Route::namespace('BankSoal')->group(function () {
    // Route::get('/admin/banksoal/soal', 'SoalController@index')
    //     ->name('banksoal.soal');
    //Soal
    Route::get('/admin/banksoal/soal', 'SoalController@index')->name('banksoal.soal');
    Route::post('/admin/banksoal/soal', 'SoalController@store')->name('banksoal.soal.store');
    Route::get('/admin/banksoal/soal/{id}', 'SoalController@edit')->name('banksoal.soal.edit');
    Route::post('/admin/banksoal/soal/update', 'SoalController@update')->name('banksoal.soal.update');
    Route::get('/admin/banksoal/soal/hapus/{id}', 'SoalController@destroy')->name('banksoal.soal.delete');
    
    //Butir Soal
    Route::get('/admin/banksoal/butir-soal', 'ButirSoalController@index')->name('banksoal.butir-soal');
    Route::post('/admin/banksoal/butir-soal', 'ButirSoalController@store')->name('banksoal.butir-soal.store');
    Route::get('/admin/banksoal/butir-soal/{id}', 'ButirSoalController@edit')->name('banksoal.butir-soal.edit');
    Route::post('/admin/banksoal/butir-soal/update', 'ButirSoalController@update')->name('banksoal.butir-soal.update');
    Route::get('/admin/banksoal/butir-soal/hapus/{id}', 'ButirSoalController@destroy')->name('banksoal.butir-soal.delete');
});

// Referensi
Route::namespace('Referensi')->group(function () {
    // Bagian Pegawai
    Route::get('/admin/referensi/bagian-pegawai', 'BagianPegawaiController@index')
        ->name('referensi.bagian-pegawai');
    Route::post('/admin/referensi/bagian-pegawai', 'BagianPegawaiController@store');
    Route::get('/admin/referensi/bagian-pegawai/{id}', 'BagianPegawaiController@edit');
    Route::post('/admin/referensi/bagian-pegawai/update', 'BagianPegawaiController@update')
        ->name('referensi.bagian-pegawai-update');
    Route::get('/admin/referensi/bagian-pegawai/hapus/{id}', 'BagianPegawaiController@destroy');

    // Status Guru
    Route::get('/admin/referensi/status-guru', 'StatusGuruController@index')
        ->name('referensi.status-guru');
    Route::post('/admin/referensi/status-guru', 'StatusGuruController@store');
    Route::get('/admin/referensi/status-guru/{id}', 'StatusGuruController@edit');
    Route::post('/admin/referensi/status-guru/update', 'StatusGuruController@update')
        ->name('referensi.status-guru-update');
    Route::get('/admin/referensi/status-guru/hapus/{id}', 'StatusGuruController@destroy');

    // Jenjang pegawai
    Route::get('/admin/referensi/jenjang-pegawai', 'JenjangPegawaiController@index')
        ->name('referensi.jenjang-pegawai');
    Route::post('/admin/referensi/jenjang-pegawai', 'JenjangPegawaiController@store');
    Route::get('/admin/referensi/jenjang-pegawai/{id}', 'JenjangPegawaiController@edit');
    Route::post('/admin/referensi/jenjang-pegawai/update', 'JenjangPegawaiController@update')
        ->name('referensi.jenjang-pegawai-update');
    Route::get('/admin/referensi/jenjang-pegawai/hapus/{id}', 'JenjangPegawaiController@destroy');

    Route::get('/admin/referensi/pengaturan-hak-akses', 'PengaturanHakAksesController@index')
        ->name('referensi.pengaturan-hak-akses');
    Route::post('/admin/referensi/pengaturan-hak-akses/update', 'PengaturanHakAksesController@update')
        ->name('referensi.pengaturan-hak-akses-update');

    // Tingkatan Kelas
    Route::get('/admin/referensi/tingkatan-kelas', 'TingkatanKelasController@index')
        ->name('referensi.tingkatan-kelas');
    Route::post('/admin/referensi/tingkatan-kelas', 'TingkatanKelasController@store');
    Route::get('/admin/referensi/tingkatan-kelas/{id}', 'TingkatanKelasController@edit');
    Route::post('/admin/referensi/tingkatan-kelas/update', 'TingkatanKelasController@update')
        ->name('referensi.tingkatan-kelas-update');
    Route::get('/admin/referensi/tingkatan-kelas/hapus/{id}', 'TingkatanKelasController@destroy');
});

// Kalender
Route::namespace('Kalender')->group(function () {
    Route::get('/admin/kalender/kalender-akademik', 'KalenderAkademikController@index')->name('kalender.kalender-akademik');
});

// Pengumuman
Route::namespace('Pengumuman')->group(function () {
    Route::get('/admin/pengumuman/pesan', 'PesanController@index')->name('pengumuman.pesan');
    Route::post('/admin/pengumuman/pesan', 'PesanController@store');
    Route::get('/admin/pengumuman/pesan/{id}', 'PesanController@edit');
    Route::post('/admin/pengumuman/pesan/update', 'PesanController@update')->name('pengumuman.pesan-update');
    Route::get('/admin/pengumuman/pesan/hapus/{id}', 'PesanController@destroy');

});
// Forum diskusi
Route::namespace('Forum')->group(function () {
    // Dashboard
    Route::get('/admin/forum/dashboard', 'DashboardController@index')
    ->name('forum.dashboard');
    Route::post('/admin/forum/dashboard', 'DashboardController@store');
    Route::get('/admin/forum/dashboard/{id}', 'DashboardController@edit');
    Route::post('/admin/forum/dashboard/update', 'DashboardController@update')
    ->name('forum.dashboard-update');
    Route::get('/admin/forum/dashboard/hapus/{id}', 'DashboardController@destroy');

    // Topik
    Route::get('/admin/forum/topik', 'TopikController@index')->name('forum.topik');
    Route::post('/admin/forum/topik', 'TopikController@store');
    Route::get('/admin/forum/topik/{id}', 'TopikController@edit');
    Route::post('/admin/forum/topik/update', 'TopikController@update')
        ->name('forum.topik-update');
    Route::get('/admin/forum/topik/hapus/{id}', 'TopikController@destroy');

    // Balasan
    Route::get('/admin/forum/balasan', 'BalasanController@index')->name('forum.balasan');
    Route::post('/admin/forum/balasan', 'BalasanController@store');
    Route::get('/admin/forum/balasan/{id}', 'BalasanController@edit');
    Route::post('/admin/forum/balasan/update', 'BalasanController@update')
        ->name('forum.balasan-update');
    Route::get('/admin/forum/balasan/hapus/{id}', 'BalasanController@destroy');

    // Tautan
    Route::get('/admin/forum/tautan', 'TautanController@index')->name('forum.tautan');
    Route::post('/admin/forum/tautan', 'TautanController@store');
    Route::get('/admin/forum/tautan/{id}', 'TautanController@edit');
    Route::post('/admin/forum/tautan/update', 'TautanController@update')
        ->name('forum.tautan-update');
    Route::get('/admin/forum/topik/hapus/{id}', 'TautanController@destroy');

    // Pengguna
    Route::get('/admin/forum/pengguna', 'PenggunaController@index')->name('forum.pengguna');
    Route::post('/admin/forum/pengguna', 'PenggunaController@store');
    Route::get('/admin/forum/pengguna/{id}', 'PenggunaController@edit');
    Route::post('/admin/forum/pengguna/update', 'PenggunaController@update')
        ->name('forum.pengguna.update');
    Route::get('/admin/forum/pengguna/hapus/{id}', 'PenggunaController@destroy');
});
    
// //Aktifitas
//     Route::get('/admin/forum/ aktifitas', 'AktifitasController@index')
//         -name('forum.aktifitas');  


//Leaderboard
// Forum
Route::namespace('Leaderboard')->group(function () {
    Route::get('/admin/leaderboard/leaderboard', 'LeaderboardController@index')
        ->name('leaderboard.leaderboard');
    Route::post('/admin/leaderboard/leaderboard', 'LeaderboardController@store');
    Route::get('/admin/leaderboard/leaderboard/{id}', 'LeaderboardController@edit');
    Route::post('/admin/leaderboard/leaderboard/update', 'LeaderboardController@update')
        ->name('leaderboard.leaderboard-update');
    Route::get('/admin/leaderboard/leaderboard/hapus/{id}', 'LeaderboardController@destroy');
});
// Perpustakaan
Route::namespace('Perpustakaan')->group(function () {
    Route::get('/admin/perpustakaan/peminjaman', 'PeminjamanController@index')
        ->name('perpustakaan.list-peminjam');
});
