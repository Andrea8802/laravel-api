@extends('layouts.main-layout')

@section('content')
    @foreach ($genres as $genre)
        <h2>
            {{ $genre->name }}
        </h2>
        <hr>

        @foreach ($movies as $movie)
            <b>Movie: </b>{{ $movie->name }} ({{ $movie->year }})
            <br>
            <b>CashOut: </b> {{ $movie->cashOut }}&euro;
            <br>
            <br>
        @endforeach
    @endforeach
@endsection
