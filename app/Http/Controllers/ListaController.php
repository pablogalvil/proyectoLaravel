<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Models\Lista;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    function indice(){
        $listas = Lista::all();
        return view('lista.indice', compact('listas'));
    }

    function indiceUsuario(){
        $listas = Lista::all();
        return view('lista.listaUsuario', compact('listas'));
    }

    function mostrar($id){
        $listas = Lista::findOrFail($id);
        $podcasts = $listas->podcasts;
        return view('lista.mostrar', compact('podcasts', 'listas'));
    }

    function crear(){
        return view('lista.crear');
    }

    function insertar(Request $request){
        $lista = new Lista();
        $lista->nombre = $request->input('nombre');
        $lista->save();
        return redirect()->route('lista.indice');
    }

    function aniadir(){
        $podcasts = Podcast::all();
        $listas = Lista::all();

        return view('lista.aniadir', compact('podcasts', 'listas'));
    }

    function agregar(Request $request){
        $podcast = Podcast::findOrFail($request->input('podcast_id'));
        $podcast->listas()->attach($request->input('lista_id'));
        return redirect()->route('lista.indice');
    }

    function eliminar($id){
        $podcast = Podcast::findOrFail($id);
        $podcast->listas()->detach();
        return redirect()->route('lista.indice');
    }



    // Muesta la lista para la vista del usuario
    public function mostrarTodas()
    {
        // Obtener todas las listas
        $listas = Lista::all();
    
        // Retornar la vista con las listas
        return view('lista.listaUsuario', compact('listas'));
    }



}
