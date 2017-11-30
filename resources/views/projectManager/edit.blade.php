@extends('layouts.layout')

@section('main-content')
    <div id="get-touch">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-offset-2">
                    <div class="get-touch-heading">
                        <h2>Editar: Proyecto</h2>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="row col-md-9 col-md-offset-2">
                    {!! Form::model($project, array('action' => ['ProjectController@update', $project->id], 'method' => 'put', 'class' => 'form contactForm', 'enctype' => 'multipart/form-data', 'files' => true)) !!}
                    {{ csrf_field() }}
                    <div class="col-md-offset-2">
                        <div class="col-md-9 form-group">
                            {{ Form::label('Nombre del proyecto', null, ['class' => 'control-label']) }}
                            {{ Form::text('project_name', null, ['class' => 'form-control']) }}
                            <a id="errors1" class="errors">{{ $errors->first('project_name') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Descripción', null, ['class' => 'control-label']) }}
                            {{ Form::text('description', null, ['class' => 'form-control']) }}
                            <a id="errors2" class="errors">{{$errors->first('description') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Imagen', null, ['class' => 'control-label']) }}
                            {{ Form::file('image', null, ['class' => 'form-control'])  }}
                            @if ($project->image)
                              <img src="{{ $project->image }}" class="img-responsive" />
                            @endif
                            <a class="errors">{{$errors->first('image') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Tipo de proyecto', null, ['class' => 'control-label']) }}
                            {{ Form::select('project_type', ['Proyecto de investigación' => 'Proyecto de investigación', 'Tesis' => 'Tesis', 'Trabajo fin grado' => 'Trabajo fin grado', 'Trabajo Post-grado' => 'Trabajo Post-grado', 'Publicación' => 'Publicación', 'Congreso' => 'Congreso'], null, ['placeholder' => 'Seleccione...'],['class' => 'form-control']) }}
                            <a id="errors3" class="errors">{{$errors->first('project_type') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Linea de investigación', null, ['class' => 'control-label']) }}
                            {{ Form::text('research_line', null, ['class' => 'form-control']) }}
                            <a id="errors4" class="errors">{{$errors->first('research_line') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Fecha de publicación', null, ['class' => 'control-label']) }}
                            {{ Form::date('publication_date', null, ['class' => 'form-control']) }}
                            <a id="errors5" class="errors">{{$errors->first('publication_date') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Entidad', null, ['class' => 'control-label']) }}
                            {{ Form::text('entity', null, ['class' => 'form-control']) }}
                            <a id="errors6" class="errors">{{$errors->first('entity') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Estado', null, ['class' => 'control-label']) }}
                            {{ Form::select('project_status', $data->get('status'), null, ['placeholder' => 'Pick a status...'],['class' => 'form-control']) }}
                            <a id="errors7" class="errors">{{$errors->first('project_status') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Investigadores principales', null, ['class' => 'control-label']) }}
                            </br>
                            <select class="multiselect-limit" name="researchers[]" multiple="multiple">
                                @foreach($data['researchers'] as $researcher)
                                    @if(in_array($researcher->id, $researchers))
                                      <option value="{{ $researcher->id }}" selected>{{ $researcher->name }}</option>
                                    @else
                                      <option value="{{ $researcher->id }}">{{ $researcher->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <a id="errors8" class="errors">{{$errors->first('researchers[]') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Colaboradores', null, ['class' => 'control-label']) }}
                            </br>
                            <select class="multiselect" name="collaborators[]" multiple="multiple">
                              @foreach($data['researchers'] as $researcher)
                                  @if(in_array($researcher->id, $collaborators))
                                    <option value="{{ $researcher->id }}" selected>{{ $researcher->name }}</option>
                                  @else
                                    <option value="{{ $researcher->id }}">{{ $researcher->name }}</option>
                                  @endif
                              @endforeach
                            </select>
                            <a id="errors9" class="errors">{{$errors->first('collaborators[]') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Link', null, ['class' => 'control-label']) }}
                            {{ Form::text('link', null, ['class' => 'form-control']) }}
                            <a class="errors">{{$errors->first('link') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Fichero', null, ['class' => 'control-label']) }}
                            {{ Form::file('file', null, ['class' => 'form-control'])  }}
                            <a class="errors10">{{$errors->first('file') }}</a>
                        </div>
                        <div class="col-md-9 submit">
                            <button type="submit" class="btn btn-default">
                                Editar
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
