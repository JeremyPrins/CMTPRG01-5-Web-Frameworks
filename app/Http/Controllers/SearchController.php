<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class SearchController extends Controller
{
    public function index()
    {
        $result= '';
        $genres = Genre::orderBy('name', 'asc')->get();

        foreach ($genres as $genre) {
            $availableGenres[$genre->id] = $genre->name;
        }

        return view('pages.search', compact('availableGenres', 'result'));
    }

    public function selectGenres(Request $selectedGenre)
    {
        $this->validate($selectedGenre, [
            'id' => 'required'
        ]);


        $genre = Genre::find($selectedGenre['id']);
        $result = $genre->movies;

        $genres = Genre::orderBy('name', 'asc')->get();

        foreach ($genres as $genre) {
            $availableGenres[$genre->id] = $genre->name;
        }

        return view('pages.search', compact('result', 'availableGenres', 'genre'));

    }
}
