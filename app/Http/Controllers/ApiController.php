<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;

class ApiController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genre', 'tags')->get();
        return response()->json([
            'success' => true,
            'response' => $movies
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
}