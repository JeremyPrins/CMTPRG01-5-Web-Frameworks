<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Movie;
use App\Genre;
use App\Review;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
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

    public function overview()
    {
        $reviews = Review::all();

        return view('admin.reviews_overview')->with('reviews', $reviews);

    }


    public function search(Request $titleSearch)
    {
        try {
            $this->validate($titleSearch, [
                'title' => 'required'
            ]);
        } catch (ValidationException $e) {
        }

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
        $movie = DB::table('movies')->where('original_title', $movieObject['original_title'])->first();

        if (!$movie) {


            try {
                $this->validate($movieObject, [
                    'id' => 'required'
                ]);
            } catch (ValidationException $e) {
            }

            $movieId = $movieObject['id'];
            $apiKey = '99e9557bcd56aefa42b585d87bf3f359';

            if (auth()->user()->role === 1) {

                $response = file_get_contents('https://api.themoviedb.org/3/movie/' . $movieId . '?api_key=' . $apiKey);

                $searchResult = json_decode($response, true);

                $movie = new Movie;

                $movie->id = $searchResult['id'];
                $movie->imdb_id = $searchResult['imdb_id'];
                $movie->original_title = $searchResult['title'];
                $movie->release_date = $searchResult['release_date'];
                $movie->backdrop_path = $searchResult['backdrop_path'];
                $movie->poster_path = $searchResult['poster_path'];
                $movie->tagline = $searchResult['tagline'];
                $movie->overview = $searchResult['overview'];


                $movie->save();

                foreach ($searchResult['genres'] as $genre) {
                    if (!Genre::find($genre['id'])) {
                        Genre::create([
                            'id' => $genre['id'],
                            'name' => $genre['name']
                        ]);
                    }
                }

                $movie->genres()->attach(collect($searchResult['genres'])->pluck('id')->toArray());

            }
            return redirect()->route('admin.add_movie')->with('success', 'Movie added to database!');

        } else {

            return redirect()->route('admin.add_movie')->with('danger', 'Movie already in database!');


        }
    }
}
