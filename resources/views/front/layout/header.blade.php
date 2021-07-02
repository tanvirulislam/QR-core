<nav style="background-image: linear-gradient(to right, #008BCC, #10D2CA);"
    class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="{{route('index')}}">QR Code Generator</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About us</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('user_login')}}">Sign In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('registration')}}">Signup</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>

    </div>
</nav>