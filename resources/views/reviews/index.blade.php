@extends('layouts.app')

@section('content')
    <h1>Reviews Page</h1>
    <hr>

    @if(count($reviews) >= 1 )
        <ul class="list-unstyled">
            @foreach($reviews as $review)
                <li class="media">
                    <img class="mr-3" src="http://image.tmdb.org/t/p/w300/{{$review->movie->backdrop_path}}"
                         alt="{{$review->movie->original_title}}">
                    <div class="media-body">
                        <h5 class="mt-0 mb-1"><a href="/reviews/{{$review->id}}">{{$review->movie->original_title}} - ({{ Carbon\Carbon::parse($review->movie->release_date)->format('Y') }})</a></h5>
                        <small></small>

                        <small>Een review door {{$review->user->name }}</small>
                        <p>{{$review->text}}</p>
                        <p>Rating: {{$review->rating}}/10</p>
                        <small> Geschreven op {{ Carbon\Carbon::parse($review->created_at)->format('d-m-Y') }}</small>
                    </div>
                </li>
                <hr>
            @endforeach
        </ul>

    @else
        <p>No Reviews found</p>
    @endif
@endsection