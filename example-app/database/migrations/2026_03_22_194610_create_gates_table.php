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
       Schema::create('gates', function (Blueprint $table) {

            $table->id();

            $table->string('terminal');

            $table->string('gate_number');

            $table->enum('status', [
                'Disponible',
                'Ocupada'
            ])->default('Disponible');

            $table->boolean('active')->default(true);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gates');
    }
};