<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use App\Movie;
use App\Genre;
use Illuminate\Support\Facades\DB;


class MoviesController extends Controller
{

    public function show($id)
    {
        $movie = Movie::find($id);
        return view('movies.show')->with('movie', $movie);
    }


}
