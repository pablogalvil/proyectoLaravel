@extends('layouts.app')

@section('title', $podcast->nombre)

@section('content')
    <div class="container">
        <h2 class="text-center">{{ $podcast->nombre }}</h2>
        <p class="text-center">{{ $podcast->descripcion }}</p>

        <div class="mt-5">
            <h3 class="container text-center pb-4">Comentarios de nuestros oyentes</h3>
            <div class="card p-3">
                @if ($podcast->comentarios->count() > 0)
                    @foreach ($podcast->comentarios as $comentario)
                        <div class="row mb-3 d-flex align-items-center justify-content-center">
                            <!-- Imagen y nombre del usuario -->
                            <div class="col-12 col-md-3 text-md-left align-items-center">
                                <img src="{{ $comentario->usuario ? $comentario->usuario->image : '/images/default-avatar.png' }}" 
                                     alt="Usuario" 
                                     class="rounded-circle" 
                                     style="width: 50px; height: 50px; object-fit: cover; margin-bottom: 10px;">
                                <div>
                                    <p class="comment-user">{{ $comentario->usuario ? $comentario->usuario->name : 'Usuario desconocido' }}</p>
                                    <p class="comment-date">{{ $comentario->fecha }}</p>
                                </div>
                            </div>
                            <!-- Texto del comentario -->
                            <div class="col-12 col-md-8 text-md-right">
                                <p class="comment-description">{{ $comentario->descripcion }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">Aún no hay comentarios para este podcast.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Formulario para añadir comentarios -->
    <div class="container mt-4">
        @if (Auth::check()) <!-- Solo mostrar el formulario si el usuario está autenticado -->
            <h4>Deja tu comentario</h4>
            <form action="{{ route('comentario.guardarComentario', $podcast->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="descripcion" class="form-control" rows="4" placeholder="Escribe tu comentario aquí..." required></textarea>
                </div>
                <button type="submit" class="btn btn-warning mt-2">Publicar comentario</button>
            </form>
        @else
            <p class="text-muted">Debes <a href="{{ route('login') }}">iniciar sesión</a> para comentar.</p>
        @endif
    </div>

    <div class="container text-center mt-5 pb-4">
        <a href="{{ url('/listarPodcast') }}" class="btn btn-light">Volver</a>
    </div>
@endsection
