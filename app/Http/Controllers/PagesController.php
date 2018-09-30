<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index(){
        return view('pages.welcome');
    }

    public function overview(){
        return view('pages.overview');
    }

    public function search(){
        return view('pages.search');
    }
}
