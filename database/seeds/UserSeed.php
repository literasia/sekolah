<?php

use App\Role;
use App\User;
use App\Models\Superadmin\{Addons, Sekolah, Provinsi, KabupatenKota};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ //
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $superadmin = Role::where('name', 'superadmin')->first();
        $admin = Role::where('name', 'admin')->first();
        $siswa = Role::where('name', 'siswa')->first();

        // Add Provinsi
        $provinsi = Provinsi::create([
            'name' => 'Sumatera Utara',
        ]);

        // Add Kabupaten
        $kabupaten = KabupatenKota::create([
            'name' => 'Medan',
            'provinsi_id' => $provinsi->id
        ]);

        // Add Sekolah
        $sekolah = Sekolah::create([
            'id_sekolah'    => '000523414',
            'name'          => 'Literasia Academy',
            'alamat'        => 'Jl. Halat',
            'provinsi'      => $provinsi->id,
            'kabupaten'     => $kabupaten->id,
            'jenjang'       => 'SMA',
            'tahun_ajaran'  => '2020-2021',
        ]);

        $superadmins = User::create([
            'name'      => 'Superadmin',
            'username'  => 'superadmin',
            'password'  => bcrypt('superadmin'),
            'role_id'   => 1,
        ]);

        $admins = User::create([
            'id_sekolah' => $sekolah->id,
            'name'      => 'Admin',
            'username'  => 'admin',
            'password'  => bcrypt('admin'),
            'role_id'   => 2
        ]);

        $siswas = User::create([
            'name'      => 'Siswa',
            'username'  => 'siswa',
            'password'  => bcrypt('siswa'),
            'role_id'   => '3'
        ]);

        $guru = User::create([
            'name'      => 'Guru',
            'username'  => 'guru',
            'password'  => bcrypt('guru'),
            'role_id'   => '4'
        ]);
        
        // Add Addons
        Addons::create([
            'sekolah_id' => $sekolah->id,
            'user_id' => $admins->id,
            'referensi' => 1,
            'sekolah' => 1,
            'fungsionaris' => 1,
            'pelajaran' => 1,
            'peserta_didik' => 1,
            'absensi' => 1,
            'e_learning' => 1,
            'daftar_nilai' => 1,
            'e_rapor' => 1,
            'pelanggaran' => 1,
            'e_voting' => 1,
            'kalender' => 1,
            'import' => 1,
            'leaderboard' => 1,
            'forum' => 1,
            'perpustakaan' => 1,
        ]);

        $superadmins->roles()->attach($superadmin);
        $admins->roles()->attach($admin);
        $siswas->roles()->attach($siswa);
        $guru->roles()->attach($guru);        
    }
}