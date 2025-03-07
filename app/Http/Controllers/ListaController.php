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
}
