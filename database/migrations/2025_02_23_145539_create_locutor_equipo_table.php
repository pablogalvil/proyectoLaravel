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
        Schema::create('locutor_equipo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('locutor_id')->constrained('locutor')->onDelete('cascade');
            $table->foreignId('equipo_id')->constrained('equipo')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locutor_equipo');
    }
};
