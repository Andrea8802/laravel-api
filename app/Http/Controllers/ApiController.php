<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;

class ApiController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return response()->json([
            'success' => true,
            'response' => $movies
        ]);
    }
}