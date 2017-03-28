<section class="top-nav">
    <div class="top-nav-log">
        <div class="row">
            <div class="col-md-6">
                <div class="top-left">

                    <ul>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-vk" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    </ul>

                </div>
            </div>
            <div class="col-md-6">
                <div id="login-nav" class="top-right">
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a id="logout" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @if ((Auth::user()->role_id) == 1)
                                        <li>
                                            <a href="/admin">
                                                Admin
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="main-nav">
    <nav class="navbar">
        <div class="container">
            <div class="navbar-header int-menu">
                <a href="/" id="logo-img"><img src="/images/logo/wgw_logo.png" alt=""></a>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ftheme">
                <span class="sr-only">Toggle</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-collapse collapse int-menu" id="ftheme">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#about">about</a></li>
                    <li><a href="#">mycology</a></li>
                    <li class="dropdown">
                        <a href="/lab" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">laboratory<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/lab">
                                    Pricing
                                </a>
                            </li>
                            <li>
                                <a href="/lab">
                                    Printed matter
                                </a>
                            </li>
                            @if ((Auth::user()->role_id) == 1)
                                <li>
                                    <a href="lab/clinic-case">
                                        Clinic Cases
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li><a href="#">projects</a></li>
                    <li class="hidden-sm hidden-xs">
                        <a href="#" id="ss"><i class="fa fa-search" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
            <div class="search-form">
                <form>
                    <input type="text" id="s" size="40" placeholder="Search..." />
                </form>
            </div>
        </div>
    </nav>
</div>