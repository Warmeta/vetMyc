@extends('layouts.layout')

@section('main-content')
    <div id="about">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-md-offset-2">
                    <div class="pub">
                        @if (count($projects))
                        <h2>Proyectos</h2>
                        </br>
                        @php
                          $projectss = $projects->splice(0, 3);
                        @endphp
                            @foreach($projectss as $project)
                              @php
                              $project_id = $project->id;
                              $project_name = $project->project_name;
                              $description = $project->description;
                              $research_line = $project->research_line;
                              $project_type = $project->project_type;
                              $project_img = $project->image;
                              $publication_date = $project->publication_date;
                              $link = $project->link;
                              @endphp
                              <div class="row row-pub">
                              <div class="col-xs-5">
                                <a href="{{ route("projectManager.show", $project_id) }}"><h4>{{ $project_name }}</h4></a>
                                <p>Linea de investigación: {{ $research_line }}</p>
                                <p>Tipo: {{ $project_type }}</p>
                                <p<a href="{{ $link }}">Enlace de descarga</a>
                                <p>Fecha: {{ $publication_date }}</p>
                              </div>
                              <div class="col-xs-7">
                                <img src="{{ $project_img }}" class="img-responsive" />
                                </br>
                                <p>{{ $description }}</p>
                              </div>
                              </div>
                            @endforeach
                        @endif
                        @if(count($projects->splice(0, 3)))
                          <div class="text-center"><h5><a href="/proj">Ver mas...</a></h5></div>
                        @endif
                        @if (count($publications))
                        <h2>Publicaciones</h2>
                        </br>
                        @php
                          $publicationss = $publications->splice(0, 3);
                        @endphp
                        @foreach($publicationss as $publication)
                          @php
                          $project_id = $publication->id;
                          $project_name = $publication->project_name;
                          $description = $publication->description;
                          $research_line = $publication->research_line;
                          $project_type = $publication->project_type;
                          $project_img = $publication->image;
                          $publication_date = $publication->publication_date;
                          $link = $publication->link;
                          @endphp
                          <div class="row row-pub">
                          <div class="col-xs-5">
                            <a href="{{ route("projectManager.show", $project_id) }}"><h4>{{ $project_name }}</h4></a>
                            <p>Linea de investigación: {{ $research_line }}</p>
                            <p>Fecha: {{ $publication_date }}</p>
                            <p><a href="{{ $link }}">Enlace de descarga</a></p>
                          </div>
                          <div class="col-xs-7">
                            <img src="{{ $project_img }}" class="img-responsive" />
                            </br>
                            <p>{{ $description }}</p>
                          </div>
                          </div>
                        @endforeach
                        @endif
                        @if(count($publications->splice(0, 3)))
                          <div class="text-center"><h5><a href="/publications">Ver mas...</a></h5></div>
                        @endif
                        @if (count($tesis))
                        <h2>Tesis</h2>
                        </br>
                        @php
                          $tesiss = $tesis->splice(0, 3);
                        @endphp
                        @foreach($tesiss as $tesina)
                          @php
                          $project_id = $tesina->id;
                          $project_name = $tesina->project_name;
                          $description = $tesina->description;
                          $research_line = $tesina->research_line;
                          $project_type = $tesina->project_type;
                          $project_img = $tesina->image;
                          $publication_date = $tesina->publication_date;
                          $link = $tesina->link;
                          @endphp
                          <div class="row row-pub">
                          <div class="col-xs-5">
                            <a href="{{ route("projectManager.show", $project_id) }}"><h4>{{ $project_name }}</h4></a>
                            <p>Linea de investigación: {{ $research_line }}</p>
                            <p>Fecha: {{ $publication_date }}</p>
                            <p><a href="{{ $link }}">Enlace de descarga</a></p>
                          </div>
                          <div class="col-xs-7">
                            <img src="{{ $project_img }}" class="img-responsive" />
                            </br>
                            <p>{{ $description }}</p>
                          </div>
                          </div>
                        @endforeach
                        @endif
                        @if(count($tesis->splice(0, 3)))
                          <div class="text-center"><h5><a href="/tesis">Ver mas...</a></h5></div>
                        @endif
                        @if (count($tfgs))
                        <h2>Trabajos fin de grado</h2>
                        </br>
                        @php
                          $tfgss = $tfgs->splice(0, 3);
                        @endphp
                        @foreach($tfgss as $tfg)
                          @php
                          $project_id = $tfg->id;
                          $project_name = $tfg->project_name;
                          $description = $tfg->description;
                          $research_line = $tfg->research_line;
                          $project_type = $tfg->project_type;
                          $project_img = $tfg->image;
                          $publication_date = $tfg->publication_date;
                          $link = $tfg->link;
                          @endphp
                          <div class="row row-pub">
                          <div class="col-xs-5">
                            <a href="{{ route("projectManager.show", $project_id) }}"><h4>{{ $project_name }}</h4></a>
                            <p>Linea de investigación: {{ $research_line }}</p>
                            <p>Fecha: {{ $publication_date }}</p>
                            <p><a href="{{ $link }}">Enlace de descarga</a></p>
                          </div>
                          <div class="col-xs-7">
                            <img src="{{ $project_img }}" class="img-responsive" />
                            </br>
                            <p>{{ $description }}</p>
                          </div>
                          </div>
                        @endforeach
                        @endif
                        @if(count($tfgs->splice(0, 3)))
                          <div class="text-center"><h5><a href="/tfg">Ver mas...</a></h5></div>
                        @endif
                        @if (count($tpgs))
                        <h2>Trabajos Post grado</h2>
                        </br>
                        @php
                          $tpgss = $tpgs->splice(0, 3);
                        @endphp
                        @foreach($tpgss as $tpg)
                          @php
                          $project_id = $tpg->id;
                          $project_name = $tpg->project_name;
                          $description = $tpg->description;
                          $research_line = $tpg->research_line;
                          $project_type = $tpg->project_type;
                          $project_img = $tpg->image;
                          $publication_date = $tpg->publication_date;
                          $link = $tpg->link;
                          @endphp
                          <div class="row row-pub">
                          <div class="col-xs-5">
                            <a href="{{ route("projectManager.show", $project_id) }}"><h4>{{ $project_name }}</h4></a>
                            <p>Linea de investigación: {{ $research_line }}</p>
                            <p>Fecha: {{ $publication_date }}</p>
                            <p><a href="{{ $link }}">Enlace de descarga</a></p>
                          </div>
                          <div class="col-xs-7">
                            <img src="{{ $project_img }}" class="img-responsive" />
                            </br>
                            <p>{{ $description }}</p>
                          </div>
                          </div>
                        @endforeach
                        @endif
                        @if(count($tpgs->splice(0, 3)))
                          <div class="text-center"><h5><a href="/tpg">Ver mas...</a></h5></div>
                        @endif
                        @if (count($congresos))
                        <h2>Trabajos Post grado</h2>
                        </br>
                        @php
                          $congresoss = $congresos->splice(0, 3);
                        @endphp
                        @foreach($congresoss as $congreso)
                          @php
                          $project_id = $congreso->id;
                          $project_name = $congreso->project_name;
                          $description = $congreso->description;
                          $research_line = $congreso->research_line;
                          $project_type = $congreso->project_type;
                          $project_img = $congreso->image;
                          $publication_date = $congreso->publication_date;
                          $link = $congreso->link;
                          @endphp
                          <div class="row row-pub">
                          <div class="col-xs-5">
                            <a href="{{ route("projectManager.show", $project_id) }}"><h4>{{ $project_name }}</h4></a>
                            <p>Linea de investigación: {{ $research_line }}</p>
                            <p>Fecha: {{ $publication_date }}</p>
                            <p><a href="{{ $link }}">Enlace de descarga</a></p>
                          </div>
                          <div class="col-xs-7">
                            <img src="{{ $project_img }}" class="img-responsive" />
                            </br>
                            <p>{{ $description }}</p>
                          </div>
                          </div>
                        @endforeach
                        @endif
                        @if(count($congresos->splice(0, 3)))
                          <div class="text-center"><h5><a href="/congresos">Ver mas...</a></h5></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
