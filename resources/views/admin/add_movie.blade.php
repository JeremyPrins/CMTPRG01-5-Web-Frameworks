@extends('layouts.app')

@section('content')

    <h1>Add movie to database</h1>
    <hr>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif

    <div class="row">
        <div class="col-4">
            {!! Form::open(['action' => 'AdminController@search', 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label( 'title', 'Title')}}
                {{Form::text('title', '',['class' => 'form-control', 'placeholder' => 'Search movie title...' ])}}
            </div>

            <div class="form-group">
                {{Form::submit('Search', ['class' => 'btn btn-primary'])}}
            </div>
            {!! Form::close() !!}
        </div>
    </div>


    @if($searchResult['results'])
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Release Year</th>
                <th scope="col">Add</th>
            </tr>
            </thead>
            <tbody>
            @foreach($searchResult['results'] as $arrayPos=>$item)
                <tr>
                    <td>{{$item['title']}}</td>
                    <td>{{ Carbon\Carbon::parse($item['release_date'])->format('Y') }}</td>
                    <td>
                        {!! Form::open(['action' => 'AdminController@movieToDatabase', 'method' => 'POST']) !!}
                        {{Form::hidden('id', $item['id'] ,['class' => 'form-control', 'placeholder' => 'Search movie title...' ])}}
                        {{Form::submit('Add movie to Database', ['class' => 'btn btn-primary'])}}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            @endif
            </tbody>
        </table>
@endsection
