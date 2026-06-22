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
        Schema::table('flights', function (Blueprint $table) {
            if (! Schema::hasColumn('flights', 'airline_id')) {
                $table->foreignId('airline_id')->nullable()->after('id')->constrained('airlines')->cascadeOnDelete();
            }

            if (! Schema::hasColumn('flights', 'gate_id')) {
                $table->foreignId('gate_id')->nullable()->after('destination_id')->constrained('gates')->cascadeOnDelete();
            }

            if (! Schema::hasColumn('flights', 'airplane_id')) {
                $table->foreignId('airplane_id')->nullable()->after('gate_id')->constrained('airplanes')->cascadeOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flights', function (Blueprint $table) {
            if (Schema::hasColumn('flights', 'airplane_id')) {
                $table->dropForeign(['airplane_id']);
                $table->dropColumn('airplane_id');
            }

            if (Schema::hasColumn('flights', 'gate_id')) {
                $table->dropForeign(['gate_id']);
                $table->dropColumn('gate_id');
            }

            if (Schema::hasColumn('flights', 'airline_id')) {
                $table->dropForeign(['airline_id']);
                $table->dropColumn('airline_id');
            }
        });
    }
};
