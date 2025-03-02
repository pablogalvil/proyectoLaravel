<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Podcast;

class PodcastController extends Controller
{
  /*  public function listado()
    {
        return response()->json(Podcast::all());
    }*/


    // Función para listar los podcasts de 12 en 12
    public function listarPodcast(Request $request)
    {
        // Obtenemos la página actual, ponemos por defecto la primera
        $page = $request->input('page', 1); 
        // Especificamos el número de podcasts por página
        $perPage = 12; 

        // Obtenemos los podcasts de la base de datos ordenados por fecha, primero los más recientes
        $podcasts = Podcast::orderBy('created_at', 'desc')
            // Saltamos los podcasts ya mostrados
            ->skip(($page - 1) * $perPage) 
            // Cogemos los siguientes 10 podcasts
            ->take($perPage) 
            // Devolvemos los podcasts
            ->get();

        // Devolvemos los datos en formato JSON
        return response()->json($podcasts);
    }

    // Función para ver los comentarios de un podcast por el id del podcast
    public function verComentarios($id)
    {
        // Obtenemos el podcast
        $podcast = Podcast::with('comentarios.usuario')->findOrFail($id);
        // Mostramos la vista con los comentarios
        return view('comentariosPodcast', compact('podcast'));
    }
}

