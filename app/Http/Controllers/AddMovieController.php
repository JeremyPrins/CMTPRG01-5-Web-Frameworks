<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\DB;


class AddMovieController extends Controller
{

    public function index()
    {


        $response = "";
        $searchResult = json_decode($response, true);

        if (auth()->user()->role === 1) {
            return view('admin.add_movie')->with('searchResult', $searchResult);
        }
        return redirect('/');

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

            $response = file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=' . $apiKey . '&language=en-US&query=' . $searchQuery . '&include_adult=false');

            $searchResult = json_decode($response, true);

            return view('admin.add_movie')->with('searchResult', $searchResult);
        }
        return redirect('/');
    }

    public function movieToDatabase(Request $movieObject)
    {

        $movie = DB::table('movies')->where('moviedb_id', $movieObject['id'])->first();

        if ($movie === null) {


            $this->validate($movieObject, [
                'id' => 'required'
            ]);

            $movieId = $movieObject['id'];
            $apiKey = '99e9557bcd56aefa42b585d87bf3f359';

            if (auth()->user()->role === 1) {

                $response = file_get_contents('https://api.themoviedb.org/3/movie/' . $movieId . '?api_key=' . $apiKey);

                $searchResult = json_decode($response, true);


                $movie = new Movie;

                $movie->moviedb_id = $searchResult['id'];
                $movie->genre_id = 99;
                $movie->imdb_id = $searchResult['imdb_id'];
                $movie->original_title = $searchResult['original_title'];
                $movie->release_date = $searchResult['release_date'];
                $movie->backdrop_path = $searchResult['backdrop_path'];
                $movie->poster_path = $searchResult['poster_path'];
                $movie->tagline = $searchResult['tagline'];
                $movie->overview = $searchResult['overview'];

                $movie->save();


                return view('admin.add_movie')->with('searchResult', $searchResult);

            } else {
                return view('admin.result');

            }
        }
    }

}
