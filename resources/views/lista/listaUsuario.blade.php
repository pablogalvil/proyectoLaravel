@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Listas</h2>
    <div class="lista mt-4 fs-5">
        <!-- Enlace para explorar las listas -->
        <a href="{{ route('podcast.listar') }}">Explora nuestros podcasts</a>
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
