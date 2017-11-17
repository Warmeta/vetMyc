@extends('layouts.layout')

@section('main-content')
    <div class="container">
        <div id="add-btn" class="panel-body table-responsive"></div>
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                @if(Session::has('suc'))
                    <div class="alert alert-success">
                        <strong>Éxito!</strong> {{Session::get('suc')}}.
                    </div>
                @elseif(Session::has('fail'))
                    <div class="alert alert-warning">
                        <strong>Alerta!</strong> {{Session::get('fail')}}.
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading"><a style="font-weight: bold; color: grey;">Project</a></div>
                    <div class="panel-body col-md-8 col-md-offset-2">
                        <h1>  {{ $project->project_name }}</h1>

                        <p><a style="font-weight: bold;">Descripción: </a>  {{ $project->description }}</p>

                        <p><img src="{{$project->image}}"></img></p>

                        <p><a style="font-weight: bold;"> Tipo:</a>  {{ $project->project_type }} </p>

                        <p><a style="font-weight: bold;"> Linea de investigación:  </a> {{ $project->research_line }} </p>

                        <p><a style="font-weight: bold;"> Fecha de publicación: </a>  {{ $project->publication_date }} </p>

                        <p><a style="font-weight: bold;"> Entidad: </a>  {{ $project->entity }} </p>

                        <p><a style="font-weight: bold;"> Autor: </a>  {{ $user }} </p>

                        <p><a style="font-weight: bold;"> Estado:  </a> {{ $project->project_status }} </p>

                        <p> <a style="font-weight: bold;">   Link:</a>
                            {{ $project->link }} </p>

                        <p>  <a style="font-weight: bold;"> Fichero:</a>
                          @if ($project->file)
                            <a href="{{ $project->file }}" download="{{ $project->file }}" target="_blank">
                              {{ $project->file }}
                            </a>
                          @endif </p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
