@extends('front.master.master')
@section('title')
QR Code Generator
@endsection

@section('body')
<div class="container">
    <br>
    <center><a href="{{route('user_login')}}" class="btn btn-primary">Log In</a></center>
    <!-- <marquee behavior="scroll" direction="left"><h3>Create your QR Code for free</h3></marquee> -->
    <hr>
    <br>
   
</div>
@endsection
