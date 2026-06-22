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
            if (Schema::hasColumn('flights', 'origin')) {
                $table->dropColumn('origin');
            }

            if (Schema::hasColumn('flights', 'destination')) {
                $table->dropColumn('destination');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flights', function (Blueprint $table) {
            if (! Schema::hasColumn('flights', 'origin')) {
                $table->string('origin', 100)->nullable()->after('destination_id');
            }

            if (! Schema::hasColumn('flights', 'destination')) {
                $table->string('destination', 100)->nullable()->after('origin');
            }
        });
    }
};
