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
        $searchName = $request->input('searchName');
        $searchYear = $request->input('searchYear');
        $categoriesS = $request->input('categories');
        $directorS = $request->input('directors');

        $query = Movie::query();

        if ($searchName) {
            $query->where('title', 'like', '%' . $searchName . '%');
        }

        if ($searchYear) {
            $query->where('year', $searchYear);
        }

        if ($categoriesS) {
            foreach ($categoriesS as $categoryId) {
                $query->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('category_id', $categoryId);
                });
            }
        }

        if ($directorS) {
            $query->whereHas('director', function ($q) use ($directorS) {
                $q->where('id', $directorS);
            });
        }

        $movies = $query->paginate(3)->appends($request->query());
        $categories = Category::all();
        $directors = Director::all();

        return view('home' , compact('movies', 'categories', 'directors' , 'searchName' , 'searchYear' , 'categoriesS' , 'directorS'));
    }
}
