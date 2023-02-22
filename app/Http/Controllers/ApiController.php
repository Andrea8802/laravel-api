<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Movie;
use App\Models\Genre;
use App\Models\Tag;
use App\Mail\NewMovie;
use App\Mail\EditMovie;

class ApiController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genre', 'tags')->get();
        $genres = Genre::all();
        $tags = Tag::all();

        return response()->json([
            'success' => true,
            'response' => [
                'movies' => $movies,
                'genres' => $genres,
                'tags' => $tags
            ]

        ]);
    }

    public function movieDelete(Movie $movie)
    {
        $movie->tags()->sync([]);
        $movie->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function movieStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:64',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'cash_out' => 'integer|min:0|max:2147483647',
            'genre_id' => 'required|integer',
            'tags' => 'required|array'
        ]);

        $movie = Movie::make($data);

        $genre = Genre::find($data['genre_id']);
        $movie->genre()->associate($genre);
        $movie->save();

        $tags = Tag::find($data['tags']);
        $movie->tags()->attach($tags);

        Mail::to('admin@bestcinema.com')
            ->send(new NewMovie($movie));

        return response()->json([
            'success' => true,
            'response' => $movie
        ]);
    }

    public function movieUpdate(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'name' => 'required|string|max:64',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'cash_out' => 'integer|min:0|max:2147483647',
            'genre_id' => 'required|integer',
            'tags' => 'required|array'
        ]);

        $oldMovie = clone $movie;

        $movie->update($data);

        $genre = Genre::find($data['genre_id']);
        $movie->genre()->associate($genre);
        $movie->save();

        $tags = Tag::find($data['tags']);
        $movie->tags()->sync($tags);

        Mail::to('admin@bestcinema.com')
            ->send(new EditMovie($oldMovie, $movie));

        return response()->json([
            'success' => true,
            'response' => $movie
        ]);
    }
}