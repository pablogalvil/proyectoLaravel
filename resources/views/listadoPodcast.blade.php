<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TríoCast</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: black;
            color: white;
        }
        .card {
            background-color: #222;
            color: white;
        }
        #ver-mas-btn {
            cursor: pointer;
            display: block;
            text-align: center;
            margin-top: 15px;
        }
        a {
            text-decoration: none; 
            color: white; 
        }
        a:hover {
            color: gray; 
        }

        .derechos {
            margin-top: 40px;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
    <!-- Cabecera -->
    <header class="bg-dark text-center py-3">
        <h1 class="text-white">TríoCast</h1>
    </header>

    <!-- Contenido Principal -->
    <div class="container text-center my-5">
        <h2>Últimos Episodios</h2>
        <p>Explora nuestros podcasts y deja tu valoración</p>
        
        <!-- Contenedor de Podcasts -->
        <div class="row row-cols-1 row-cols-md-4 g-4 mt-4" id="podcast-container">
            <!-- Los podcasts se cargarán aquí con el Script -->
        </div>

        <!-- Enlace "Ver más..." -->
        <div class="text-center mt-4">
            <a href="#" id="ver-mas-btn" class="text-white text-decoration-none">Ver más...</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <h5>Escúchanos en...</h5>
                    <a href="#">Spotify</a><br>
                    <a href="#">Apple Music</a><br>
                    <a href="#">YouTube Music</a><br>
                    <a href="#">Amazon Music</a><br>
                    <a href="#">Deezer</a><br>
                </div>
                <div class="col-md-4">
                    <h5>Síguenos en...</h5>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
                <div class="col-md-4">
                    <h5>Información</h5>
                    <a href="#">Aviso Legal</a><br>
                    <a href="#">Términos y Condiciones</a><br>
                    <a href="#">Política de Cookies</a><br>
                    <a href="#">Política de Privacidad</a><br>
                    <a href="#">Pago Seguro</a><br>
                </div>
            </div>
            
        </div>
        <div class="container text-center">
            <p class="derechos">&copy; 2025 TríoCast - Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Script para cargar podcasts dinámicamente -->
    <script>
        // Declaramos la variable para la paginación
        let page = 1; 

        function cargarPodcasts() {
            $.ajax({
                // Llama a la función listarPodcast de PodcastController
                url: `/listarPodcast?page=${page}`, 
                // La petición es de tipo GET
                method: 'GET',
                // Los datos se devuelven en formato JSON
                dataType: 'json',
                // Si la petición funciona, se ejecuta la siguiente función donde se recogen los datos
                success: function (podcasts) {
                    // Obtenemos el contenedor de podcasts
                    let container = $("#podcast-container");

                    // Si no hay más podcasts, que no salga el enlace "Ver más..."
                    if (podcasts.length === 0) {
                        $("#ver-mas-btn").hide();
                        return;
                    }

                    // Se va añadiendo cada podcast en una card
                    podcasts.forEach(podcast => {
                        let card = `
                              <div class="col">
                                <div class="card h-100 text-center">
                                    <img src="${podcast.imagen}" class="card-img-top" alt="Imagen del podcast">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="/detalles.php?id=${podcast.id}">${podcast.nombre}</a>
                                        </h5>
                                        <a href="/podcast/${podcast.id}/comentarios" class="btn btn-warning">
                                            <i class="fas fa-star"></i> Comentar
                                        </a>

                                    </div>
                                </div>
                            </div>`;
                        container.append(card);
                    });

                    // Aumentamos la página 
                    page++; 
                },
                error: function () {
                    alert("Error al cargar los podcasts.");
                }
            });
        }

        // Cargamos los primeros 10 podcasts cuando se carga la página
        $(document).ready(function () {
            cargarPodcasts();

            // Evento para cargar más podcasts al hacer clic en "Ver más..."
            $("#ver-mas-btn").click(function (e) {
                // Esto evita que el enlace recargue la página
                e.preventDefault(); 
                // Cargamos los siguientes 10 podcasts
                cargarPodcasts();
            });
        });
    </script>
</body>
</html>
