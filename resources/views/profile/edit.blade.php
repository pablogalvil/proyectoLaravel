@extends('layouts.app')

@section('title', 'Editar perfil')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Editar Perfil</h2>

            <!-- Formulario para actualizar los datos del perfil -->
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Campos del formulario para editar los datos del perfil (nombre, email, imagen, etc.) -->
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control rounded-lg" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="form-control rounded-lg" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="form-group">
                    <label for="image">Imagen de perfil</label>
                    <input type="file" id="image" name="image" class="form-control rounded-lg">
                </div>

                <!-- Botón para actualizar el perfil -->
                <button type="submit" class="btn mt-3 w-100" style="background-color: rgb(230, 198, 68); color: white;">Actualizar perfil</button>
            </form>

            <!-- Botón para regresar al perfil -->
            <div class="mt-3">
                <a href="{{ route('profile.show') }}" class="btn w-100" style="background-color: #ff5733; color: white;">Volver al perfil</a>
            </div>
        </div>
    </div>
@endsection
