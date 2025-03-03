@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Listado de podcasts</h1>
        <a href="{{ route('podcast.create') }}" class="btn btn-primary mb-3">Nuevo Cliente</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Duración</th>
                    <th>Título</th>
                    <th>Audio</th>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th>Fecha de publicación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($podcast as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td><a href="{{ route('podcast.show', $producto->id) }}">{{ $producto->nombre }}</a></td>
                        <td>{{ $producto->duracion }}</td>
                        <td>{{ $producto->titulo }}</td>
                        <td>{{ $producto->audio }}</td>
                        <td> @if ($producto->imagen)
                            <img src="{{ asset('storage/' . $podcast->imagen) }}" alt="Imagen de {{ $podcast->nombre }}"
                                class="img-fluid rounded" style="max-width: 200px;">
                        @else
                            <p>No hay imagen disponible.</p>
                        @endif
                        </td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->fechaPublicacion }}</td>
                        <td>
                            <a href="{{ route('podcast.edit', $podcast->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('podcast.destroy', $podcast->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar este cliente?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection