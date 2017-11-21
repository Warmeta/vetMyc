@extends('layouts.layout')

@section('main-content')
    <!--slider-->
    <div id="slider" class="flexslider">

        <ul class="slides">
            <li>
                <img src="/images/slider/slider1.jpg">

                <div class="caption">
                    <h2><span>Laboratorio de enfermedades infecciosas</span></h2>
                    <p>Facultad de veterinaria ULPGC</p>
                    <!--  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
                    <!-- <button class="btn">Leer más</button> -->
                </div>

            </li>
            <li>
                <img src="/images/slider/slider2.jpg">

                <div class="caption">
                    <h2><span>Servicio de laboratorio</span></h2>
                    <p>En muestra múltiples de animales de renta un 20% de descuento.</p>
                    <a href="/lab"><button class="btn">Leer más</button></a>
                </div>

            </li>
            <li>
                <img src="/images/slider/slider3.jpg">

                <div class="caption">
                    <h2><span>¿Qué es la micología?</span></h2>
                    <a href="/mycology/generalidades"><button class="btn">Leer más</button></a>
                </div>

            </li>
        </ul>

    </div>

    <!--about-->
    <div id="about">

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <div class="about-heading">
                        <h2>Bienvenido</h2>
                        <p>El Laboratorio de enfermedades infecciosas forma parte de la ULPGC específicamente a la Facultad de Medicina Veterinaria.
                            <br>
                            <br>
                            Además de colaborar activamente con la formación de profesionales y la difusión de contenidos científicos, cumple el papel fundamental de establecer el diagnóstico micológico y otras enfermedades infecciosas. Para ello cuenta con un equipo de trabajo altamente calificado, orientado al desarrollo del conocimiento y a la formación constante.
                            <br>
                            <br>
                            Entre nuestros objetivos se encuentran difundir información y su progreso en el área de la micología veterinaria con interés en el campo docente e investigador, así como ofrecer nuestro servicio de diagnóstico clínico.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--about bg-->
    <div id="about-bg">

        <div class="container">
            <div class="row">

                <div class="about-bg-heading">
                    <h1>Estadísticas sobre nosotros</h1>
                    <p>lo que hemos conseguido</p>
                </div>

                <div class=" col-xs-12 col-md-4">
                    <div class="about-bg-wrapper">
                        <span class="count"><h1><span class="border">10</span>5</h1></span>
                        <p>casos clínicos</p>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="about-bg-wrapper">
                        <span class="count"><h1>54</h1></span>
                        <p>proyectos</p>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="about-bg-wrapper">
                        <span class="count"><h1>152</h1></span>
                        <p>publicaciones</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="cover"></div>

    </div>

    <!--service-->

    <div id="service">
        </br>
        </br>
        </br>
        </br>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                    <div class="service-heading">
                        <h2>servicios</h2>
                        <p>Laboratorio de diagnóstico de enfermedades infeccionsas de la ULPGC</p>
                    </div>
                </div>
            </div>
        </div>

        <!--services wrapper-->
        <section class="services-style-one">
            <div class="outer-box clearfix">

                <div class="services-column">
                    <div class="content-outer">
                        <div class="row clearfix">

                            <div class="service-block col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
                                    <h4>EQUIPO PROFESIONAL</h4>
                                    <div class="text"> Gran equipo profesional para ofrecer el mejor servicio. </div>
                                </div>
                            </div>

                            <div class="service-block col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="fa fa-trophy" aria-hidden="true"></i></div>
                                    <h4>EXPERIENCIA</h4>
                                    <div class="text">Alta experiencia en el diagnóstico de enfermedades infecciosas.</div>
                                </div>
                            </div>

                            <div class="service-block col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="fa fa-bullhorn" aria-hidden="true"></i></div>
                                    <h4>ULPGC</h4>
                                    <div class="text">Personal cualificado de la Universidad de Las Palmas de Gran Canaria a su disposición. </div>
                                </div>
                            </div>

                            <div class="service-block col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="fa fa-money" aria-hidden="true"></i></div>
                                    <h4>PRECIO</h4>
                                    <div class="text">La mejor oferta del mercado para nuestros usuarios. </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Content Column-->
                <div class="content-column clearfix">
                    <div class="content-box">
                        <div class="inner-box">
                            <!--Section Title-->
                            <div class="sec-title aligned-right">
                                <h2>Muestra<span> Clínica</span></h2>
                            </div>
                            <div class="text" id="justif">Conocemos como "Muestra Clínica" aquellas sustancias, tejidos, sangre, orina, leche, raspaduras de la piel y líquidos orgánicos extraídos de animales para propósitos de diagnóstico.</div>

                            <a href="http://www.fv.ulpgc.es/?page_id=142"><button class="btn">leer más</button></a>
                        </div>
                    </div>
                </div>


            </div>
        </section>

    <!--contact form-->
    <div id="get-touch">
        </br>
        </br>
        </br>
        </br>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <div class="get-touch-heading">
                        <h2>Contacta</h2>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="row">
                  @if(Session::has('suc'))
                      <div class="alert alert-success">
                          <strong>Éxito!</strong> {{Session::get('suc')}}.
                      </div>
                  @elseif(Session::has('fail'))
                      <div class="alert alert-warning">
                          <strong>Alerta!</strong> {{Session::get('fail')}}.
                      </div>
                  @endif

                    <form action="{{ action('HomeController@contact') }}" method="post" role="form" class="form contactForm">
                        {{ csrf_field() }}
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" required name="name" class="form-control" id="name" placeholder="Nombre" data-rule="minlen:4" data-msg="Por favor introduzca al menos 4 caracteres" />
                                <div class="validation"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="email" required class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Por favor introduzca un email válido" />
                                <div class="validation"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" required class="form-control" name="subject" id="subject" placeholder="Contenido" data-rule="minlen:4" data-msg="Por favor introduzca al menos 8 caracteres" />
                                <div class="validation"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea required class="form-control" name="message" rows="5" data-rule="required" data-msg="Por favor escríbanos algo" placeholder="Message"></textarea>
                                <div class="validation"></div>
                            </div>
                        </div>
                        <div class="submit">
                            <button class="btn btn-default" type="submit">Enviar ahora</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--contact-->
    <div id="contact">
        </br>
        </br>
        </br>
        </br>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <div class="contact-heading">
                        <h2>Encuéntrenos aquí</h2>
                        <div class="col-xs-12">
                          <p>Facultad de Veterinaria – ULPGC
                          </br>
                          Servicio de Diagnostico de Enfermedades Infecciosas
                          </br>
                          Campus Universitario de Arucas S/N. Arucas – 35413 – Las Palmas
                          </p>
                        </div>
                        <div class="col-xs-12">
                          <p>Tel. +(34) 928 454 360-55
                          </br>
                          Fax. +(34) 928 451 141
                          </br>
                          e-mail: bego.acosta@ulpgc.es ó soraya.deniz@ulpgc.es</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="google-map" data-latitude="28.138901" data-longitude="-15.506179"></div>

    </div>


    <!--client-->
    <div id="client">
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-md-6">
                    <span></span><img src="/images/client/logofv.png" alt="">
                </div>

                <div class="col-sm-4 col-md-6">
                    <span></span><img src="/images/client/iconULPGC.png" alt="">
                </div>

            </div>
        </div>
    </div>

@stop
