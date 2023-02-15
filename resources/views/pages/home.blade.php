@extends('layouts.main-layout')

@section('content')
    <a href="{{ route('movie.create') }}">Create Movie</a>
    @foreach ($genres as $genre)
        <h2>
            {{ $genre->name }}
        </h2>
        <p>
            {{ $genre->description }}
        </p>
        <hr>

        @foreach ($genre->movies as $movie)
            <a href="{{ route('movie.delete', $movie) }}">X</a>
            <b>Movie: </b>{{ $movie->name }} ({{ $movie->year }})
            <br>
            <b>CashOut: </b> {{ $movie->cash_out }}&euro;
            <a href="{{ route('movie.edit', $movie) }}">EDIT</a>
            <br>
            <br>
        @endforeach
    @endforeach
@endsection
