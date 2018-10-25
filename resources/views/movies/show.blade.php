@extends('layouts.app')

@section('content')
    <a href="{{route('pages.overview')}}">Back to overview</a>
    <hr>

    <h1>{{$movie->original_title}} - {{ Carbon\Carbon::parse($movie->release_date)->format('Y')}}</h1>

    <div class="row">
        <div class="col-6">
            <p class="font-weight-bold">{{$movie->tagline}}</p>

            <p>@foreach($movie->genres as $genre)
                    {{$genre->name}}
                @endforeach
            </p>

            <p>{{$movie->overview}}</p>
            <a href="https://www.imdb.com/title/{{$movie->imdb_id}}" target="_blank">IMDB Page</a>
        </div>
        <div class="col-6">
            <img class="rounded" src="http://image.tmdb.org/t/p/w500/{{$movie->backdrop_path}}" alt="">

        </div>

            <p>{{$movie->reviews->count()}}</p>
                <p>{{$movie->avg_rating}}</p>

        <div class="col-4">
            <a href="{{route('reviews.create')}}">Write a review</a>
        </div>
    </div>
@endsection