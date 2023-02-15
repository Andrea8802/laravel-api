@extends('layouts.main-layout')

@section('content')
    <form action="{{ route('movie.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name">
        <br>
        <label for="year">Year</label>
        <input type="number" name="year">
        <br>
        <label for="cash_out">CashOut</label>
        <input type="number" name="cash_out">
        <br>
        <select name="genres_id">
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>

        @foreach ($tags as $tag)
            <br>
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
            <label for="tags">{{ $tag->name }}</label>
        @endforeach

        <input type="submit" value="Create Movie">
    </form>
@endsection
