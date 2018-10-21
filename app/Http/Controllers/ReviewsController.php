<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Review;
use App\Movie;
use Auth;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all();

        return view('reviews.index')->with('reviews', $reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $movies = Movie::all();
        $select = [];
        foreach ($movies as $movie) {
            $select[$movie->moviedb_id] = $movie->original_title;
        }
        return view('reviews.create', compact('select'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $reviewObject)
    {
        $this->validate($reviewObject, [
            'id' => 'required',
            'body' => 'required',
            'rating' => 'required'

        ]);
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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::find($id);
        return view('reviews.show')->with('review', $review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
