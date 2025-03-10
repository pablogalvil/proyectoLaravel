@extends('layout.app')

@section('content')
    
    <div class="lista">
        <a href="{{ route('lista.indice') }}">Nuestras listas</a>
    </div>
    <div class="container">
        <h1>Listado de podcasts</h1>
        <a href="{{ route('podcast.crear') }}" class="btn btn-primary mb-3">Nuevo podcast</a>
        <a href="{{ route('lista.aniadir') }}" class="btn btn-primary mb-3">Añadir podcast a lista</a>
        <table class="table table-bordered">
            <thead>
                <!--creamos la tabla -->
                <tr>
                    <th>Duración</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha de publicación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!--creamos la tabla -->
                @foreach ($podcast as $producto)
                    <!--imprimimos cada uno de los podcasts -->
                    <tr>
                        <td>{{ $producto->duracion }}</td>
                        <td><a href="#" class="ver-detalles" data-id="{{ $producto->id }}">{{ $producto->nombre }}</a></td>
                        </td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->fechaPublicacion }}</td>
                        <td>
                            <a href="{{ route('podcast.editar', $producto->id) }}" class="btn btn-warning btn-sm">editar</a>
                            <form action="{{ route('podcast.eliminar', $producto->id) }}" method="POST" style="display:inline;">
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
                    <h5 class="modal-title" id="modalDetallesLabel">Detalles del podcast</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detallesPodcast">
                    Cargando...
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let rutaImg = "/storage/imagenes/podcast/";

            document.querySelectorAll(".ver-detalles").forEach(button => {
                button.addEventListener("click", function () {
                    let podcastId = this.getAttribute("data-id");

                    fetch(`/podcast/mostrar/${podcastId}`)
                        .then(response => response.json())
                        .then(data => {
                            let detallesHtml = `
                                                    <p><strong>Imagen:</strong> <img src="${rutaImg}${data.imagen}" width="100" height="100" alt="Imagen del Podcast"></p>
                                                    <p><strong>Título:</strong> ${data.nombre}</p>
                                                    <p><strong>Duración:</strong> ${data.duracion}</p>
                                                    <p><strong>Descripción:</strong> ${data.descripcion}</p>
                                                    <p><strong>Fecha de publicación:</strong> ${data.fechaPublicacion}</p>
                                                    <button id="verMas" class="btn btn-info">Ver más</button>
                                                    <div id="infoExtra" style="display:none; margin-top:10px;">
                                                        <h5>Información relacionada</h5>
                                                        <p><strong>Locutores:</strong> ${data.locutores.map(l => l.nombre).join(", ") || "No disponible"}</p>
                                                        <p><strong>Géneros:</strong> ${data.generos.map(g => g.nombre).join(", ") || "No disponible"}</p>
                                                        <p><strong>Invitados:</strong> ${data.invitados.map(i => i.nombre).join(", ") || "No disponible"}</p>
                                                        <p><strong>Equipos por locutor:</strong></p>
                                                        <ul>
                                                            ${data.locutores.map(locutor =>
                                `<li>${locutor.nombre}: ${locutor.equipos.map(equipo => equipo.nombre).join(", ") || "Sin equipo"}</li>`
                            ).join("")}
                                                        </ul>
                                                    </div>
                                                `;

                            document.getElementById("detallesPodcast").innerHTML = detallesHtml;

                            let modal = new bootstrap.Modal(document.getElementById("modalDetalles"));
                            modal.show();

                            setTimeout(() => {
                                document.getElementById("verMas").addEventListener("click", function () {
                                    let infoExtra = document.getElementById("infoExtra");
                                    infoExtra.style.display = infoExtra.style.display === "none" ? "block" : "none";
                                });
                            }, 500);
                        })
                        .catch(error => console.error('Error al obtener los detalles:', error));
                });
            });
        });
    </script>

@endsection