<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Movie;
use App\Models\User;
use App\Models\Director;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $generos = [
            'Acción',
            'Aventura',
            'Comedia',
            'Drama',
            'Ciencia Ficción'
        ];

        $moviesData  = [
            [
                'title' => 'They Shall Not Grow Old',
                'year' => 2018,
                'poster' => 'https://m.media-amazon.com/images/M/MV5BZWI3ZThmYzUtNDJhOC00ZWY4LThiNmMtZDgxNjE3Yzk4NDU1XkEyXkFqcGdeQXVyNTk5Nzg1NjQ@._V1_SX300.jpg'
            ],
            [
                'title' => 'Midnight Family',
                'year' => 2019,
                'poster' => 'https://m.media-amazon.com/images/M/MV5BMGYyZTk5MjYtNGY2ZS00NzRhLTgwMWMtZjhmMmQ4OGFkNTNiXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_SX300.jpg'
            ],
            [
                'title' => 'Pain & Gain',
                'year' => 2013,
                'poster' => 'https://m.media-amazon.com/images/M/MV5BMTU0NDE5NTU0OV5BMl5BanBnXkFtZTcwMzI1OTMzOQ@@._V1_SX300.jpg'
            ],
            [
                'title' => 'The Irishman',
                'year' => 2019,
                'poster' => 'https://m.media-amazon.com/images/M/MV5BMGUyM2ZiZmUtMWY0OC00NTQ4LThkOGUtNjY2NjkzMDJiMWMwXkEyXkFqcGdeQXVyMzY0MTE3NzU@._V1_SX300.jpg'
            ],
            [
                'title' => 'Once Upon a Time... in Hollywood',
                'year' => 2019,
                'poster' => 'https://m.media-amazon.com/images/M/MV5BOTg4ZTNkZmUtMzNlZi00YmFjLTk1MmUtNWQwNTM0YjcyNTNkXkEyXkFqcGdeQXVyNjg2NjQwMDQ@._V1_SX300.jpg'
            ],
            [
                'title' => 'Marriage Story',
                'year' => 2019,
                'poster' => 'https://m.media-amazon.com/images/M/MV5BZGVmY2RjNDgtMTc3Yy00YmY0LTgwODItYzBjNWJhNTRlYjdkXkEyXkFqcGdeQXVyMjM4NTM5NDY@._V1_SX300.jpg'
            ],
            [
                'title' => 'Little Women',
                'year' => 1994,
                'poster' => 'https://m.media-amazon.com/images/I/61TK-+geKPL._AC_UF894,1000_QL80_.jpg'
            ],
            [
                'title' => 'Parasite',
                'year' => 2019,
                'poster' => 'https://m.media-amazon.com/images/M/MV5BYWZjMjk3ZTItODQ2ZC00NTY5LWE0ZDYtZTI3MjcwN2Q5NTVkXkEyXkFqcGdeQXVyODk4OTc3MTY@._V1_SX300.jpg'
            ],
            [
                'title' => 'Knives Out',
                'year' => 2019,
                'poster' => 'https://m.media-amazon.com/images/M/MV5BMGUwZjliMTAtNzAxZi00MWNiLWE2NzgtZGUxMGQxZjhhNDRiXkEyXkFqcGdeQXVyNjU1NzU3MzE@._V1_SX300.jpg'
            ],
            [
                'title' => 'Dolemite Is My Name',
                'year' => 2019,
                'poster' => 'https://m.media-amazon.com/images/M/MV5BMzFiYWQxYzgtOThmYi00ZmIwLWFlZWMtMzk2NTI2YTYzMjkyXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_SX300.jpg'
            ]
        ];

        $directors =  [
            "Steven Spielberg",
            "Martin Scorsese",
            "Quentin Tarantino",
            "Alfred Hitchcock",
        ];

        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(20),
            'email_verified_at' => now(),
        ]);

        $directorIds = [];
        foreach ($directors as $directorName) {
            $director = Director::create(['name' => $directorName]);
            $directorIds[] = $director->id;
        }


        $categoryIds = Category::pluck('id')->toArray();

        if (empty($categoryIds)) {
            // Create some default categories if none exist
            foreach ($generos as $genereName) {
                $genere = Category::create(['name' => $genereName]);
                $categoryIds[] = $genere->id;
            }
        }

        foreach ($moviesData as $movieData) {
            $randomDirectorId = $directorIds[array_rand($directorIds)];
            // Create a new movie
            $movie = Movie::create([
                'title' => $movieData['title'],
                'year' => $movieData['year'],
                'poster' => $movieData['poster'],
                'director_id' => $randomDirectorId
            ]);
        
            // Attach random categories to the movie
            $numberOfCategories = min(2, count($categoryIds)); 
            $randomCategoryIds = array_rand(array_flip($categoryIds), $numberOfCategories);
            if (!is_array($randomCategoryIds)) {
                $randomCategoryIds = [$randomCategoryIds];
            }
            $movie->categories()->attach($randomCategoryIds);
        }

    }
}
