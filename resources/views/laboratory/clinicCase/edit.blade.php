@extends('layouts.layout')

@section('main-content')
    <div id="get-touch">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-offset-2">
                    <div class="get-touch-heading">
                        <h2>Editar: Caso Clínico</h2>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="row col-md-9 col-md-offset-2">
                    {!! Form::model($clinic, array('action' => ['LaboratoryController@update', $clinic->id], 'method' => 'put', 'class' => 'form contactForm')) !!}
                    {{ csrf_field() }}
                    <div class="col-md-offset-2">
                        <div class="col-md-9 form-group">
                            {{ Form::label('Nº de Caso', null, ['class' => 'control-label']) }}
                            {{ Form::text('number_clinic_history', null, ['class' => 'form-control', 'readonly']) }}
                            <a id="errors1" class="errors">{{ $errors->first('number_clinic_history') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Referencia del animal', null, ['class' => 'control-label']) }}
                            {{ Form::text('ref_animal', null, ['class' => 'form-control']) }}
                            <a id="errors2" class="errors">{{$errors->first('ref_animal') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Especie', null, ['class' => 'control-label']) }}
                            {{ Form::text('specie', null, ['class' => 'form-control']) }}
                            <a class="errors3">{{$errors->first('specie') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Historial Clínico', null, ['class' => 'control-label']) }}
                            {{ Form::textarea('clinic_history', null, ['class' => 'form-control']) }}
                            <a id="errors4" class="errors">{{$errors->first('clinic_history') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Propietario', null, ['class' => 'control-label']) }}
                            {{ Form::text('owner', null, ['class' => 'form-control']) }}
                            <a id="errors5" class="errors">{{$errors->first('owner') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Email del propietario', null, ['class' => 'control-label']) }}
                            {{ Form::text('owner_email', null, ['class' => 'form-control']) }}
                            <a id="errors6" class="errors">{{$errors->first('owner_email') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Raza', null, ['class' => 'control-label']) }}
                            {{ Form::text('breed', null, ['class' => 'form-control']) }}
                            <a id="errors7" class="errors">{{$errors->first('breed') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Sexo', null, ['class' => 'control-label']) }}
                            {{ Form::select('sex', $data->get('sex'), null, ['placeholder' => 'Pick a sex...'],['class' => 'form-control', 'id' => 'sex']) }}
                            <a id="errors8" class="errors">{{$errors->first('sex') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Edad', null, ['class' => 'control-label']) }}
                            {{ Form::text('age', null, ['class' => 'form-control']) }}
                            <a id="errors9" class="errors">{{$errors->first('age') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Localización', null, ['class' => 'control-label']) }}
                            {{ Form::select('localization',  $data->get('localization'), null, ['placeholder' => 'Pick a localization...'],['class' => 'form-control', 'id' => 'localization']) }}
                            <a id="errors10" class="errors">{{$errors->first('localization') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Estado', null, ['class' => 'control-label']) }}
                            {{ Form::select('clinic_case_status', $data->get('status'), null, ['placeholder' => 'Pick a status...'],['class' => 'form-control', 'id' => 'clinic_case_status']) }}
                            <a id="errors11" class="errors">{{$errors->first('clinic_case_status') }}</a>
                        </div>

                        <div class="col-md-9"><hr></div>

                        <div class="col-md-9 form-group">
                            {{ Form::label('Muestra', null, ['class' => 'control-label']) }}
                            {{ Form::text('sample', null, ['class' => 'form-control']) }}
                            <a class="errors">{{$errors->first('sample') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Bacterioscopia', null, ['class' => 'control-label']) }}
                            {{ Form::text('bacterioscopy', null, ['class' => 'form-control']) }}
                            <a class="errors">{{$errors->first('bacterioscopy') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Tricograma', null, ['class' => 'control-label']) }}
                            {{ Form::text('trichogram', null, ['class' => 'form-control']) }}
                            <a class="errors">{{$errors->first('trichogram') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Cultivo', null, ['class' => 'control-label']) }}
                            {{ Form::text('culture', null, ['class' => 'form-control']) }}
                            <a class="errors">{{$errors->first('culture') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Aislamiento bacteriano', null, ['class' => 'control-label']) }}
                            {{ Form::textarea('bacterial_isolate', null, ['class' => 'form-control']) }}
                            <a class="errors">{{$errors->first('bacterial_isolate') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Aislamiento fúngico', null, ['class' => 'control-label']) }}
                            {{ Form::textarea('fungi_isolate', null, ['class' => 'form-control']) }}
                            <a class="errors">{{$errors->first('fungi_isolate') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            <div class="panel-body table-responsive">
                                <table id="dataTable" class="row table table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Sensible</th>
                                        <th>Intermedio</th>
                                        <th>Resistente</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php ($i = 0)
                                    @foreach($antibiotics as $antibiotic)
                                        <tr id="{{ $antibiotic }}">
                                            <td>
                                                <div class="readmore">{{ $antibiotic }}</div>
                                            </td>
                                            <td>
                                                <!-- sensitive -->
                                                @if($arrayrel[$i] == 1)
                                                    {{ Form::checkbox($antibiotic.'-1', 1, true) }}
                                                @else
                                                    {{ Form::checkbox($antibiotic.'-1', 1) }}
                                                @endif
                                                @php($i++)
                                            </td>
                                            <td>
                                                <!-- intermediate -->
                                                @if($arrayrel[$i] == 1)
                                                    {{ Form::checkbox($antibiotic.'-2', 1, true) }}
                                                @else
                                                    {{ Form::checkbox($antibiotic.'-2', 1) }}
                                                @endif
                                                @php($i++)
                                            </td>
                                            <td>
                                                <!-- ressitant -->
                                                @if($arrayrel[$i] == 1)
                                                    {{ Form::checkbox($antibiotic.'-3', 1, true) }}
                                                @else
                                                    {{ Form::checkbox($antibiotic.'-3', 1) }}
                                                @endif
                                                @php($i++)
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Comentarios', null, ['class' => 'control-label']) }}
                            {{ Form::textarea('comment', null, ['class' => 'form-control']) }}
                            <a class="errors">{{$errors->first('comment') }}</a>
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
