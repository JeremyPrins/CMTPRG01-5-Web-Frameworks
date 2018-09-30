@extends('layouts.app')

@section('content')
    <h3>Schrijf je review</h3>
    {!! Form::open(['action' => 'ReviewsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label( 'title', 'Title')}}
            {{Form::text('title', '',['class' => 'form-control', 'placeholder' => 'Welke film wil je reviewen?' ])}}
        </div>

    <div class="form-group">
        {{Form::label( 'body', 'Body')}}
        {{Form::textarea('body', '',['class' => 'form-control', 'placeholder' => 'Review' ])}}
    </div>

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection