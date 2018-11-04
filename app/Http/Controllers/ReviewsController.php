<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Review;
use App\Movie;
use Auth;
use Illuminate\Validation\ValidationException;

class ReviewsController extends Controller
{

    public function index()
    {
        if (auth()->user()->role === 1) {
            $reviews = Review::all();

        } else {
            $reviews = Review::where('status', true)->get();

        }

        return view('reviews.index')->with('reviews', $reviews);
    }

    public function create()
    {
        $movies = Movie::all()->sortBy("original_title");;


        foreach ($movies as $movie) {
            $select[$movie->id] = $movie->original_title . " - " . date('Y', strtotime($movie->release_date));
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

        $reviews = Review::where('status', true)->get();
        return view('reviews.index')->with('reviews', $reviews);
    }

    public function show($id)
    {
        $review = Review::find($id);

        if ($review['status'] == true) {

            $comments = Comment::where('review_id', $id)->get();
            $reviewCount = Review::where('user_id', auth()->user()->id)->get()->count();

            return view('reviews.show')->with('review', $review)
                ->with('comments', $comments)
                ->with('reviewCount', $reviewCount);
        } else {

            return back();
        }
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
        $review = Review::find($id);
        $comments = Comment::where('review_id', $id)->get();

        foreach ($comments as $comment) {
            $comment->delete();
        }
        $review->delete();

        return back()->with('success', 'Review Deleted');

    }

    public function reviewStatus($id)
    {

        $review = Review::find($id);


        if ($review['status'] == true) {
            $review->status = 0;

        } else {
            $review->status = 1;
        }

        $review->save();

        return back();

    }

}
