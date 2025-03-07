<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    function mostrar($id){
        $podcast = Podcast::findOrFail($id);
        $listas = $podcast->listas;
        return view('lista.mostrar', compact('listas'));
    }

    function crear(){
        return view('lista.crear');
    }

    function insertar(Request $request){
        $podcast = Podcast::findOrFail($request->input('podcast_id'));
        $podcast->listas()->create($request->all());
        return redirect()->route('podcast.mostrar', $podcast->id);
    }
}
