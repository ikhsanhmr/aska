<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('network_contract_icons', function (Blueprint $table) {
            $table->id();
            $table->date('activation_date');
            $table->string('service_id');
            $table->string('service');
            $table->integer('unit_id');
            $table->text('explanation');
            $table->string('activation_number');
            $table->string('scada');
            $table->string('capacity');
            $table->string('price');
            $table->string('status');
            $table->string('asman');
            $table->string('month');
            $table->integer('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network_contract_icons');
    }
};
