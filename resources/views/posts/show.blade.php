@extends('layouts.app')

@section('content')
        
    <div class="jumbotron">
        <h1>{{$post->title}}</h1>
        <img src='/storage/cover_images/{{$post->cover_image}}' style="width:100px; height:100px">
        <br><br>
        <div>
            <?php
                // replace /n by <br> to display in html format
                echo nl2br(e($post->body)); 
            ?>
        </div>
        <small><b>
            <div>Author: {{$post->user->name}}</div>
            <div>Time: {{$post->created_at}} </div>
            <div>Accessibility: {{$post->access}}</div>
        </b></small>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <a href="{{ URL::previous() }}" class="btn btn-default col-md-1">Go Back</a>
        <div class="col-md-1"></div>
        @if(!Auth::guest() && auth()->user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default col-md-1">Edit</a>
            <div class="col-md-1"></div>
            {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'col-md-1']) !!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
            <div class="col-md-6"></div>
        @else
            <div class="col-md-9"></div>
        @endif
    </div>
@endsection