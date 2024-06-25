<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MovieCard extends Component
{

    public $movie;

    /**
     * Create a new component instance.
     *
     * @param  mixed  $movie
     * @return void
     */
    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */

    public function render(): View|Closure|string
    {
        return view('components.movie.movie-card');
    }
}
