<nav class="navbar navbar-color-on-scroll navbar-transparent fixed-top  navbar-expand-lg bg-dark " color-on-scroll="100"
    id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
            {{-- <form class="form-inline ml-auto">
                <div class="form-group has-white bmd-form-group">
                    <input type="text" class="form-control" placeholder="Search" id="search" autocomplete="off">
                </div>
            </form> --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="dropdown nav-item">
                    <a href="{{route('main')}}" class="nav-link">
                        <i class="material-icons">home</i> Home
                    </a>
                </li>
                <li class="dropdown nav-item">
                    <a href="{{route('search.index')}}" class="nav-link">
                        <i class="material-icons">search</i> Search
                    </a>
                </li>
                @guest
                <li class="button-container nav-item iframe-extern">
                    <a href="{{route('login')}}" class="btn  btn-rose   btn-round btn-block">
                        <i class="material-icons">lock</i> Login
                    </a>
                </li>
                @endguest

                @auth
                <li class="dropdown nav-item">
                    <a href="javascript:void(0);" class="profile-photo dropdown-toggle nav-link" data-toggle="dropdown"
                        aria-expanded="false">
                        <div class="profile-photo-small">
                            <img src="{{asset(auth()->user()->foto)}}"
                                alt="Circle Image" class="rounded-circle img-fluid">
                        </div>
                        <div class="ripple-container"></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                        @cannot('guest')
                        <a href="{{route('dashboard.index')}}" class="dropdown-item">Dashboard</a>
                        @endcannot
                        <a href="{{route('logout')}}" class="dropdown-item" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ti-lock text-muted me-2"></i>{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="button-container nav-item iframe-extern ml-2">
                    {{auth()->user()->nama}}
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>