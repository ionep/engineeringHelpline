@extends('layouts.app')

@section('content')
    <h1>{{}}</h1>
    <?php $count=0; ?>
    @if (count($sets)>0)
        @foreach ($sets as $set)
            <?php $count++; echo $count; ?>. <a href="/loksewa/{{$set->set}}">{{$set->title}}</a>
        @endforeach
    @endif
@endsection