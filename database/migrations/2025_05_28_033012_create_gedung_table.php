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
        Schema::create('gedung', function (Blueprint $table) {
            $table->id();
            $table->string('kd_up')->nullable()->comment('Kode Unit Pelaksana (UP)'); // Renamed from kd_region
            // Hapus jika ingin nama
            // $table->string('nama')->nullable(); 
            // $table->longText('alamat')->nullable();
            $table->string('status_asset')->nullable(); // Existing field
            $table->longText('keterangan')->nullable(); // Existing field
            $table->string('bast')->nullable(); // Existing field

            // New fields
            $table->longText('uraian')->nullable();
            $table->string('unit_manual')->nullable();
            $table->string('pihak_pertama')->nullable();
            $table->string('pihak_kedua')->nullable();
            $table->longText('alamat_kantor')->nullable();
            $table->double('luas_tanah_m2')->nullable();
            $table->double('luas_bangunan_m2')->nullable();
            $table->string('asuransi_yn')->nullable(); // 'Y' or 'N'
            $table->string('status_sewa')->nullable();
            $table->string('no_sertifikat')->nullable();
            $table->string('nomor_pj')->nullable();
            $table->date('tanggal_input')->nullable();
            $table->date('periode_awal')->nullable();
            $table->date('periode_akhir')->nullable();
            $table->date('awal_sewa')->nullable();
            $table->date('akhir_sewa')->nullable();
            $table->integer('tahun_sewa')->nullable();
            $table->double('nilai')->nullable();
            $table->string('validasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gedung');
    }
};