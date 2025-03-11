@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Añadir podcast a una lista</h1>
        <form action="{{ route('lista.agregar') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="podcast_id" class="form-label">Podcast</label>
                <select name="podcast_id" id="podcast_id" class="form-control">
                    @foreach ($podcasts as $podcast)
                        <option value="{{ $podcast->id }}">{{ $podcast->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="lista_id" class="form-label">Lista</label>
                <select name="lista_id" id="lista_id" class="form-control">
                    @foreach ($listas as $lista)
                        <option value="{{ $lista->id }}">{{ $lista->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Añadir</button>
        </form>
    </div>
@endsection
