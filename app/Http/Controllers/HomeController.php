<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Movie;
use App\Models\Category;
use App\Models\Director;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('searchName');
        $year = $request->input('searchYear');
        $category = $request->input('categories');
        $director = $request->input('directors');

        $query = Movie::query()
            ->when($name, function ($q) use ($name) {
                return $q->where('title', 'like', '%' . $name . '%');
            })
            ->when($year, function ($q) use ($year) {
                return $q->where('year', $year);
            })
            ->when($category, function ($q) use ($category) {
                foreach ($category as $categoryId) {
                    $q->whereHas('categories', function ($q) use ($categoryId) {
                        $q->where('category_id', $categoryId);
                    });
                }
            })
            ->when($director, function ($q) use ($director) {
                return $q->whereHas('director', function ($q) use ($director) {
                    $q->where('id', $director);
                });
            });

        $movies = $query->paginate(3)->appends($request->query());
        $categories = Category::all();
        $directors = Director::all();

        return view('home',[ 'movies' => $movies, 'categories' => $categories, 'directors' => $directors, 'searchName' => $name , 'searchYear' => $year, 'categoriesS' => $category, 'directorS' => $director ] );
    }
}
