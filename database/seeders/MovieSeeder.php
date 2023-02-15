<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Tag;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::factory()->count(100)->make()->each(function ($movie) {
            $genre = Genre::inRandomOrder()->first();
            $movie->genres()->associate($genre);

            $movie->save();

            $tag = Tag::inRandomOrder()->limit(5)->get();
            $movie->tags()->attach($tag);
        });
    }
}