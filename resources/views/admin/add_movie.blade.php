@extends('layouts.app')

@section('content')
    <h1>Add movie to database</h1>
    {!! Form::open(['action' => 'AddMovieController@search', 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label( 'title', 'Title')}}
        {{Form::text('title', '',['class' => 'form-control', 'placeholder' => 'Search movie title...' ])}}
    </div>


    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}


    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Array Pos</th>
            <th scope="col">Add</th>
            <th scope="col">Title</th>
            <th scope="col">Release Year</th>
        </tr>
        </thead>
        <tbody>
        @if($searchResult['results'] != null)
            @foreach($searchResult['results'] as $arrayPos=>$item)
                <tr>
                    <td>{{$item['id']}}</td>
                    <td>{{$arrayPos++}}</td>
                    <td>
                        {!! Form::open(['action' => 'AddMovieController@movieToDatabase', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{Form::text('id', $item['id'] ,['class' => 'form-control', 'placeholder' => 'Search movie title...' ])}}

                        </div>


                        {{Form::submit('Add movie to Database', ['class' => 'btn btn-primary'])}}
                        {!! Form::close() !!}
                    </td>
                    <td>{{$item['title']}}</td>
                    <td>{{ Carbon\Carbon::parse($item['release_date'])->format('Y') }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection
