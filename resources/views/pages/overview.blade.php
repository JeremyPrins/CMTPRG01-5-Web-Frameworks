@extends('layouts.app')

@section('content')
    <h1>Movies Overview</h1>
    <hr>

    @if(count($movies) >= 1 )

        <div class="container">
            <ul class="list-unstyled">
                <div class="row">
                    @foreach($movies as $movie)
                        <li class="media col">
                            <img class="mr-3" src="http://image.tmdb.org/t/p/w154/{{$movie->poster_path}}"
                                 alt="{{$movie->original_title}}">
                            <div class="media-body">
                                <h4>{{$movie->original_title}}</h4>
                                <p>({{ Carbon\Carbon::parse($movie->release_date)->format('Y')}}) </p>
                                <small>{{$movie->tagline}}</small>

                                <p>{{$movie->overview}}</p>
                                <a href="https://www.imdb.com/title/{{$movie->imdb_id}}" target="_blank">IMDb page</a>
                            </div>
                        </li>
                    @endforeach
                </div>
            </ul>
        </div>
    @else
        <p>No Reviews found</p>
    @endif
@endsection