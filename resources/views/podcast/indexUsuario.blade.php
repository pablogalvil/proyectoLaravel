@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Últimos Episodios</h2>
    <p>Escucha nuestros podcasts y deja tu comentario</p>

    <div class="lista mt-4 fs-5">
        <a href="{{ route('lista.mostrarTodas') }}">Explora nuestras listas</a>
    </div>

    <!-- Contenedor de Podcasts -->
    <div class="row row-cols-1 row-cols-md-4 g-4 mt-4">
        @foreach ($podcasts as $podcast)
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="{{ $podcast->imagen }}" class="card-img-top" alt="Imagen del podcast">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/detalles.php?id={{ $podcast->id }}">{{ $podcast->nombre }}</a>
                        </h5>
                        <a href="/podcast/{{ $podcast->id }}/comentarios" class="btn btn-warning">
                            Comentarios
                        </a>
                        <a href="" class="btn btn-warning">
                            Reproducir
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="mt-5 text-center pb-4">
        @if ($podcasts->hasMorePages())
            <a href="{{ $podcasts->nextPageUrl() }}" class="btn btn-warning">Ver más</a>
        @endif
    </div>
</div>
@endsection
