@extends('layouts.app')

@section('title', 'Perfil de ' . $user->name)

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-8">
        <h2 class="text-center mb-4">Perfil de {{ $user->name }}</h2>

        <!-- Mostrar los datos del usuario -->
        <div class="row">
            <!-- Columna izquierda que ocupará más espacio -->
            <div class="col-md-8 mb-4"  style="padding-left: 70px;">
            <p><strong>Foto de perfil:</strong> 
                @if($user->image)
                    @if(filter_var($user->image, FILTER_VALIDATE_URL))
                        <!-- Si la imagen es una URL válida, mostrarla -->
                        <img src="{{ $user->image }}" alt="Foto de perfil" class="rounded-circle" style="width: 100px; height: 100px;">
                    @else
                        <!-- Si la imagen no es una URL, usar la imagen local -->
                        <img src="{{ asset('storage/'.$user->image) }}" alt="Foto de perfil" class="rounded-circle" style="width: 100px; height: 100px;">
                    @endif
                @else
                    <!-- Imagen por defecto si no hay imagen -->
                    <img src="{{ asset('storage/images/default-avatar.png') }}" alt="Foto de perfil predeterminada" class="rounded-circle" style="width: 100px; height: 100px;">
                @endif
            </p>
                <p><strong>Nombre:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Rol:</strong> {{ $user->role }}</p>
            </div>

            <!-- Columna derecha que ocupará menos espacio -->
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-start mb-4" >
                <!-- Botón para editar -->
                <a href="{{ route('profile.edit') }}" class="btn mb-3" style="background-color: rgb(230, 198, 68); color: white;">Editar perfil</a>

                <!-- Formulario para eliminar usuario -->
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background-color: #ff5733; color: white;" onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta?')">Eliminar cuenta</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
