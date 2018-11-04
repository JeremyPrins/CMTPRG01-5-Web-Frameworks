<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use App\Genre;

class SearchController extends Controller
{
    public function index()
    {
        $result = '';
        $results = '';
        $genres = Genre::orderBy('name', 'asc')->get();

        foreach ($genres as $genre) {
            $availableGenres[$genre->id] = $genre->name;
        }

        return view('pages.search', compact('availableGenres', 'result', 'results'));
    }

    public function selectGenres(Request $selectedGenre)
    {

        $this->validate($selectedGenre, [
            'id' => 'required'
        ]);

        $results = '';
        $genre = Genre::find($selectedGenre['id']);
        $result = $genre->movies;

        $genres = Genre::orderBy('name', 'asc')->get();

        foreach ($genres as $genre) {
            $availableGenres[$genre->id] = $genre->name;
        }

        return view('pages.search', compact('result','results', 'availableGenres', 'genres'));

    }

    public function textSearch(Request $searchTerms)
    {

        $result = '';
        $genres = Genre::orderBy('name', 'asc')->get();

        foreach ($genres as $genre) {
            $availableGenres[$genre->id] = $genre->name;
        }


        $searchTerms = explode(' ', $searchTerms['search']);
        $query = Movie::query();

        foreach ($searchTerms as $searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('original_title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('release_date', 'like', '%' . $searchTerm . '%');
            });
        }



        $results = $query->get();

//        dd($results);
        return view('pages.search', compact('results','result', 'availableGenres', 'genre', 'searchTerm'));

    }
}
