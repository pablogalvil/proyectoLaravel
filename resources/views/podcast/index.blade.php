@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Listado de podcasts</h1>
        <a href="{{ route('podcast.create') }}" class="btn btn-primary mb-3">Nuevo podcast</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Duración</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha de publicación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($podcast as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->duracion }}</td>
                        <td><a href="#" class="ver-detalles" data-id="{{ $producto->id }}">{{ $producto->nombre }}</a></td>
                        </td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->fechaPublicacion }}</td>
                        <td>
                            <a href="{{ route('podcast.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('podcast.destroy', $producto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar este podcast?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal para detalles -->
    <div class="modal fade" id="modalDetalles" tabindex="-1" aria-labelledby="modalDetallesLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetallesLabel">Detalles del Podcast</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detallesPodcast">
                    Cargando...
                </div>
            </div>
        </div>
    </div>

    <script>
        //ruta imagen
        let rutaImg = "/storage/imagenes/podcast/";
        document.addEventListener("DOMContentLoaded", function () {
            //capturamos el elemento con la clase ver-detalles
            document.querySelectorAll(".ver-detalles").forEach(button => {
                button.addEventListener("click", function () {
                    //capturamos el id del podcast
                    let podcastId = this.getAttribute("data-id");
                    //hacemos un fetch para obtener los detalles del podcast (AJAX)
                    fetch(`/podcast/show/${podcastId}`)
                        .then(response => response.json())
                        .then(data => {
                            let detallesHtml = `<p><strong>ID:</strong> ${data.id}</p>
                                                    <p><strong>Imagen:</strong> <img src="${rutaImg}${data.imagen}" width="200" height="200" alt="Imagen del Podcast"></p>
                                                    <p><strong>Título:</strong> ${data.nombre}</p>
                                                    <p><strong>Duración:</strong> ${data.duracion}</p>
                                                    <p><strong>Descripción:</strong> ${data.descripcion}</p>
                                                    <p><strong>Fecha de Publicación:</strong> ${data.fechaPublicacion}</p>`;
                            //capturamos el elemento con el id detallesPodcast
                            document.getElementById("detallesPodcast").innerHTML = detallesHtml;
                            // mostramos el modal con los detalles
                            let modal = new bootstrap.Modal(document.getElementById("modalDetalles"));
                            modal.show();
                        });
                });
            });
        });
    </script>
@endsection