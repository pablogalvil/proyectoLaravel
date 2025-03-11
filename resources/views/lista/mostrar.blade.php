@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Podcasts de la lista "{{ $listas->nombre }}"</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha de publicación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($podcasts as $podcast)
                    <tr>
                        <td>{{ $podcast->id }}</td>
                        <td>{{ $podcast->titulo }}</td>
                        <td>{{ $podcast->descripcion }}</td>
                        <td>{{ $podcast->fecha_publicacion }}</td>
                        @if (auth()->user()->role == 'admin')
                            <td>
                                <a href="{{ route('lista.eliminar', $podcast->id) }}" class="btn btn-primary">Eliminar</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
