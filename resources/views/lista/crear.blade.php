@extends('layout.app')

@section('content')
    <div class="container">
        <form action="{{ route('lista.insertar') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear lista</button>
        </form>
    </div>
@endsection
