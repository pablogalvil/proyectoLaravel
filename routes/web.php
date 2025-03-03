<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PodcastController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/podcast', [PodcastController::class, 'index'])->name('podcast.index');
//Ruta para el borrado del cliente actual
Route::delete('/podcast/{id}', [PodcastController::class, 'destroy'])->name('podcast.destroy');
//Ruta para cargar la vista de edicion del cliente seleccionado
Route::get('/podcast/{id}/edit', [PodcastController::class, 'edit'])->name('podcast.edit');
//Ruta para actualizar el cliente seleccionado
Route::put('/podcast/{id}', [PodcastController::class, 'update'])->name('podcast.update');
//Ruta para cargar la vista de insercino
Route::get('/podcast/create', [PodcastController::class, 'create'])->name('podcast.create');
//Ruta para insertar un nuevo cliente
Route::post('/podcast/store', [PodcastController::class, 'store'])->name('podcast.store');
//Ruta para mostrar el cliente
Route::get('/podcast/show/{id}', [PodcastController::class, 'show'])->name('podcast.show');