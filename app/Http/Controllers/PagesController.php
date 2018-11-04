<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;


class PagesController extends Controller
{

    public function index()
    {
        $posters = Movie::orderBy('original_title', 'asc')->get();

        return view('pages.welcome')->with('posters', $posters);
    }

    public function overview()
    {
        $movies = Movie::orderBy('original_title', 'asc')->get();
        return view('pages.overview')->with('movies', $movies);

    }

}
