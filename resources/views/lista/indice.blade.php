@extends('layout.app')

@section('content')
    <div class="lista">
        <a href="{{ route('podcast.indice') }}">Nuestros podcasts</a>
    </div>
    <div class="container">
        <h1>Nuestras listas</h1>
        <a href="{{ route('lista.crear') }}" class="btn btn-primary mb-3">Nueva lista</a>
        <a href="{{ route('lista.aniadir') }}" class="btn btn-primary mb-3">Añadir podcast a lista</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listas as $lista)
                    <tr>
                        <td>{{ $lista->id }}</td>
                        <td>{{ $lista->nombre }}</td>
                        <td>
                            <a href="{{ route('lista.mostrar', $lista->id) }}" class="btn btn-primary">Ver podcasts</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
