<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function overview()
    {
        $reviews = Review::all();

        return view('admin.reviews_overview')->with('reviews', $reviews);

    }
}
