@extends('front.master.master')
@section('title')
Registration
@endsection

@section('body')
<br>
<div class="container">
    <div class="row">

        <div class="col-md-3"></div>

        <div class="col-md-6" style="box-shadow: 0px 0px 5px #0cc1cb; padding: 24px 26px;background: ghostwhite;">
            <center>
                <h3>Registration Form</h3>
            </center>
            <hr>
            <br>
            <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Mobile number</label>
                    <input type="number" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter number">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>

                <div class="form-group">
                    <label for="password-confirm">Password confirmation</label></label>
                    <input type="password" class="form-control" placeholder="Password confirmation" name="password_confirmation" required autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div class="col-md-3"></div>

    </div>
</div>
<br>
@endsection