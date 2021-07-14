<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\RoleForum;

class RoleForumSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        RoleForum::create([
            'name' => 'keymaster',
        ]);

        RoleForum::create([
            'name' => 'moderator',
        ]);

        RoleForum::create([
            'name' => 'peserta',
        ]);

        RoleForum::create([
            'name' => 'blokir_pengguna',
        ]);

    }
}
