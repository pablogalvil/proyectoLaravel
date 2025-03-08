<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PodcastController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/podcast', [PodcastController::class, 'indice'])->name('podcast.indice');
    //Ruta para el borrado del cliente actual
    Route::delete('/podcast/{id}', [PodcastController::class, 'eliminar'])->name('podcast.eliminar');
    //Ruta para cargar la vista de edicion del cliente seleccionado
    Route::get('/podcast/{id}/edit', [PodcastController::class, 'editar'])->name('podcast.editar');
    //Ruta para actualizar el cliente seleccionado
    Route::put('/podcast/{id}', [PodcastController::class, 'actualizar'])->name('podcast.actualizar');
    //Ruta para cargar la vista de insercino
    Route::get('/podcast/create', [PodcastController::class, 'crear'])->name('podcast.crear');
    //Ruta para insertar un nuevo cliente
    Route::post('/podcast/store', [PodcastController::class, 'insertar'])->name('podcast.insertar');
    //Ruta para mostrar el cliente
    Route::get('/podcast/show/{id}', [PodcastController::class, 'mostrar'])->name('podcast.mostrar');
});