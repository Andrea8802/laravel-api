<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Tag;

class MainController extends Controller
{
    public function home()
    {
        $genres = Genre::all();
        return view('pages.home', compact('genres'));
    }

    public function movieDelete(Movie $movie)
    {
        $movie->tags()->sync([]);
        $movie->delete();
        return redirect()->route('home');
    }

    public function movieCreate()
    {
        $genres = Genre::all();
        $tags = Tag::all();
        return view('pages.create', compact('genres', 'tags'));
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

        return redirect()->route('home');
    }

    public function movieEdit(Movie $movie)
    {
        $genres = Genre::all();
        $tags = Tag::all();
        return view('pages.edit', compact('movie', 'genres', 'tags'));
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

        $movie->update($data);
        $genre = Genre::find($data['genre_id']);

        $movie->genre()->associate($genre);
        $movie->save();

        $tags = Tag::find($data['tags']);
        $movie->tags()->sync($tags);

        return redirect()->route('home');

    }
}