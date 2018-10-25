@extends('layouts.app')

@section('content')
    <a href="/reviews">Terug naar overzicht</a>
    <h3>{{$review->movie->original_title}} - ({{ Carbon\Carbon::parse($review->movie->release_date)->format('Y') }})</h3>
    <p>Een review door {{$review->user->name }}</p>
    <p>{{$review->text}}</p>

    <img src="http://image.tmdb.org/t/p/w500/{{$review->movie->backdrop_path}}" alt="">
    <p>Rating: {{$review->rating}}/10</p>
    <hr>




@endsection