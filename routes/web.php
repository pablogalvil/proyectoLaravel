<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PodcastController;

//rutas
Route::get('/', function () {
    return view('welcome');
});
Route::get('/podcast', [PodcastController::class, 'indice'])->name('podcast.indice');
//Ruta para el borrado del podcast actual
Route::delete('/podcast/{id}', [PodcastController::class, 'eliminar'])->name('podcast.eliminar');
//Ruta para cargar la vista de edicion del podcast seleccionado
Route::get('/podcast/{id}/editar', [PodcastController::class, 'editar'])->name('podcast.editar');
//Ruta para actualizar el podcast seleccionado
Route::put('/podcast/{id}', [PodcastController::class, 'actualizar'])->name('podcast.actualizar');
//Ruta para cargar la vista de inserción
Route::get('/podcast/crear', [PodcastController::class, 'crear'])->name('podcast.crear');
//Ruta para insertar un nuevo podcast
Route::post('/podcast/insertar', [PodcastController::class, 'insertar'])->name('podcast.insertar');
//Ruta para mostrar detalles del podcast
Route::get('/podcast/mostrar/{id}', [PodcastController::class, 'mostrar'])->name('podcast.mostrar');