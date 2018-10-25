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

@endsection
