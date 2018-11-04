@extends('layouts.app')

@section('content')
    <h1>Reviews Overview</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    @if($reviews->count() > 0)
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Review</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Status</th>
                    <th scope="col">Change Status</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reviews as $item)
                    <tr>
                        <td><a href="/reviews/{{$item->id}}">{{$item->movie->original_title}}</a></td>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->comments->count()}}</td>
                        <td>
                            @if($item->status == true)
                                <p class="text-success">Review Active</p>
                            @else
                                <p class="text-danger">Review Inactive</p>
                            @endif
                        </td>
                        <td>
                            @if($item->status == true)
                                {!! Form::open(['action' => ['ReviewsController@reviewStatus', $item], 'method' => 'POST']) !!}
                                {{Form::submit('Hide Review', ['class' => 'btn btn-danger'])}}
                                {!! Form::close() !!}

                            @else
                                {!! Form::open(['action' => ['ReviewsController@reviewStatus', $item], 'method' => 'POST']) !!}
                                {{Form::submit('Show Review', ['class' => 'btn btn-success'])}}
                                {!! Form::close() !!}

                            @endif
                        </td>
                        <td>
                            {!! Form::open(['action' => ['ReviewsController@destroy', $item], 'method' => 'DELETE']) !!}
                            {{Form::submit('Delete Review', ['class' => 'btn btn-danger'])}}
                            {!! Form::close() !!}
                        </td>

                    </tr>
                @endforeach

                @else
                    <p>There are no reviews.</p>
                @endif
                </tbody>
            </table>
        </div>
@endsection
