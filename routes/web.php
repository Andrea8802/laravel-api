<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;


Route::get('/', [MainController::class, 'home'])->name('home');

Route::get('/movie/delete/{movie}', [MainController::class, 'movieDelete'])->name('movie.delete');

Route::get('/movie/create', [MainController::class, 'movieCreate'])->name('movie.create');
Route::post('/movie/store', [MainController::class, 'movieStore'])->name('movie.store');

Route::get('/movie/edit/{movie}', [MainController::class, 'movieEdit'])->name('movie.edit');
Route::post('/movie/update/{movie}', [MainController::class, 'movieUpdate'])->name('movie.update');


