@extends('layouts.layout')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Antibiotic</div>
                    <div class="panel-body">
                        {!! Form::open(array('action' => 'LaboratoryController@storeAntibiotic', 'method' => 'post')) !!}
                            {{ csrf_field() }}
                        <div class="col-md-offset-2">
                        <div class="col-md-9 form-group">
                            {{ Form::label('Name', null, ['class' => 'control-label']) }}
                            {{ Form::text('antibiotic_name', null, ['class' => 'form-control']) }}
                            <a class="errors">{{ $errors->first('antibiotic_name') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Description', null, ['class' => 'control-label']) }}
                            {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                            <a class="errors"><a class="errors">{{$errors->first('description') }}</a>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection