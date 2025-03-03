<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PodcastController;

//rutas
Route::get('/', function () {
    return view('welcome');
});
Route::get('/podcast', [PodcastController::class, 'index'])->name('podcast.index');
//Ruta para el borrado del podcast actual
Route::delete('/podcast/{id}', [PodcastController::class, 'destroy'])->name('podcast.destroy');
//Ruta para cargar la vista de edicion del podcast seleccionado
Route::get('/podcast/{id}/edit', [PodcastController::class, 'edit'])->name('podcast.edit');
//Ruta para actualizar el podcast seleccionado
Route::put('/podcast/{id}', [PodcastController::class, 'update'])->name('podcast.update');
//Ruta para cargar la vista de inserción
Route::get('/podcast/create', [PodcastController::class, 'create'])->name('podcast.create');
//Ruta para insertar un nuevo podcast
Route::post('/podcast/store', [PodcastController::class, 'store'])->name('podcast.store');
//Ruta para mostrar detalles del podcast
Route::get('/podcast/show/{id}', [PodcastController::class, 'show'])->name('podcast.show');