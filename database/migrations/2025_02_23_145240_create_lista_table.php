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
        Schema::create('lista', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('numPodcast');
            $table->integer('duracion');
            $table->date('fechaReproduccion');
            $table->boolean('estado');
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista');
    }
};
