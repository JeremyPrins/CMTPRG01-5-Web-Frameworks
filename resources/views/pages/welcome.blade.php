@extends('layouts.app')

@section('content')
    <h1>Welcome</h1>
    <hr>
    <p>Welcome to MVC-Movies. Login or register to continue.</p>

    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif

    @foreach($posters as $poster)
        <img class="poster-card" src="http://image.tmdb.org/t/p/w154/{{$poster->poster_path}}"
             alt="{{$poster->original_title}}">
    @endforeach


@endsection
