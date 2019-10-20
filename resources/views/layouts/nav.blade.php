    <nav class="navbar navbar-expand navbar-fixed-top navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">Lentrix Judging System</a>

            <ul class="navbar-nav ml-auto">
                @if(!auth()->guest())
                <li class="navbar-text">User: {{auth()->user()->name}} </li>
                @endif

                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/')}}">Home</a>
                </li>

                @if(!auth()->guest())
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/logout')}}">Logout</a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
