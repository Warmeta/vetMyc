<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta id="vp" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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
    <link rel="stylesheet" href="/vendor/tcg/voyager/assets/fonts/voyager/styles.css">
    <link rel="stylesheet" href="/css/bootstrap-multiselect.css" type="text/css"/>
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

    <!--menu-nav-->

    @include('layouts.menu')

</header>

@yield('main-content')

<!--footer-->
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-heading">
                    <h3><span>Sobre</span> nosotros</h3>
                    <p id="justif">Somos un laboratorio de diagnóstico e investigación de enfermedades infecciosas de la facultad veterinaria de la ULPGC, entre nuestros objetivos se encuentran difundir información y su progreso en el área de la micología veterinaria, además de ofrecer servicios de diagnóstico clínico.</p>
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="footer-heading">
                    <h3><span>Últimas</span> noticias</h3>
                    <ul>
                        <li><a href="#">Trends</a></li>
                        <li><a href="#">Trends</a></li>
                        <li><a href="#">Trends</a></li>
                        <li><a href="#">Trends</a></li>
                    </ul>
                </div>
            </div> -->
        </div>
    </div>
</div>

<!--bottom footer-->
<div id="bottom-footer" class="hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-left">
                    &copy; All rights reserved
                </div>
            </div>
            <div class="col-md-8">
                <div class="footer-right">
                    <ul class="list-unstyled list-inline pull-right">
                        <li><a href="/#about">Bienvenido</a></li>
                        <li><a href="/#service">Servicios</a></li>
                        <li><a href="/#get-touch">Contacto</a></li>
                        <li><a href="/#contact">Encuéntranos</a></li>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxnxNyJ0xcX50M8lmHZ-Ch2RLAleH3s8M"></script>
<script type="text/javascript" src="/js/bootstrap-multiselect.js"></script>
<script src="/js/script.js"></script>

</body>
</html>
