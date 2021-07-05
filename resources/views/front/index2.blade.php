@extends('front.master.master')
@section('title')
QR Code Generator
@endsection

@section('body')
<div class="container">
    <br>
    @if(Auth::guest())
    <center><a href="{{route('user_login')}}" class="btn btn-primary">Log In</a></center>
    <!-- <marquee behavior="scroll" direction="left"><h3>Create your QR Code for free</h3></marquee> -->
    @else
    <center><a href="{{route('user.dashboard')}}" class="btn btn-primary">Log In</a></center>
     @endif
    <hr>
    <br>
   
</div>
@endsection
