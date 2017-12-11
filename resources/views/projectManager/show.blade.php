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
                    <div class="panel-heading"><a style="font-weight: bold; color: grey;">Proyecto:</a></div>
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
                        @if($project->link)
                        <p> <a style="font-weight: bold;">   Link:</a>
                            {{ $project->link }}
                        </p>
                        @endif
                        @if($project->file)
                        <p> <a style="font-weight: bold;">   Fichero:</a>
                        </br>
                            <a href="{{ $project->file }}">{{ $project->file }}</a> </p>

                        <br/>
                        @endif
                          <iframe src="/laravel-filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
