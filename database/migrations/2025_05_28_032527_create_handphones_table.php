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
        Schema::create('handphones', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('model')->nullable();
            $table->string('nama_pegawai')->nullable();
            $table->string('kd_region')->nullable();
            $table->string('status_asset')->nullable();
            $table->string('bast')->nullable();
            $table->longText('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handphones');
    }
};
