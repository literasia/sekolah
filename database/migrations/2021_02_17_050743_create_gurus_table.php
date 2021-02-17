<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->timestamps();

            $table->string('nama_guru')->nullable($value = true);
            $table->string('nip')->nullable($value = true);
            $table->string('nik')->nullable($value = true);
            $table->string('gelar_depan')->nullable($value = true);
            $table->string('gelar_belakang')->nullable($value = true);
            $table->string('tempat_lahir')->nullable($value = true);
            $table->string('jenis_kelamin')->nullable($value = true);
            $table->string('agama')->nullable($value = true);
            $table->string('status')->nullable($value = true);
            $table->string('alamat_tinggal')->nullable($value = true);
            $table->string('provinsi')->nullable($value = true);
            $table->string('kabupaten')->nullable($value = true);
            $table->string('kecamatan')->nullable($value = true);
            $table->string('dusun')->nullable($value = true);
            $table->string('rt')->nullable($value = true);
            $table->string('rw')->nullable($value = true);
            $table->string('kode_pos')->nullable($value = true);
            $table->string('no_telepon_rumah')->nullable($value = true);
            $table->string('no_telepon')->nullable($value = true);
            $table->string('email')->nullable($value = true);
            $table->string('username')->nullable($value = true);
            $table->string('password')->nullable($value = true);
            $table->string('bagian_guru')->nullable($value = true);
            $table->string('tahun_ajaran')->nullable($value = true);
            $table->string('semester')->nullable($value = true);
            $table->string('jenjang')->nullable($value = true);
            $table->string('tanggal_mulai')->nullable($value = true);
            $table->string('tanggal_lahir')->nullable($value = true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gurus');
    }
}
