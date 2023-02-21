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
    <h1>Movie Edited!</h1>
    <h2>A new "Movie" has been edited.</h2>

    <h3>Before:</h3>
    <b>Name: </b> {{ $oldMovie->name }} ({{ $oldMovie->year }})
    <br>
    <b>CashOut: </b> {{ $oldMovie->cash_out }}
    <br>
    <b>Genre: </b> {{ $oldMovie->genre->name }}
    <br>
    <b>Tags: </b>
    @foreach ($oldMovie->tags as $tag)
        {{ $tag->name }};
    @endforeach


    <h3>After:</h3>
    <b>Name: </b> {{ $newMovie->name }} ({{ $newMovie->year }})
    <br>
    <b>CashOut: </b> {{ $newMovie->cash_out }}
    <br>
    <b>Genre: </b> {{ $newMovie->genre->name }}
    <br>
    <b>Tags: </b>
    @foreach ($newMovie->tags as $tag)
        {{ $tag->name }};
    @endforeach
</body>

</html>
