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
        Schema::create('access_point', function (Blueprint $table) {
            $table->id();
            $table->string('kd_region')->nullable();
            $table->string('nama_ap')->nullable();
            $table->string('model')->nullable();
            $table->string('nomor_seri')->nullable();
            $table->string('mac_address')->nullable();
            $table->string('alamat_ip')->nullable();
            $table->string('status')->nullable();
            $table->string('status_asset')->nullable();
            $table->longText('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_point');
    }
};
