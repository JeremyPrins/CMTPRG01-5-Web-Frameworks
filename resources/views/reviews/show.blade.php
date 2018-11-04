@extends('layouts.app')

@section('content')
    <h1>{{$review->movie->original_title }}
        - {{ Carbon\Carbon::parse($review->movie->release_date)->format('Y')}}</h1>
    <h4><a class="badge badge-primary" href="{{route('reviews.index')}}">Back to overview</a></h4>

    <hr>

    <div class="row">
        <div class="col-8">
            <p>{{$review->text}}</p>

        </div>
        <div class="col-4 review-poster">
            <img class="rounded" src="http://image.tmdb.org/t/p/w300/{{$review->movie->poster_path}}">
            <p>Review by <strong>{{$review->user->name }}</strong></p>

            <h3>Rating: {{$review->rating}}/10</h3>
        </div>
    </div>





    @if($review->comments->count() > 0)
        <hr>
        <h3>Comments</h3>
        <div class="comment-container">

            @foreach($comments as $comment)

                    <div class="col-6">
                        <div class="card border-dark mb-3">
                            <div class="card-header"><strong>{{$comment->user->name}}</strong>  {{$comment->created_at->format('d-m-Y')}}</div>
                            <div class="card-body text-dark">
                                <p class="card-text">{{$comment->comment}}</p>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    @else
        <hr>
        <p>This review has no comments.</p>
    @endif


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($reviewCount >= 3)
        <hr>
        <div class="row">
            <div class="col-4">
                {!! Form::open(['action' => ['CommentsController@newComment', $review], 'method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label( 'comment', 'Comment')}}
                    {{Form::text('comment', '',['class' => 'form-control', 'placeholder' => 'Place a comment' ])}}
                </div>

                <div class="form-group">
                    {{Form::submit('Comment', ['class' => 'btn btn-primary'])}}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @else
        <p class="text-warning">You need to write at least 3 reviews to be able to comment</p>
    @endif

    <body class="background"
          style="background-image: url(http://image.tmdb.org/t/p/original/{{$review->movie->backdrop_path}})"></body>
@endsection

