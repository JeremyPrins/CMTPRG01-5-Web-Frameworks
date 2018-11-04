@extends('layouts.app')

@section('content')
    <h1>Movie Search page</h1>
    <hr>

    @if(session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif

    <div class="col-8">
        <div class="form-row">
            <div class="col-6">
                {!! Form::open(['action'=> 'SearchController@selectGenres','method'=> 'POST']) !!}
                {{Form::label('id', 'Choose a genre to search')}}
                {{Form::select('id', $availableGenres, null, ['class'=>'form-control','required', 'placeholder' => 'Search on genre' ])}}
                <br>
                {{Form::submit('Search Genre', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>

            <div class="col-6">
                {!! Form::open(['action'=> 'SearchController@textSearch','method'=> 'POST']) !!}
                {{Form::label('search', 'Enter a search term')}}
                {{Form::text('search', '', ['class'=>'form-control','required', 'placeholder' => 'Search on title or year of release'])}}
                <br>

                {{Form::submit('Search Text', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>


    @if(!$results == null)
        <hr>
        <h2>Search Results</h2>
        <ul class="list-unstyled">

        @foreach($results as $movie)
                <li>
                    <h4><a href="{{route('movies.show', ['movie' => $movie->id])}}">{{$movie->original_title}}
                            - {{ Carbon\Carbon::parse($movie->release_date)->format('Y')}}</a></h4>
                </li>
            @endforeach
        </ul>
    @endif

    @if(!$result == null)
        <hr>
        <h2>Search Results</h2>
        <ul class="list-unstyled">
            @foreach($result as $movie)
                <li>
                    <h4><a href="{{route('movies.show', ['movie' => $movie->id])}}">{{$movie->original_title}}
                            - {{ Carbon\Carbon::parse($movie->release_date)->format('Y')}}</a></h4>
                </li>
            @endforeach
        </ul>
    @endif
@endsection