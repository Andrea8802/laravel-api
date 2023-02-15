@extends('layouts.main-layout')

@section('content')
    <form action="{{ route('movie.update', $movie) }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ $movie->name }}">
        <br>
        <label for="year">Year</label>
        <input type="number" name="year" value="{{ $movie->year }}">
        <br>
        <label for="cash_out">CashOut</label>
        <input type="number" name="cash_out" value="{{ $movie->cash_out }}">
        <br>
        <select name="genre_id">
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" @if ($movie->genre->id == $movie->id) selected @endif>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>

        @foreach ($tags as $tag)
            <br>
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                @foreach ($movie->tags as $movieTag)
                @if ($movieTag->id == $tag->id) checked
                @endif @endforeach>
            <label for="tags">{{ $tag->name }}</label>
        @endforeach

        <input type="submit" value="Update Movie">
    </form>
@endsection
