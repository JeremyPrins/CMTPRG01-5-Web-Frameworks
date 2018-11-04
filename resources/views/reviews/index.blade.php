@extends('layouts.app')

@section('content')
    <h1>Reviews Page</h1>
    <hr>
    <h4><a class="badge badge-primary" href="{{ route('reviews.create') }}">{{ __('Write a Review') }}</a></h4>

    @if(count($reviews) >= 1 )
        <ul class="list-unstyled">
            @foreach($reviews as $review)
                <hr>
                @if($review->status == false)
                    <span class="badge badge-danger">Review hidden</span>
                @endif
                <li class="media">

                    <img class="mr-3 rounded" src="http://image.tmdb.org/t/p/w300/{{$review->movie->backdrop_path}}"
                         alt="{{$review->movie->original_title}}">

                    <div class="media-body">
                        <h5 class="mt-0 mb-1"><a href="/reviews/{{$review->id}}">{{$review->movie->original_title}}
                                - ({{ Carbon\Carbon::parse($review->movie->release_date)->format('Y')}})</a></h5>
                        <small>Written by {{$review->user->name }}</small>
                        <p>{{\Illuminate\Support\Str::words($review->text, 30, ' ...')}}</p>                        <p>Rating: {{$review->rating}}/10</p>
                        <small> Published on {{ Carbon\Carbon::parse($review->created_at)->format('d-m-Y') }}</small>
                        <small> Comments {{$review->comments->count()}}</small>
                    </div>

                </li>

            @endforeach
        </ul>

    @else
        <p>No Reviews found</p>
    @endif
@endsection