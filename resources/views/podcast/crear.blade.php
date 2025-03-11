@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear podcast</h1>
        <form action="{{ route('podcast.insertar') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <!--duracion-->
                <label for="duracion" class="form-label">Duración</label>
                <input type="text" name="duracion" id="duracion" class="form-control" placeholder="duracion" required>
            </div>
            <!--nombre-->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="nombre" required>
            </div>
            <!--imagen-->
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="form-control" placeholder="imagen">
            </div>
            <!--audio-->
            <div class="mb-3">
                <label for="audio" class="form-label">Añadir audio</label>
                <input type="file" name="audio" id="audio" class="form-control" placeholder="audio">
            </div>
            <!--descripcion-->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="descripcion"
                    required>
            </div>
            <!--fecha publicacion-->
            <div class="mb-3">
                <label for="fechaPublicacion" class="form-label">Fecha de publicacion</label>
                <input type="date" name="fechaPublicacion" id="fechaPublicacion" class="form-control"
                    placeholder="Fecha de publicacion" required>
            </div>
            <!--volvemos al indice-->
            <button type="submit" class="btn btn-primary">Crear</button>
            <a href="{{ route('podcast.listarPodcastAdmin') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection