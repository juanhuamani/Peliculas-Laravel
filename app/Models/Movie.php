<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'poster',
    ];

    protected $table = 'movies';

    public function categories()
    {
        return $this->belongsToMany(Category::class , 'category_movie' , 'movie_id' , 'category_id');
    }

    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
