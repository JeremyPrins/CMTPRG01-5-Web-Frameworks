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

        $rating = review::where('movie_id', $id)->get()->avg(['rating']);


        return view('movies.show')->with('movie', $movie)->with('rating', $rating);
    }


}
