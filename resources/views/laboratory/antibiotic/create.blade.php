@extends('layouts.layout')

@section('main-content')
    <div id="get-touch">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-offset-2">
                    <div class="get-touch-heading">
                        <h2>Antibiótico</h2>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="row col-md-9 col-md-offset-2">
                    {!! Form::open(array('action' => 'LaboratoryController@storeAntibiotic', 'method' => 'post', 'class' => 'form contactForm')) !!}
                    {{ csrf_field() }}
                    <div class="col-md-offset-2">
                        <div class="col-md-9 form-group">
                            {{ Form::label('Nombre', null, ['class' => 'control-label']) }}
                            {{ Form::text('antibiotic_name', null, ['class' => 'form-control']) }}
                            <a id="errors1" class="errors">{{ $errors->first('antibiotic_name') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Descripción', null, ['class' => 'control-label']) }}
                            {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                            <a id="errors2" class="errors">{{$errors->first('description') }}</a>
                        </div>
                        <div class="col-md-9 submit">
                            <button type="submit" class="btn btn-default">
                                Crear
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
