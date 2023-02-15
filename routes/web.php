<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;


Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/movie/delete/{movie}', [MainController::class, 'movieDelete'])->name('movie.delete');