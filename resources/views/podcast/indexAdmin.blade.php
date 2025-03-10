@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Últimos Episodios</h2>

    <div class="lista mt-4 fs-5">
        <!-- Enlace para explorar las listas -->
        <a href="{{ route('lista.indice') }}">Explora nuestras listas</a>
    </div>

    <!-- Contenedor de Podcasts -->
    <div class="row row-cols-1 row-cols-md-4 g-4 mt-4">
        @foreach ($podcasts as $podcast)
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="{{ $podcast->imagen }}" class="card-img-top" alt="Imagen del podcast">
                    <div class="card-body">
                        <h5 class="card-title">
                            <!-- Enlace al detalle del podcast -->
                            <a href="#" class="ver-detalles" data-id="{{ $podcast->id }}">{{ $podcast->nombre }}</a>
                        </h5>
                        <a href="/podcast/{{ $podcast->id }}/comentarios" class="btn btn-warning">
                            Comentarios
                        </a>
                        <button class="btn btn-warning">
                            <a href="{{ route('podcast.reproducir', $podcast->id) }}" style="color: black; text-decoration: none;">Reproducir</a>
                        </button>





                        <!-- Agregar iconos debajo de cada podcast -->
                        <div class="mt-3 d-flex justify-content-center">
                            <!-- Enlace para editar el podcast -->
                            <a href="{{ route('podcast.editar', $podcast->id) }}">
                                <img src="{{ asset('icons/editar.png') }}" alt="Editar" class="icono-podcast" style="width: 24px; height: 24px;">
                            </a>

                            <!-- Formulario para eliminar el podcast -->
                            <form action="{{ route('podcast.eliminar', $podcast->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0" onclick="return confirm('¿Estás seguro de eliminar este podcast?')">
                                    <img src="{{ asset('icons/eliminar.png') }}" alt="Eliminar" class="icono-podcast" style="width: 24px; height: 24px;">
                                </button>
                            </form>
                            
                            <!-- Enlace para agregar el podcast a una lista -->
                            <a href="{{ route('podcast.crear') }}" class="ml-3">
                                <img src="{{ asset('icons/agregar.png') }}" alt="Agregar" class="icono-podcast" style="width: 24px; height: 24px;">
                            </a>

                            <!-- Enlace para ver detalles del podcast -->
                            <a href="#" class="ml-3 ver-detalles" data-id="{{ $podcast->id }}">
                                <img src="{{ asset('icons/ver.png') }}" alt="Ver" class="icono-podcast" style="width: 24px; height: 24px;">
                            </a>
                        </div>
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

<!-- Modal para detalles -->
<div class="modal fade" id="modalDetalles" tabindex="-1" aria-labelledby="modalDetallesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetallesLabel">Detalles del podcast</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detallesPodcast">
                Cargando...
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/podcast.js') }}"></script>

<script>
     //ruta imagen
     let rutaImg = "/storage/imagenes/podcast/";
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".ver-detalles").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault(); // Evita que el enlace navegue a otra página

                let podcastId = this.getAttribute("data-id");
                console.log("ID del podcast:", podcastId);

                fetch(`/podcast/mostrar/${podcastId}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log("Datos recibidos:", data); // Verificar si los datos llegan aquí

                        let detallesHtml = `
                        <p><img src="${rutaImg}${data.imagen}" width="100" height="100" alt="Imagen del Podcast"></p>
                        <p class="text-dark"><strong>Título:</strong> ${data.nombre}</p>
                        <p class="text-dark" ><strong>Duración:</strong> ${data.duracion}</p>
                        <p class="text-dark" ><strong>Descripción:</strong> ${data.descripcion}</p>
                        <p class="text-dark"><strong>Fecha de publicación:</strong> ${data.fechaPublicacion}</p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>`;

                        document.getElementById("detallesPodcast").innerHTML = detallesHtml;

                        let modalElement = document.getElementById("modalDetalles");
                        let modal = new bootstrap.Modal(modalElement);
                        modal.show();
                    })
                    .catch(error => console.error("Error al cargar los detalles:", error));
            });
        });
    });
</script>

@endsection
