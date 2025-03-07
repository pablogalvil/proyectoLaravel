@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Editar podcast</h1>
        <form action="{{ route('podcast.actualizar', $podcast->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!--duracion-->
            <div class="mb-3">
                <label for="duracion" class="form-label">Duración</label>
                <input type="text" name="duracion" id="duracion" class="form-control"
                    value="{{ old('duracion', $podcast->duracion) }}" required>
            </div>
            <!--nombre-->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                    value="{{ old('nombre', $podcast->nombre) }}" required>
            </div>
            <!--imagen del podcast-->
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="form-control">
            </div>
            <!--descripcion-->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control"
                    value="{{ old('descripcion', $podcast->descripcion) }}" required>
            </div>
            <!--fecha publicación-->
            <div class="mb-3">
                <label for="fechaPublicacion" class="form-label">Fecha de publicación</label>
                <input type="date" name="fechaPublicacion" id="fechaPublicacion" class="form-control"
                    value="{{ old('fechaPublicacion', $podcast->fechaPublicacion) }}" required>
            </div>
            <!--boton para actualizar-->
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <!--volvemos al indice-->
            <a href="{{ route('podcast.indice') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection