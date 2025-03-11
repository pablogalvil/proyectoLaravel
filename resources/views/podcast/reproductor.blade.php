@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Reproduciendo: {{ $episodio->titulo }}</h2>

    <div class="d-flex justify-content-center mt-5">
        <audio controls autoplay id="audio">
            <source src="{{ $episodio->getAudioUrl() }}" type="audio/mpeg">
            Tu navegador no soporta el elemento de audio.
        </audio>
    </div>

    <button id="startTranscription" class="btn btn-warning mt-3">Iniciar Transcripción</button>
    <p id="transcription" class="mt-3"></p>

    <div class="pb-4 mt-5">
        <a href="{{ url()->previous() }}" class="btn btn-warning">Volver</a>
    </div>
</div>

<script>
    document.getElementById("startTranscription").addEventListener("click", function() {
        const recognition = new webkitSpeechRecognition() || new SpeechRecognition();
        recognition.lang = "es-ES";
        recognition.interimResults = true;
        recognition.continuous = true;

        recognition.onresult = function(event) {
            let transcript = event.results[event.results.length - 1][0].transcript;
            document.getElementById("transcription").innerText = "Transcripción: " + transcript;
        };

        recognition.onerror = function(event) {
            console.error("Error en reconocimiento: ", event.error);
        };

        recognition.start();
        console.log("Escuchando...");
    });
</script>
@endsection
