<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Podcast;
use Illuminate\Support\Facades\Storage;
class PodcastController extends Controller
{
    //mostrar la lista de Podcast
    public function indice()
    {
        $podcast = Podcast::all();
        return view('podcast.indice', compact('podcast'));
    }

    // funcion para los detalles del podcast
    public function mostrar($id)
    {
        $podcast = Podcast::findOrFail($id);
        return response()->json($podcast);
    }

    //funcion para eliminar
    public function eliminar($id)
    {
        //Con find sacamos el Podcast con el id que le introducimos de base de datos
        $Podcast = Podcast::find($id);
        //Con el Podcast recuperado lo borramos utilizando delete
        $Podcast->delete();
        //Redireccionamos a la lista de podcast
        return redirect()->route('podcast.indice')->with('success', 'Podcast eliminado correctamente.');
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
            'imagen' => 'nullable|string|max:255',
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
            $carpetaPodcast = '/storage/public/app/imgenes/podcast/' . $Podcast->id;

            //Guardamos la imagen en el hd y obtenemos la ruta completa
            $imagenPath = $request->file('imagen')->update($carpetaPodcast, 'public');

            //Hay que añadir la ruta de la imagen a los datos que se van a 
            //insertar en bd
            $data['imagen'] = $imagenPath;
        }

        $Podcast->update($data);



        return redirect()->route('podcast.indice')->with('success', 'Podcast actualizado correctamente.');
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
            'imagen' => 'nullable|string|max:255',
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
            $imagePath = $request->file('imagen')->update($carpetaPodcast, 'public');

            //Actualizamos el Podcast con la nueva imagen
            $Podcast->update(['imagen' => $imagePath]); //imagen = $imagePath;

        }
        //reedirigmos al indice
        return redirect()->route('podcast.indice')->with('success', 'Podcast actualizado correctamente.');
    }

}
