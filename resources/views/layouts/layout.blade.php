<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="ulpgc mycology laboratory">
    <meta name="keywords" content="mycology, veterinary mycology, ulpgc, micologia veterianaria, micologia, laboratorio micologia, laboratorio veterinaria">
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Open+Sans|Raleway" rel="stylesheet">
    <link rel="stylesheet" href="/css/flexslider.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <!-- =======================================================
        Theme Name: MyBiz
        Theme URL: https://bootstrapmade.com/mybiz-free-business-bootstrap-theme/
        Author: BootstrapMade.com
        Author URL: https://bootstrapmade.com
    ======================================================= -->
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body id="top" data-spy="scroll">

<!--top header-->

<header id="home">
    <section class="top-nav hidden-xs">
        <div class="container">
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
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul id="logout" class="dropdown-menu" role="menu">
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

    <!--main-nav-->

    @include('layouts.menu')

</header>

@yield('main-content')

<!--footer-->
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-heading">
                    <h3><span>about</span> us</h3>
                    <p>To explore strange new worlds to seek out new life and new civilizations to boldly go where no man has gone before. It's time to play the music.</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-heading">
                    <h3><span>latest</span> news</h3>
                    <ul>
                        <li><a href="#">Trends don't matter, but techniques do</a></li>
                        <li><a href="#">Trends don't matter, but techniques do</a></li>
                        <li><a href="#">Trends don't matter, but techniques do</a></li>
                        <li><a href="#">Trends don't matter, but techniques do</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-heading">
                    <h3><span>follow</span> us on instagram</h3>
                    <div class="insta">
                        <ul>
                            <img src="/images/footer/footer1.jpg" alt="">
                            <img src="/images/footer/footer2.jpg" alt="">
                            <img src="/images/footer/footer3.jpg" alt="">
                            <img src="/images/footer/footer4.jpg" alt="">
                            <img src="images/footer/footer5.jpg" alt="">
                            <img src="images/footer/footer6.jpg" alt="">
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--bottom footer-->
<div id="bottom-footer" class="hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-left">
                    &copy; MyBix Theme. All rights reserved
                    <div class="credits">
                        <!--
                            All the links in the footer should remain intact.
                            You can delete the links only if you purchased the pro version.
                            Licensing information: https://bootstrapmade.com/license/
                            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=MyBiz
                        -->
                        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="footer-right">
                    <ul class="list-unstyled list-inline pull-right">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#service">Service</a></li>
                        <li><a href="#portfolo">Portfolio</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- jQuery -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.flexslider.js"></script>
<script src="/js/jquery.inview.js"></script>
<script src="https://maps.google.com/maps/api/js?sensor=true"></script>
<script src="/js/script.js"></script>


</body>
</html>