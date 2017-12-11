@extends('layouts.layout')

@section('main-content')
    <div id="about">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <div class="pub">
                        <h2>Trabajos Post grado</h2>
                        </br>
                        @if (!empty($projects))
                            @foreach($projects as $project)
                              @php
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
                                <a href="{{ $link }}"><h4>{{ $project_name }}</h4></a>
                                <p>Linea de investigación: {{ $research_line }}</p>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
