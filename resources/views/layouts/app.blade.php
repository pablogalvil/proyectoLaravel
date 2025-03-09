<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap & jQuery -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- Aquí agregamos el enlace de los iconos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

    <style>
        body {
            background-color: black;
            color: white;
        }

        main {
            background-color: grey;
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

        h2 {
            padding-top: 30px;
            font-size: 30px;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Cabecera personalizada -->
        <header class="bg-dark py-3">
            <div class="container d-flex justify-content-between align-items-center">
                <!-- Título clickeable que redirige a listarPodcast -->
                <a href="{{ route('podcast.listar') }}" class="text-white text-decoration-none">
                    <h1 class="text-white display-5 mx-auto">TríoCast</h1>
                </a>

                <!-- Verifica si el usuario está autenticado -->
        @if (Auth::check()) <!-- Verifica si el usuario está autenticado -->
            <div class="d-flex align-items-center">
                <!-- Nombre del usuario -->
                <p class="text-white mb-0 me-4">{{ Auth::user()->name }}</p>

                <!-- Ícono de Logout -->
                <a href="{{ route('logout') }}" class="text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Exit
</a>


                <!-- Formulario para hacer logout -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        @else
            <div>
                <p class="text-white mb-0">Bienvenido, visitante</p>
            </div>
        @endif
    </div>
        </header>




        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer personalizado -->
        <footer class="bg-dark text-white py-4">
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
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>