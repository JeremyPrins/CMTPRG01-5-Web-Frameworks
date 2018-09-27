@extends('layouts.app')

@section('content')
<h1>Reviews Page</h1>
<hr>

    @if(count($reviews) >= 1 )
        @foreach($reviews as $review)
            <h3>{{$review->movie->original_title}} ({{$review->movie->release_date}})</h3>
            <p>Een review door {{$review->user->name }}</p>
            <p>{{$review->text}}</p>

            <img src="http://image.tmdb.org/t/p/w500/{{$review->movie->backdrop_path}}" alt="">
            <p>Rating: {{$review->rating}}/10</p>
            <hr>

        @endforeach

    @else
            <p>No Reviews found</p>
    @endif
@endsection