<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use Illuminate\Http\Request;
use App\Models\Podcast;
use Illuminate\Support\Facades\Storage;
use App\Models\Comentario;
use Illuminate\Support\Facades\Auth;
use App\Models\Episodio;
use App\Models\User;

class PodcastController extends Controller
{

    // Función para mostrar la lista de Podcast
    public function listarPodcast()
    {
        // Obtenemo todos los registros de los podcasts de la bd y paginados automáticamente 
        $podcasts = Podcast::orderBy('created_at', 'asc')->paginate(12);

        // Devolvemos la vista con la paginación y envía la variable $podcasts a la vista
        return view('podcast.indexUsuario', compact('podcasts'));
    }

    // Función para mostrar la lista de Podcast del Admin
    public function listarPodcastAdmin()
    {
        $podcasts = Podcast::orderBy('created_at', 'asc')->paginate(12);

        return view('podcast.indexAdmin', compact('podcasts'));
    }

    // Función para ver los comentarios de un podcast por el id del podcast
    public function verComentarios($id)
    {
        // Obtenemos el podcast con sus comentarios y el usuario que va a cada comentario
        $podcast = Podcast::with(['comentarios.usuario'])->findOrFail($id);
        // Mostramos la vista con los comentarios
        return view('podcast.comentariosPodcast', compact('podcast'));
    }


    // Función para guardar un comentario
    public function guardarComentario(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:500',
        ]);

        Comentario::create([
            'descripcion' => $request->descripcion,
            // Aquí se asegura de que el usuario autenticado se guarde
            'user_id' => Auth::id(),  
            'podcast_id' => $id,
            'fecha' => now(),
        ]);

        // Redirigimos al usuario a la página del formulario de comentarios y muestra un mensaje utilizando session flash
        return redirect()->back()->with('success', 'Comentario publicado con éxito.');
    }


    public function audioPodcast($id)
    {
        // Buscar el podcast por el ID
        $podcast = Podcast::find($id);

        if (!$podcast) {
            return response()->json(['error' => 'Podcast no encontrado.'], 404);
        }

        // Buscar el primer episodio del podcast
        $episodio = $podcast->episodios()->first(); 

        if (!$episodio) {
            return response()->json(['error' => 'Episodio no encontrado.'], 404);
        }

        // Retornar la URL del audio como respuesta JSON
        return response()->json([
            'audio_url' => asset('audio/' . $episodio->audio),
        ]);
    }


    public function verReproductor($id)
    {
        // Buscar el podcast por ID
        $podcast = Podcast::find($id);

        if (!$podcast) {
            return redirect()->route('podcast.listarPodcastAdmin')->with('error', 'Podcast no encontrado.');
        }

        // Buscar el primer episodio relacionado con este podcast
        $episodio = $podcast->episodios()->first(); // Obtener el primer episodio

        if (!$episodio) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('podcast.listarPodcastAdmin')->with('error', 'Podcast sin episodios.');
            } else {
                return redirect()->route('podcast.listar')->with('error', 'Podcast sin episodios.');
            }
        }

        // Pasar el episodio a la vista 'reproductor'
        return view('podcast.reproductor', compact('episodio'));
    }


    // funcion para los detalles del podcast
    public function mostrar($id)
    {
        $podcast = Podcast::with(['locutores.equipos', 'generos', 'invitados'])->findOrFail($id);
        $data = response()->json($podcast);
        return $data;
    }


    //funcion para eliminar
    public function eliminar($id)
    {
        //Con find sacamos el Podcast con el id que le introducimos de base de datos
        $Podcast = Podcast::find($id);
        //Con el Podcast recuperado lo borramos utilizando delete
        $Podcast->delete();
        //Redireccionamos a la lista de podcast
        return redirect()->route('podcast.listarPodcastAdmin')->with('success', 'Podcast eliminado correctamente.');
    }
    //funcion para editar
    public function editar($id)
    {
        $podcast = Podcast::findOrFail($id);
        return view('podcast.editar', compact('podcast'));
    }
    //funcion para actualizar
    public function actualizar(Request $request, $id)
    {
        $Podcast = Podcast::findOrFail($id);
        //campos requeridos en el formulario
        $request->validate([
            'duracion' => 'required|integer|max:255|min:8',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255|min:8',
            'fechaPublicacion' => 'required|date'
        ]);

        //Guardamos los datos el Podcast para obtener el nuevo id, sin la imagen
        $data = $request->except('imagen');

        if ($request->hasFile('imagen')) {

            //Eliminamos la imagen anterior
            if ($Podcast->imagen) {
                Storage::disk('public')->delete($Podcast->imagen);
            }

            //Definimos la ruta especifica para este Podcast
            $carpetaPodcast = 'imagenes/podcast/' . $Podcast->id;

            //Guardamos la imagen en el hd y obtenemos la ruta completa
            $imagenPath = $request->file('imagen')->store($carpetaPodcast, 'public');

            //Hay que añadir la ruta de la imagen a los datos que se van a 
            //insertar en bd
            $data['imagen'] = $imagenPath;
        }

        $Podcast->update($data);



        return redirect()->route('podcast.listarPodcastAdmin')->with('success', 'Podcast actualizado correctamente.');
    }
    //funcion para crear nuevo podcast
    public function crear()
    {
        return view('podcast.crear');
    }

    //funcion para insertar las imagenes
    public function insertar(Request $request)
    {
        //campos requeridos en el formulario
        $request->validate([
            'duracion' => 'required|integer|max:255|min:8',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255|min:8',
            'fechaPublicacion' => 'required|date'
        ]);

        //Creamos el Podcast para obtener el nuevo id, sin la imagen
        $Podcast = Podcast::create($request->except('imagen'));

        //Si la request tiene un archivo llamado imagen
        if ($request->hasFile('imagen')) {

            //La ruta de la carpeta, unica para cada Podcast
            $carpetaPodcast = 'imagenes/podcast/' . $Podcast->id;

            //Guardamos el archivo en el disco duro y obtenemos la ruta completa
            $imagePath = $request->file('imagen')->store($carpetaPodcast, 'public');

            //Actualizamos el Podcast con la nueva imagen
            $Podcast->update(['imagen' => $imagePath]); //imagen = $imagePath;

        }
        //reedirigmos al indice
        return redirect()->route('podcast.listarPodcastAdmin')->with('success', 'Podcast actualizado correctamente.');
    }
}
