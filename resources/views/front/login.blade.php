@extends('front.master.master')
@section('title')
Login
@endsection

@section('body')
<br>
<div class="container">
    <div class="row">

        <div class="col-md-3"></div>

        <div class="col-md-6" style="box-shadow: 0px 0px 5px #0cc1cb; padding: 24px 26px;background: ghostwhite;">
            <center>
                <h3>Login Form</h3>
            </center>
            <hr>
            <br>
            <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
              
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div class="col-md-3"></div>

    </div>
</div>
@endsection