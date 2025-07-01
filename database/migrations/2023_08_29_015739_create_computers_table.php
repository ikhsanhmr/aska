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
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('serial_number');
            $table->integer('brand_id')->nullable();
            $table->string('spesification')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_name')->nullable();
            $table->integer('unit_id')->nullable();
            $table->string('ownership_status')->nullable();
            $table->integer('year')->nullable();
            $table->string('vendor')->nullable();
            $table->string('system_operation')->nullable();
            $table->string('office')->nullable();
            $table->integer('status_id')->nullable();
            $table->string('kes')->nullable();
            $table->string('mouse')->nullable();
            $table->string('keyboard')->nullable();
            $table->string('monitor')->nullable();
            $table->date('contract_date')->nullable();
            $table->integer('rental_price')->nullable();
            $table->string('bast')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computers');
    }
};
