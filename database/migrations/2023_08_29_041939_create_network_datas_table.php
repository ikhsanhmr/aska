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
        Schema::create('network_datas', function (Blueprint $table) {
            $table->id();
            $table->date('activation_date');
            $table->string('service_id');
            $table->string('service');
            $table->string('asman');
            $table->integer('unit_id');
            $table->text('information');
            $table->string('activation_number');
            $table->integer('scada');
            $table->integer('price')->nullable();
            $table->integer('capacity');
            $table->integer('status')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network_datas');
    }
};
