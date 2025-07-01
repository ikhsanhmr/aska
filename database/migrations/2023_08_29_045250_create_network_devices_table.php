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
        Schema::create('network_devices', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->string('device_type');
            $table->string('ip_address')->nullable();
            $table->string('user_name');
            $table->integer('unit_id');
            $table->string('username');
            $table->string('password'); 
            $table->string('ownership_status')->nullable();
            $table->integer('year')->nullable();
            $table->string('vendor_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network_devices');
    }
};
