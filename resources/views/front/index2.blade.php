@extends('front.master.master')
@section('title')
রিপোর্ট/সার্টিফিকেট(ডাউনলোড)
@endsection

@section('body')
<div class="container">
    <br>

    @if(Auth::guest())
    <div class="row">
        <div class="col-md-5"> </div>

        <div class="col-md-2">
            <a href="{{route('user_login')}}" class=" btn btn-primary">Log In</a>
            <!-- <a class=" btn btn-primary" href="{{route('registration')}}">Signup</a> -->
        </div>

        <div class="col-md-5"></div>
    </div>

    @else
    <center><a href="{{route('admin.dashboard')}}" class="btn btn-primary">Log In</a></center>
    @endif
    <hr>
    <br>

</div>
@endsection