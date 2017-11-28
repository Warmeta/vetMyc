@extends('layouts.layout')

@section('main-content')
    <div class="page-content container-fluid">
        <div class="container">
            <div id="add-btn" class="panel-body table-responsive">
                <div class="col-xs-6 vertical-center">
                    @if (Voyager::can('add_project'))
                        <a href="/project-manager/create" class="btn btn-primary">
                            <div class="btns"><span class="glyphicon glyphicon-plus"></span> Añadir</div>
                        </a>
                    @endif
                </div>
                <div class="col-xs-6 text-right">
                    <h2>Gestor de proyectos</h2>
                </div>
            </div>
            @if(Session::has('suc'))
                <div class="alert alert-success">
                    <strong>Éxito!</strong> {{Session::get('suc')}}.
                </div>
            @elseif(Session::has('fail'))
                <div class="alert alert-warning">
                    <strong>Alerta!</strong> {{Session::get('fail')}}.
                </div>
            @endif
            <div>
                <div class="panel panel-bordered">
                    <div class="panel-body table-responsive">
                        @include('projectManager.dimmers')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
