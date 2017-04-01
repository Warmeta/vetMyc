@extends('layouts.layout')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Clinic Case</div>
                    <div class="panel-body">
                        {!! Form::open(array('action' => 'LaboratoryController@store', 'method' => 'post')) !!}
                            {{ csrf_field() }}
                            <div class="col-md-offset-2">
                                {{ Form::hidden('author_id', \Illuminate\Support\Facades\Auth::user()->id) }}
                            <div class="col-md-9 form-group">
                                {{ Form::label('Nº Clinic History', null, ['class' => 'control-label']) }}
                                {{ Form::text('number_clinic_history', null, ['class' => 'form-control']) }}
                                <a class="errors">{{ $errors->first('number_clinic_history') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Ref. Animal', null, ['class' => 'control-label']) }}
                                {{ Form::text('ref_animal', null, ['class' => 'form-control']) }}
                                <a class="errors"><a class="errors">{{$errors->first('ref_animal') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Specie', null, ['class' => 'control-label']) }}
                                {{ Form::text('specie', null, ['class' => 'form-control']) }}
                                <a class="errors"><a class="errors">{{$errors->first('specie') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Clinic History', null, ['class' => 'control-label']) }}
                                {{ Form::textarea('clinic_history', null, ['class' => 'form-control']) }}
                                <a class="errors"><a class="errors">{{$errors->first('clinic_history') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Owner', null, ['class' => 'control-label']) }}
                                {{ Form::text('owner', null, ['class' => 'form-control']) }}
                                <a class="errors"><a class="errors">{{$errors->first('owner') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Breed', null, ['class' => 'control-label']) }}
                                {{ Form::text('breed', null, ['class' => 'form-control']) }}
                                <a class="errors"><a class="errors">{{$errors->first('breed') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Sex', null, ['class' => 'control-label']) }}
                                {{ Form::select('sex', $data->get('sex'), null, ['placeholder' => 'Pick a sex...'],['class' => 'form-control']) }}
                                <a class="errors"><a class="errors">{{$errors->first('sex') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Age', null, ['class' => 'control-label']) }}
                                {{ Form::text('age', null, ['class' => 'form-control']) }}
                                <a class="errors">{{$errors->first('age') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Localization', null, ['class' => 'control-label']) }}
                                {{ Form::select('localization',  $data->get('localization'), null, ['placeholder' => 'Pick a localization...'],['class' => 'form-control']) }}
                                <a class="errors">{{$errors->first('localization') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Status', null, ['class' => 'control-label']) }}
                                {{ Form::select('clinic_case_status', $data->get('status'), null, ['placeholder' => 'Pick a status...'],['class' => 'form-control']) }}
                                <a class="errors">{{$errors->first('clinic_case_status') }}</a>
                            </div>

                            <div class="col-xs-12"><hr></div>

                            <div class="col-md-9 form-group">
                                {{ Form::label('Sample', null, ['class' => 'control-label']) }}
                                {{ Form::text('sample', null, ['class' => 'form-control']) }}
                                <a class="errors">{{$errors->first('sample') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Bacterioscopy', null, ['class' => 'control-label']) }}
                                {{ Form::text('bacterioscopy', null, ['class' => 'form-control']) }}
                                <a class="errors">{{$errors->first('bacterioscopy') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Trichogram', null, ['class' => 'control-label']) }}
                                {{ Form::text('trichogram', null, ['class' => 'form-control']) }}
                                <a class="errors">{{$errors->first('trichogram') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Culture', null, ['class' => 'control-label']) }}
                                {{ Form::text('culture', null, ['class' => 'form-control']) }}
                                <a class="errors">{{$errors->first('culture') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Bacterial Isolate', null, ['class' => 'control-label']) }}
                                {{ Form::select('bacterial_isolate', $data->get('bac'), null, ['class' => 'form-control']) }}
                                <a class="errors">{{$errors->first('bacterial_isolate') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Fungi Isolate', null, ['class' => 'control-label']) }}
                                {{ Form::select('fungi_isolate', $data->get('fun'), null, ['class' => 'form-control']) }}
                                <a class="errors">{{$errors->first('fungi_isolate') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Antibiogram: Sensitive', null, ['class' => 'control-label']) }}
                                {{ Form::select('antibiogram_sensitive', $data->get('sensitive'), null, ['class' => 'form-control']) }}
                                <a class="errors">{{$errors->first('antibiogram_sensitive') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Antibiogram: Intermediate', null, ['class' => 'control-label']) }}
                                {{ Form::select('antibiogram_intermediate', $data->get('intermediate'), null, ['class' => 'form-control']) }}
                                <a class="errors">{{$errors->first('antibiogram_intermediate') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Antibiogram: Resistant', null, ['class' => 'control-label']) }}
                                {{ Form::select('antibiogram_resistant', $data->get('resistant'), null, ['class' => 'form-control']) }}
                                <a class="errors">{{$errors->first('antibiogram_resistant') }}</a>
                            </div>
                            <div class="col-md-9 form-group">
                                {{ Form::label('Comments', null, ['class' => 'control-label']) }}
                                {{ Form::textarea('comment', null, ['class' => 'form-control']) }}
                                <a class="errors">{{$errors->first('comment') }}</a>
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