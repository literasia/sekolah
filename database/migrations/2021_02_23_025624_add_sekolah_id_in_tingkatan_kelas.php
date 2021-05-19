<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Superadmin\Sekolah;
use App\User;

class AddSekolahIdInTingkatanKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ //
    public function up()
    {

        Schema::table('tingkatan_kelas', function (Blueprint $table) {
            $table->unsignedBigInteger('sekolah_id')->default(1);
        });

        Schema::table('mata_pelajarans', function (Blueprint $table) {
            $table->unsignedBigInteger('sekolah_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tingkatan_kelas', function (Blueprint $table) {
            $table->dropColumn('sekolah_id');
        });

        Schema::table('mata_pelajaran', function (Blueprint $table) {
            $table->dropColumn('sekolah_id');
        });
    }
}
