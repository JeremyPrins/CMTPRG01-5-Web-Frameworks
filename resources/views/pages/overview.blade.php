@extends('layouts.app')

@section('content')
    <h1>Movies Overview</h1>
    <hr>
    @if(($movies))
        <div class="container">
        <div class="row">
            @foreach($movies as $movie)
                <div class="col-6 movie-card">
                    <div class="media">
                        <img class="mr-3" src="http://image.tmdb.org/t/p/w154/{{$movie->poster_path}}"
                             alt="{{$movie->original_title}}">

                        <div class="media-body">
                            <div>
                                <h3 class="mt-0 mb-1"><a href="{{route('movies.show', ['movie' => $movie->id])}}">{{$movie->original_title}}</a></h3>
                                <h5>{{ Carbon\Carbon::parse($movie->release_date)->format('Y')}}</h5>
                                <small>{{$movie->tagline}}</small>
                            </div>
                            <div>
                                <strong>Genre:</strong>
                                @foreach($movie->genres as $genre)
                                    <small>{{$genre->name}},</small>
                                @endforeach
                                <p>{{  \Illuminate\Support\Str::words($movie->overview, 40, ' ...')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div></div>
    @else
        <p>No Reviews found</p>
    @endif
@endsection