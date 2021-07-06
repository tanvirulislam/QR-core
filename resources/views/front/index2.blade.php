@extends('front.master.master')
@section('title')
QR Code Generator
@endsection

@section('body')
<div class="container">
    <br>

    @if(Auth::guest())
    <div class="row">
        <div class="col-md-4"> </div>

        <div class="col-md-2">

            <a href="{{route('user_login')}}" class=" btn btn-primary">Log In</a>
            <a class=" btn btn-primary" href="{{route('registration')}}">Signup</a>

        </div>

        <div class="col-md-4"></div>
    </div>

    @else
    <center><a href="{{route('user.dashboard')}}" class="btn btn-primary">Log In</a></center>
    @endif
    <hr>
    <br>

</div>
@endsection