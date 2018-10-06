<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddMovieController extends Controller
{

    public function index()
    {


        $response   = "";
        $searchResult = json_decode($response, true);


        return view('admin.add_movie')->with('searchResult', $searchResult);

    }

    public function search(Request $titleSearch)
    {
        $this->validate($titleSearch, [
            'title' => 'required'
        ]);

        $titleSearch['title'] = str_replace(' ', '%20', $titleSearch['title']);

        $searchQuery = $titleSearch['title'];
        $apiKey = '99e9557bcd56aefa42b585d87bf3f359';

        if (auth()->user()->role === 1) {

            $response = file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=' . $apiKey . '&language=en-US&query=' . $searchQuery. '&include_adult=false');

            $searchResult = json_decode($response, true);


            return view('admin.add_movie')->with('searchResult', $searchResult);
        }
        return redirect('/');
    }




}
