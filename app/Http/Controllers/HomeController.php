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

        $query = Movie::query()
            ->when($searchName, function ($q) use ($searchName) {
            return $q->where('title', 'like', '%' . $searchName . '%');
            })
            ->when($searchYear, function ($q) use ($searchYear) {
            return $q->where('year', $searchYear);
            })
            ->when($categoriesS, function ($q) use ($categoriesS) {
            foreach ($categoriesS as $categoryId) {
                $q->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
                });
            }
            })
            ->when($directorS, function ($q) use ($directorS) {
            return $q->whereHas('director', function ($q) use ($directorS) {
                $q->where('id', $directorS);
            });
            });

        $movies = $query->paginate(3)->appends($request->query());
        $categories = Category::all();
        $directors = Director::all();

        return view('home' , compact('movies', 'categories', 'directors' , 'searchName' , 'searchYear' , 'categoriesS' , 'directorS'));
    }
}
