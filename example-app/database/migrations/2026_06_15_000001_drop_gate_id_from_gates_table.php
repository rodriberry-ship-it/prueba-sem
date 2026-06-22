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
        Schema::table('gates', function (Blueprint $table) {
            if (Schema::hasColumn('gates', 'gate_id')) {
                $table->dropForeign(['gate_id']);
                $table->dropColumn('gate_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gates', function (Blueprint $table) {
            if (! Schema::hasColumn('gates', 'gate_id')) {
                $table->foreignId('gate_id')->constrained()->cascadeOnDelete()->after('gate_number');
            }
        });
    }
};
