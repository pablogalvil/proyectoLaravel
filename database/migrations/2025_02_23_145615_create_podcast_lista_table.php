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
        Schema::create('podcast_lista', function (Blueprint $table) {
            $table->id();
            $table->foreignId('podcast_id')->constrained('podcast')->onDelete('cascade');
            $table->foreignId('lista_id')->constrained('lista')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcast_lista');
    }
};
