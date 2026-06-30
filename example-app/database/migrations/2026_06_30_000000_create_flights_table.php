<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('flights')) {
            return;
        }

        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('airline_id')->nullable()->constrained('airlines')->nullOnDelete();
            $table->foreignId('airplane_id')->nullable()->constrained('airplanes')->nullOnDelete();
            $table->foreignId('gate_departure_id')->nullable()->constrained('gates')->nullOnDelete();
            $table->foreignId('gate_arrival_id')->nullable()->constrained('gates')->nullOnDelete();
            $table->foreignId('origin_id')->nullable()->constrained('airports')->nullOnDelete();
            $table->foreignId('destination_id')->nullable()->constrained('airports')->nullOnDelete();
            $table->dateTime('departure_time')->nullable();
            $table->dateTime('arrival_time')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
