<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSemesterToPegawaisAndDaftarNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ //
    public function up()
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('semester', ['Ganjil', 'Genap'])->nullable();
        });

        Schema::table('daftar_nilai', function (Blueprint $table) {
            $table->enum('semester', ['Ganjil', 'Genap'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pegawais', function (Blueprint $table) {
            //
        });

        Schema::table('daftar_nilai', function (Blueprint $table) {
            //
        });
    }
}
