@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Reproduciendo: {{ $episodio->titulo }}</h2>

    <div class="d-flex justify-content-center mt-5">
        <audio controls autoplay>
            <source src="{{ $episodio->getAudioUrl() }}" type="audio/mpeg">
            Tu navegador no soporta el elemento de audio.
        </audio>
    </div>

    <div class="pb-4 mt-5">
        <a href="{{ url()->previous() }}" class="btn btn-warning">Volver</a>
    </div>
</div>
@endsection
