@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Listas</h2>
    <div class="lista mt-4 fs-5">
        <!-- Enlace para explorar las listas -->
        <a href="{{ route('podcast.listarPodcastAdmin') }}">Explora nuestros podcasts</a>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-4 mt-4">
        @foreach ($listas as $lista)
            <div class="col">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('lista.mostrar', $lista->id) }}" class="ver-detalles">{{ $lista->nombre }}</a>
                        </h5>
                        <div class="mt-3 d-flex justify-content-center">
                            <!-- Enlace para editar el podcast -->
                            <a href="{{ route('lista.aniadir') }}">
                                <img src="{{ asset('icons/editar.png') }}" alt="Editar" class="icono-podcast" style="width: 24px; height: 24px;">
                            </a>

                            <!-- Formulario para eliminar el podcast -->
                            <form action="{{ route('lista.eliminar', $lista->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0" onclick="return confirm('¿Estás seguro de eliminar este podcast?')">
                                    <img src="{{ asset('icons/eliminar.png') }}" alt="Eliminar" class="icono-podcast" style="width: 24px; height: 24px;">
                                </button>
                            </form>
                            
                            <!-- Enlace para agregar el podcast a una lista -->
                            <a href="{{ route('lista.crear') }}" class="ml-3">
                                <img src="{{ asset('icons/agregar.png') }}" alt="Agregar" class="icono-podcast" style="width: 24px; height: 24px;">
                            </a>

                            <!-- Enlace para ver detalles del podcast -->
                            <a href="{{ route('lista.mostrar', $lista->id) }}" class="ml-3 ver-detalles">
                                <img src="{{ asset('icons/ver.png') }}" alt="Ver" class="icono-podcast" style="width: 24px; height: 24px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
