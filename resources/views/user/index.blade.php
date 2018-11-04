@extends('layouts.app')

@section('content')
    <h1>My Reviews</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($user->reviews->count() > 0)
        <div class="row">
        <table class="table table-striped">
            <thead>
            <th scope="col">Movie Title</th>
            <th scope="col">Date Published</th>
            <th scope="col">Review Status</th>
            <th scope="col">Delete Review</th>
            </thead>
            <tbody>
            @foreach($user->reviews as $review)
                <tr>
                    <td><a href="/reviews/{{$review->id}}">{{$review->movie->original_title}}</a></td>
                    <td>{{$review->created_at->format('d-m-Y')}}</td>
                    <td>                            @if($review->status == true)
                            <p class="text-success">Review Active</p>
                        @else
                            <p class="text-danger">Review Inactive</p>
                        @endif</td>
                    <td>
                        {!! Form::open(['action' => ['ReviewsController@destroy', $review->id], 'method' => 'DELETE']) !!}
                        {{Form::submit('Delete Review', ['class' => 'btn btn-danger'])}}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    @else
        <p>You have no reviews.</p>
    @endif




@endsection


