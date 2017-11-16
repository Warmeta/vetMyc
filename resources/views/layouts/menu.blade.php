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
                            <li><a href="{{ route('login') }}">Acceder</a></li>
                            <li><a href="{{ route('register') }}">Registrarse</a></li>
                        @else
                            <li class="dropdown">
                                <a id="logout" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    @if (hasPermission('browse_admin'))
                                        <li>
                                            <a href="/admin">
                                                Administrador
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar sesión
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
                    <li class="dropdown">
                        <a href={{ route('lab') }} class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Nosotros<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/#about">
                                    Bienvenido
                                </a>
                            </li>
                            <li>
                                <a href="/#service">
                                    Servicios
                                </a>
                            </li>
                            <li>
                                <a href="/#portfolio">
                                    Equipo
                                </a>
                            </li>
                            <li>
                                <a href="/#get-touch">
                                    Contacto
                                </a>
                            </li>
                            <li>
                                <a href="/#contact">
                                    Encuéntranos
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="dropdown">
                        <a href={{ route('lab') }} class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Micología<span class="caret"></span></a>
                		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                	        <li><a href={{ URL::to('mycology/generalidades') }}>Generalidades</a></li>
                		    <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Levaduras</a>
                                <ul class="dropdown-menu">
                                  <li><a tabindex="-1" href={{ URL::to('mycology/candidiasis') }}>Candidiasis</a></li>
                                  <li><a tabindex="-1" href={{ URL::to('mycology/criptococosis') }}>Criptococosis</a></li>
                                  <li><a tabindex="-1" href={{ URL::to('mycology/malassezias') }}>Malassezias</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Filamentosos</a>
                                <ul class="dropdown-menu">
                                  <li><a tabindex="-1" href={{ URL::to('mycology/aspergilosis') }}>Aspergilosis</a></li>
                                  <li><a tabindex="-1" href={{ URL::to('mycology/dermatofitosis') }}>Dermatofitosis</a></li>
                                </ul>
                            </li>
                            <li><a href={{ URL::to('mycology/dimorficos') }}>Dimórficos</a></li>
                        </ul>
                    </li>
            
                    <li class="dropdown">
                        <a href={{ route('lab') }} class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">laboratorio<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href={{ route('lab') }}>
                                    Precios
                                </a>
                            </li>
                            <li>
                                <a href={{ route('lab') }}>
                                    Impresos
                                </a>
                            </li>
                             @if (!(Auth::guest()) && (hasPermission('browse_clinic_cases')))
                                <li>
                                    <a href={{ route('clinicCase.index') }}>
                                        Casos Clínicos
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href={{ route('lab') }} class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Investigación<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href={{ route('lab') }}>
                                    Nuestro equipo
                                </a>
                            </li>
                            <li>
                                <a href={{ route('lab') }}>
                                    Nuestros proyectos
                                </a>
                            </li>
                            <li>
                                <a href={{ route('lab') }}>
                                    Publicaciones
                                </a>
                            </li>
                            @if (!(Auth::guest()) && (hasPermission('browse_projects')))
                                <li>
                                    <a href={{ route('projectManager.index') }}>
                                        Gestor de proyectos
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <!--<li class="hidden-sm hidden-xs">
                        <a href="#" id="ss"><i class="fa fa-search" aria-hidden="true"></i></a>
                    </li>-->
                </ul>
            </div>
            <!--<div class="search-form">
                <form>
                    <input type="text" id="s" size="40" placeholder="Search..." />
                </form>
            </div>-->
        </div>
    </nav>
</div>