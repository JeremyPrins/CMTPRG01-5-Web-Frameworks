@extends('layouts.app')

@section('content')
    {!! Form::open(['action'=> 'ReviewsController@store','method'=> 'POST']) !!}
    <div class="form-group">
        {{Form::label('id', 'Choose a Movie to review')}}
        {{Form::select('id', $select, null, ['class'=>'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::label( 'body', 'Body')}}
        {{Form::textarea('body', '',['class' => 'form-control', 'placeholder' => 'Review body' ])}}
    </div>

    <div class="form-group">
        {{Form::label( 'rating', 'Rating')}}
        {{Form::selectRange('rating', 1, 10)}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}

@endsection