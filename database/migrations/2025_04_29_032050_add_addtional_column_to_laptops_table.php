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
        Schema::table('laptops', function (Blueprint $table) {
            $table->string('kd_region')->after('bast')->nullable();
            $table->string('pegawai')->after('kd_region')->nullable();
            $table->string('barcode')->after('pegawai')->nullable();
            $table->string('data_kontrak')->after('barcode')->nullable();
            $table->date('tanggal_pembelian')->after('data_kontrak')->nullable();
            $table->bigInteger('harga')->after('tanggal_pembelian')->nullable();
            $table->string('bastp')->after('harga')->nullable();
            $table->string('form_permintaan')->after('bastp')->nullable();
            $table->string('foto')->after('form_permintaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laptops', function (Blueprint $table) {
            $table->dropColumn('kd_region');
            $table->dropColumn('pegawai');
            $table->dropColumn('barcode');
            $table->dropColumn('data_kontrak');
            $table->dropColumn('tanggal_pembelian');
            $table->dropColumn('harga');
            $table->dropColumn('bastp');
            $table->dropColumn('form_permintaan');
            $table->dropColumn('foto');
        });
    }
};
