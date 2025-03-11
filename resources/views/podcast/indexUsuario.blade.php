@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2>Últimos Episodios</h2>
        <p>Escucha nuestros podcasts y deja tu comentario</p>

        <div class="lista mt-4 fs-5">
            <a href="{{ route('lista.indiceUsuario') }}">Explora nuestras listas</a>
        </div>

        <!-- Contenedor de Podcasts -->
        <div class="row row-cols-1 row-cols-md-4 g-4 mt-4">
            @foreach ($podcasts as $podcast)
                <div class="col">
                    <div class="card h-100 text-center">
                        <img src="{{ $podcast->imagen }}" class="card-img-top" alt="Imagen del podcast">
                        <div class="card-body">
                            <h5 class="card-title">

                                <td><a href="javascript:void(0);" class="ver-detalles"
                                        data-id="{{ $podcast->id }}">{{ $podcast->nombre }}</a></td>

                            </h5>
                            <a href="/podcast/{{ $podcast->id }}/comentarios" class="btn btn-warning">
                                Comentarios
                            </a>
                            <a href="" class="btn btn-warning">
                                Reproducir
                            </a>
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

    <script>
        // Ruta imagen
        let rutaImg = "/storage/imagenes/podcast/";

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".ver-detalles").forEach(button => {
                button.addEventListener("click", function (event) {
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
                                <p class="text-dark"><strong>Duración:</strong> ${data.duracion}</p>
                                <p class="text-dark"><strong>Descripción:</strong> ${data.descripcion}</p>
                                <p class="text-dark"><strong>Fecha de publicación:</strong> ${data.fechaPublicacion}</p>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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

                            // Mostrar el modal
                            let modal = new bootstrap.Modal(document.getElementById("modalDetalles"));
                            modal.show();

                            // Evento asincrónico para el botón "Ver más"
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