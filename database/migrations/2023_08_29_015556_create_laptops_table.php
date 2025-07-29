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
        Schema::create('laptops', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->nullable();
            $table->string('name')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('spesification')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_name')->nullable();
            $table->integer('unit_id')->nullable();
            $table->string('ownership_status')->nullable();
            $table->integer('year')->nullable();
            $table->string('vendor')->nullable();
            $table->string('bast')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptops');
    }
};
