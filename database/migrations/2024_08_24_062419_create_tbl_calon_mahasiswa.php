<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_calon_mahasiswa', function (Blueprint $table) {
            $table->id('id_calon_mahasiswa');
            $table->string('kode_user', 50)->unique()->nullable();
            $table->string('nama_user', 50)->unique()->nullable();
            $table->string('alamat_ktp', 255)->nullable();
            $table->string('alamat_sekarang', 255)->nullable();
            $table->string('kecamatan', 50)->nullable();
            $table->string('kabupaten', 50)->nullable();
            $table->string('propinsi', 50)->nullable();
            $table->string('nohp', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('kewarganegaraan', 50)->nullable();
            $table->string('tgl_lahir', 50)->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->string('jenis_kelamin', 50)->nullable();
            $table->string('status_menikah', 50)->nullable();
            $table->string('agama', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_calon_mahasiswa');
    }
};
