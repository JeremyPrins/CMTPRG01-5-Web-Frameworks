
@extends('layouts.app')

@section('content')
    <h1>Movie inserted to DB</h1>
    @if($searchResult != null)
        @foreach($searchResult as $item)
           <p>{{$item['title']}}</p>
        @endforeach
    @endif



@endsection
