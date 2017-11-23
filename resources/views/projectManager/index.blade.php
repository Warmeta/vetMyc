@extends('layouts.layout')

@section('main-content')
    <div class="page-content container-fluid">
        <div class="container">
            <div id="add-btn" class="panel-body table-responsive">
                <div class="col-md-4" style=" top: 10px;">
                    @include('voyager::alerts')
                    @if (Voyager::can('add_project'))
                        <a href="/project-manager/create" class="btn btn-primary">
                            <div class="btns"><span class="glyphicon glyphicon-plus"></span> Add New</div>
                        </a>
                    @endif
                </div>
                <div class="pull-right">
                    <h2>Gestor de proyectos</h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body table-responsive">
                        @include('projectManager.dimmers')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
