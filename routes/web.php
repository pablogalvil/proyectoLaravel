<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\ListaController;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Ruta para el borrado del cliente actual
    Route::delete('/podcast/{id}', [PodcastController::class, 'eliminar'])->name('podcast.eliminar');
    //Ruta para cargar la vista de edicion del cliente seleccionado
    Route::get('/podcast/{id}/editar', [PodcastController::class, 'editar'])->name('podcast.editar');
    //Ruta para actualizar el cliente seleccionado
    Route::put('/podcast/{id}', [PodcastController::class, 'actualizar'])->name('podcast.actualizar');
    //Ruta para cargar la vista de insercino
    Route::get('/podcast/crear', [PodcastController::class, 'crear'])->name('podcast.crear');
    //Ruta para insertar un nuevo cliente
    Route::post('/podcast/insertar', [PodcastController::class, 'insertar'])->name('podcast.insertar');
    //Ruta para mostrar el cliente
    Route::get('/podcast/mostrar/{id}', [PodcastController::class, 'mostrar'])->name('podcast.mostrar');


    //Rutas listas
    //Listado
    Route::get('/lista', [App\Http\Controllers\ListaController::class, 'indice'])->name('lista.indice');

    Route::get('/listaUsuario', [App\Http\Controllers\ListaController::class, 'indiceUsuario'])->name('lista.indiceUsuario');
    //Crear
    Route::get('/lista/crear', [App\Http\Controllers\ListaController::class, 'crear'])->name('lista.crear');
    Route::post('/lista/insertar', [App\Http\Controllers\ListaController::class, 'insertar'])->name('lista.insertar');
    //Detalle
    Route::get('/lista/mostrar/{id}', [App\Http\Controllers\ListaController::class, 'mostrar'])->name('lista.mostrar');
    
   //Muestra la lista para la vista del usuario
    Route::get('/listas', [ListaController::class, 'mostrarTodas'])->name('lista.mostrarTodas');

    //Añadir
    Route::get('/lista/aniadir', [App\Http\Controllers\ListaController::class, 'aniadir'])->name('lista.aniadir');
    Route::post('/lista/agregar', [App\Http\Controllers\ListaController::class, 'agregar'])->name('lista.agregar');
    //Eliminar
    Route::get('/lista/eliminar/{id}', [App\Http\Controllers\ListaController::class, 'eliminar'])->name('lista.eliminar');

    
    // Página principal Admin
    Route::get('/indexAdmin', [PodcastController::class, 'listarPodcastAdmin'])->name('podcast.listarPodcastAdmin');

    // Página principal Usuarios
    Route::get('/indexUsuario', [PodcastController::class, 'listarPodcast'])->name('podcast.listar');
    Route::get('/podcast/{id}/comentarios', [PodcastController::class, 'verComentarios'])->name('podcast.verComentarios');
    Route::post('/podcast/{id}/comentario', [PodcastController::class, 'guardarComentario'])->name('comentario.guardarComentario');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de audio
    // Ruta para obtener la URL del audio del episodio
    Route::get('/episodios/{id}', [PodcastController::class, 'audioPodcast']);
    // Ruta para ver el reproductor del podcast
    Route::get('/podcast/{id}/reproducir', [PodcastController::class, 'verReproductor'])->name('podcast.reproducir');



});


require __DIR__ . '/auth.php';

