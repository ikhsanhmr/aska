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
        Schema::create('cctv', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->nullable();
            $table->string('kd_region')->nullable();
            $table->string('nama')->nullable();
            $table->string('model')->nullable();
            $table->string('nomor_seri')->nullable();
            $table->string('alamat_ip')->nullable();
            $table->string('status_cctv')->nullable();
            $table->date('tanggal_instalasi')->nullable();
            $table->longText('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cctv');
    }
};
