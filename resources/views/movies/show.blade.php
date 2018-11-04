@extends('layouts.app')

@section('content')
    <h1>{{$movie->original_title}} - {{ Carbon\Carbon::parse($movie->release_date)->format('Y')}}</h1>
    <hr>
    <h4><a class="badge badge-primary" href="{{route('pages.overview')}}">Back to overview</a>
        <a class="badge badge-primary" href="https://www.imdb.com/title/{{$movie->imdb_id}}" target="_blank">IMDB
            Page</a>
        <a class="badge badge-primary" href="{{route('reviews.create')}}">Write a review</a>

    </h4>

    <hr>

    <div class="row">
        <div class="col-6">
            <blockquote class="blockquote">
                <p class="mb-0">{{$movie->tagline}}</p>
            </blockquote>
            <h3>Overview</h3>
            <p>{{$movie->overview}}</p>
            <h4>Genres:</h4>
            <p><em>@foreach($movie->genres as $genre)
                        {{$genre->name}},
                    @endforeach
                </em></p>
        </div>
        <div class="col-6">
            <img class="rounded" src="http://image.tmdb.org/t/p/w500/{{$movie->backdrop_path}}" alt="">
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr>
            @if($movie->reviews->count() == null)
                <p>This movie has not been reviewed yet.</p>
            @else
                <div class="row">
                    <ul>
                        <li>Number of reviews - {{$movie->reviews->count()}}</li>
                        <li>Avarage rating - {{$rating}}</li>
                    </ul>
                </div>
            @endif
        </div>
    </div>


@endsection