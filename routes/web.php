<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PodcastController;

Route::get('/', function () {
    return view('welcome');
});


// Ejecuta la función listarPodcast de PodcastController, obtiene la lista de podcasts de la base de datos.
Route::get('/listarPodcast', [PodcastController::class, 'listarPodcast']);

// Ejecuta la vista listadoPodcast, no devuelve datos, solo carga el HTML.
Route::get('/listadoPodcast', function () {
    return view('listadoPodcast');
});

// Ejecuta la función verComentarios de PodcastController, obtiene los comentarios de un podcast.
Route::get('/podcast/{id}/comentarios', [PodcastController::class, 'verComentarios']);