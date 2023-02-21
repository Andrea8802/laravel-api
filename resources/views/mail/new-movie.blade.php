<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
        }
    </style>
</head>

<body>
    <h1>Movie Created!</h1>
    <h2>A new "Movie" has been created.</h2>
    <b>Name: </b> {{ $movie->name }} ({{ $movie->year }})
    <br>
    <b>CashOut: </b> {{ $movie->cash_out }}
    <br>
    <b>Genre: </b> {{ $movie->genre->name }}
    <br>
    <b>Tags: </b>
    @foreach ($movie->tags as $tag)
        {{ $tag->name }};
    @endforeach
</body>

</html>
