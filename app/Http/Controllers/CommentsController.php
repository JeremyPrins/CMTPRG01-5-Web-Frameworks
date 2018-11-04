<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Comment;
use Illuminate\Support\Facades\DB;




class CommentsController extends Controller
{

    function newComment(Request $request, $review_id)
    {

            $comment = new Comment;

             $comment->comment = $request['comment'];
             $comment->user_id = auth()->user()->id;
             $comment->review_id = $review_id;
             $comment->save();



        return redirect()->back()->with('success', 'Comment succesfully added.');

    }

}
