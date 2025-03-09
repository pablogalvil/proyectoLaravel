@extends('layouts.app')

@section('title', 'Listas')

@section('content')
<div class="container">
    <h1>Nuestras listas</h1>

    <!-- Tabla para mostrar las listas -->
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
                        <!-- Enlace para ver los podcasts de la lista -->
                        <a href="{{ route('lista.mostrar', $lista->id) }}" class="btn btn-primary">Ver podcasts</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
