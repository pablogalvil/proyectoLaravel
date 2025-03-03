<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Podcast;
use Illuminate\Support\Facades\Storage;
class PodcastController extends Controller
{
    public function index()
    {
        $podcast = Podcast::all();
        return view('podcast.index', compact('podcast'));
    }

    // Mostrar detalles de un Podcast
    public function show($id)
    {
        $Podcast = Podcast::with('mascotas')->findOrFail($id);
        return view('podcast.show', compact('Podcast'));
    }


    public function destroy($id)
    {
        //Con find sacamos el Podcast con el id que le introducimos de base de datos
        $Podcast = Podcast::find($id);
        //Con el Podcast recuperado lo borramos utilizando delete
        $Podcast->delete();
        //Redireccionamos a la lista de podcast
        return redirect()->route('podcast.index')->with('success', 'Podcast eliminado correctamente.');
    }

    public function edit($id)
    {
        $Podcast = Podcast::findOrFail($id);
        return view('podcast.edit', compact('Podcast'));
    }

    public function update(Request $request, $id)
    {
        $Podcast = Podcast::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255|min:8',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:255',
            'direccion' => 'required|string|max:255|min:8'
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



        return redirect()->route('podcast.index')->with('success', 'Podcast actualizado correctamente.');
    }

    public function create()
    {
        return view('podcast.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|min:8',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:255',
            'direccion' => 'required|string|max:255|min:8'
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

        return redirect()->route('podcast.index')->with('success', 'Podcast actualizado correctamente.');
    }

}
