@extends('layouts.layout')

@section('main-content')
    <div class="container">
        <div id="add-btn" class="panel-body table-responsive"></div>
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                @if(Session::has('suc'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{Session::get('suc')}}.
                    </div>
                @elseif(Session::has('fail'))
                    <div class="alert alert-warning">
                        <strong>Warning!</strong> {{Session::get('fail')}}.
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading"><a style="font-weight: bold; color: grey;">Project</a></div>
                    <div class="panel-body col-md-8 col-md-offset-2">
                        <h1>  {{ $project->project_name }}</h1>

                        <p><a style="font-weight: bold;">Description: </a>  {{ $project->description }}</p>

                        <p><img src="{{url('storage/'.$project->image)}}"></img></p>

                        <p><a style="font-weight: bold;"> Type:</a>  {{ $project->project_type }} </p>

                        <p><a style="font-weight: bold;"> Research line:  </a> {{ $project->research_line }} </p>

                        <p><a style="font-weight: bold;"> Publication date: </a>  {{ $project->publication_date }} </p>

                        <p><a style="font-weight: bold;"> Entity: </a>  {{ $project->entity }} </p>

                        <p><a style="font-weight: bold;"> Author: </a>  {{ $user }} </p>

                        <p><a style="font-weight: bold;"> Status:  </a> {{ $project->project_status }} </p>

                        <p> <a style="font-weight: bold;">   Link:</a>
                            {{ $project->link }} </p>

                        <p>  <a style="font-weight: bold;"> File:</a>
                            {{ $project->file }} </p>

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


