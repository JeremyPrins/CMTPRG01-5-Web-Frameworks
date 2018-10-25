@extends('layouts.app')

@section('content')
    <h1>Movie Search page</h1>
    <hr>

    @if(session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
        {!! Form::open(['action'=> 'SearchController@selectGenres','method'=> 'POST']) !!}

        <div class="col-4">
            <div class="form-group">
                {{Form::label('id', 'Choose a genre to search   ')}}
                {{Form::select('id', $availableGenres, null, ['class'=>'form-control', ])}}
            </div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

        </div>
        {!! Form::close() !!}

    @if(!$result == null)
        <hr>
        <h2>Search Results</h2>
        @foreach($result as $movie)
            <a href="{{route('movies.show', ['movie' => $movie->id])}}">{{$movie->original_title}}</a>

        @endforeach


    @endif


@endsection