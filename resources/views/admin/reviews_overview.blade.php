@extends('layouts.app')

@section('content')
    <h1>Reviews Overview</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">User ID</th>
            <th scope="col">User Name</th>
            <th scope="col">Movie Title</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        @if($reviews != null)
            @foreach($reviews as $item)
                <tr>
                    <td>{{$item['user_id']}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->movie->original_title}}</td>
                    <td>Active</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection
