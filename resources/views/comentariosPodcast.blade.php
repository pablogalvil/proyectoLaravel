
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios del Podcast</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: black;
            color: white;
        }
        .card {
            background-color: #222;
            color: white;
            border: none;
        }
        .comment {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #444;
        }
        .comment:last-child {
            border-bottom: none;
        }
        .comment img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
        }
        .comment-content {
            flex: 1;
        }
        .comment-user {
            font-weight: bold;
        }
        .comment-date {
            font-size: 0.9em;
            color: #bbb;
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
    <header class="bg-dark text-center py-3">
        <h1 class="text-white">TríoCast</h1>
    </header>

    <div class="container my-5">
        <h2 class="text-center"><?= htmlspecialchars($podcast->nombre) ?></h2>
        <p class="text-center"><?= htmlspecialchars($podcast->descripcion) ?></p>

        <div class="mt-5">
            <h3 class="container text-center">Comentario de nuestros oyentes</h3>
            <div class="card p-3">
            <?php if (count($podcast->comentarios) > 0): ?>
                    <?php foreach ($podcast->comentarios as $comentario): ?>
                        <div class="comment">
                            @if($comentario->user->image)
                                @if(filter_var($comentario->user->image, FILTER_VALIDATE_URL))
                                    <!-- Si la imagen es una URL válida, mostrarla -->
                                    <img src="{{ $comentario->usuario->image }}" alt="Foto de perfil" class="rounded-circle" style="width: 100px; height: 100px;">
                                @else
                                    <!-- Si la imagen no es una URL, usar la imagen local -->
                                    <img src="{{ asset('storage/'.$comentario->usuario->image) }}" alt="Foto de perfil" class="rounded-circle" style="width: 100px; height: 100px;">
                                @endif
                            @else
                                <!-- Imagen por defecto si no hay imagen -->
                                <img src="{{ asset('images/default-avatar.png') }}" alt="Foto de perfil predeterminada" class="rounded-circle" style="width: 100px; height: 100px;">
                            @endif
                            <div class="comment-content">
                                <p class="comment-user"><?= htmlspecialchars($comentario->usuario->nombre) ?></p>
                                <p class="comment-date"><?= htmlspecialchars($comentario->fecha) ?></p>
                                <p><?= htmlspecialchars($comentario->descripcion) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Aún no hay comentarios para este podcast.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container text-center">
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('podcast.listarPodcastAdmin') }}" class="btn btn-light">Volver</a>
        @else
            <a href="{{ route('podcast.listar') }}" class="btn btn-light">Volver</a>
        @endif
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
</body>
</html>

