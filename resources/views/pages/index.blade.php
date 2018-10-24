@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>{{$titleInfo}}</p>

        <p><a class="btn btn-success btn-lg" href='/register' role='button'>Register</a></p> 
        
        <h2>We Provide:</h2>
        
        <div class="row" id='services'>
            <div class="col" style="display: inline-block">
                <ul>
                    @foreach ($services1 as $service)
                        <li>{{$service}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col" style="display: inline-block">
                <ul>
                    @foreach ($services2 as $service)
                        <li>{{$service}}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row" id='homelinks'>
            <div class="col-md-2"></div>
            <div class="col-md-3" style="display: inline-block">
                <a href='/whytojoin'>Why to Join Us</a>
            </div>
            <div class="col-md-2" style="display: inline-block">
                    <a href='/mission'>Our Mission</a>
            </div>
            <div class="col-md-3" style="display: inline-block">
                    <a href='/about'>About Us</a>
            </div>
            <div class="col-md-2"></div>
        </div>
        <h2>Follow us on social media:</h2>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-3" style="display: inline-block">
                <a class='btn btn-lg btn-primary' role='button' target='_blank' href='{{$facebook}}'>Facebook</a>
            </div>
            <div class="col-md-2" style="display: inline-block">
                    <a class='btn btn-lg btn-primary' role='button' target='_blank' href='{{$twitter}}'>Twitter</a>
            </div>
            <div class="col-md-3" style="display: inline-block">
                    <a class='btn btn-lg btn-primary' role='button' target='_blank' href='{{$instagram}}'>Instagram</a>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection