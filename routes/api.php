<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/v1/movie/all', [ApiController::class, 'index']);

Route::get('v1/movie/delete/{movie}', [ApiController::class, 'movieDelete']);
Route::post('v1/movie/store', [ApiController::class, 'movieStore']);