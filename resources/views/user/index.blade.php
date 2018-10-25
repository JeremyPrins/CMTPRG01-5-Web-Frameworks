@extends('layouts.app')

@section('content')
    <h1>Welcome, {{$user->name}}</h1>
    <hr>
    <table class="table table-striped">
        <h2>My Reviews</h2>
        <thead>
        <th scope="col">Movie Title</th>
        <th scope="col">Date Published</th>
        <th scope="col">Review Status</th>
        <th scope="col">Remove Review</th>
        </thead>
        <tbody>
        @foreach($user->reviews as $review)
            <tr>
                <td><a href="/reviews/{{$review->id}}">{{$review->movie->original_title}}</a></td>
                <td>{{$review->created_at->format('d-m-Y')}}</td>
                <td>Yes</td>
                <td><button class="btn btn-danger">Delete Review</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>






@endsection


