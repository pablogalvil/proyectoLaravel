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
        Schema::create('podcast', function (Blueprint $table) {
            $table->id();
            $table->integer('duracion');
            $table->string('nombre');
            $table->string('imagen')->nullable();
            $table->string('descripcion');
            $table->date('fechaPublicacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcast');
    }
};
