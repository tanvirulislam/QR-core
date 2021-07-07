<nav style="background: coral;" class="navbar navbar-expand-lg navbar-light">
    @if(Auth::guest())
    <!--<a style="width: 146px;" class="navbar-brand" href="{{route('index')}}">-->
    <!--    <img style="width: 146px;" src="{{asset('/')}}public/front/images/logo2.png" alt="logo">-->
    <!--</a>-->

    <a class="navbar-brand" href="{{route('index')}}">Home <span class="sr-only">(current)</span></a>
    @else
    <!--<a style="width: 146px;" class="navbar-brand" href="{{route('user.dashboard')}}">-->
    <!--    <img style="width: 146px;" src="{{asset('/')}}public/front/images/logo2.png" alt="logo">-->
    <!--</a>-->

    <a class="navbar-brand" href="{{route('user.dashboard')}}">Home <span class="sr-only">(current)</span></a>
    @endif
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
           
            @if (Auth::guest())
            <li class="nav-item">
                <!-- <a class="nav-link" href="{{route('user_login')}}">Sign In</a> -->
            </li>
            <!--<li class="nav-item">-->
            <!--    <a class="nav-link" href="{{route('registration')}}">Signup</a>-->
            <!--</li>-->
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endif
        </ul>

    </div>
</nav>