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
        if (! Schema::hasTable('flights')) {
            return;
        }

        Schema::table('flights', function (Blueprint $table) {
            if (Schema::hasColumn('flights', 'gate_id')) {
                $table->dropForeign(['gate_id']);
                $table->dropColumn('gate_id');
            }

            if (! Schema::hasColumn('flights', 'gate_departure_id')) {
                $table->foreignId('gate_departure_id')
                    ->nullable()
                    ->after('airplane_id')
                    ->constrained('gates')
                    ->cascadeOnDelete();
            }

            if (! Schema::hasColumn('flights', 'gate_arrival_id')) {
                $table->foreignId('gate_arrival_id')
                    ->nullable()
                    ->after('gate_departure_id')
                    ->constrained('gates')
                    ->cascadeOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('flights')) {
            return;
        }

        Schema::table('flights', function (Blueprint $table) {
            if (Schema::hasColumn('flights', 'gate_arrival_id')) {
                $table->dropForeign(['gate_arrival_id']);
                $table->dropColumn('gate_arrival_id');
            }

            if (Schema::hasColumn('flights', 'gate_departure_id')) {
                $table->dropForeign(['gate_departure_id']);
                $table->dropColumn('gate_departure_id');
            }

            if (! Schema::hasColumn('flights', 'gate_id')) {
                $table->foreignId('gate_id')
                    ->nullable()
                    ->after('airplane_id')
                    ->constrained('gates')
                    ->cascadeOnDelete();
            }
        });
    }
};
