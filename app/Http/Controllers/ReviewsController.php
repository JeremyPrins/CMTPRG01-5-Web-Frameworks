<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Movie;
use Auth;
use Illuminate\Validation\ValidationException;

class ReviewsController extends Controller
{

    public function index()
    {
        $reviews = Review::all();


        return view('reviews.index')->with('reviews', $reviews);
    }

    public function create()
    {
        $movies = Movie::all()->sortBy("original_title");;



        foreach ($movies as $movie) {
            $select[$movie->id] = $movie->original_title. " - " .  date('Y', strtotime($movie->release_date));
        }
        return view('reviews.create', compact('select'));
    }


    public function store(Request $reviewObject)
    {
        try {
            $this->validate($reviewObject, [
                'id' => 'required',
                'body' => 'required',
                'rating' => 'required'

            ]);
        } catch (ValidationException $e) {
        }

        $review = new Review;
        $user = Auth::user();
        $review->user_id = $user->id;
        $review->movie_id = $reviewObject['id'];
        $review->text = $reviewObject['body'];
        $review->rating = $reviewObject['rating'];
        $review->save();

        $reviews = Review::all();
        return view('reviews.index')->with('reviews', $reviews);
    }

    public function show($id)
    {
        $review = Review::find($id);
        return view('reviews.show')->with('review', $review);
    }

    public function edit($id)

    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
