<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ //
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Role::truncate();

        Role::create([
            'name' => 'superadmin',
        ]);

        Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'siswa',
        ]);
        
        Role::create([
            'name' => 'guru',
        ]);
    }
}
