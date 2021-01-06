<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $superadmin = Role::where('name', 'superadmin')->first();
        $admin = Role::where('name', 'admin')->first();
        $siswa = Role::where('name', 'siswa')->first();

        $superadmins = User::create([
            'name'      => 'Superadmin',
            'username'  => 'superadmin',
            'password'  => bcrypt('superadmin'),
        ]);

        $admins = User::create([
            'name'      => 'Admin',
            'username'  => 'admin',
            'password'  => bcrypt('admin'),
        ]);

        $siswas = User::create([
            'name'      => 'Siswa',
            'username'  => 'siswa',
            'password'  => bcrypt('siswa'),
        ]);


        $superadmins->roles()->attach($superadmin);
        $admins->roles()->attach($admin);
        $siswas->roles()->attach($siswa);
    }
}
