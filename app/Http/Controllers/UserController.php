<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(User $user)
    {
        if (auth()->user()->id !== $user->id){
            return redirect()->route('welcome')->with('status', 'No peeking ;)');
        }

        return view('user.index')->with('user', $user);
    }
}
