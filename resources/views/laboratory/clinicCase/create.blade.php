@extends('layouts.layout')

@section('main-content')
    <div id="get-touch">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-offset-2">
                    <div class="get-touch-heading">
                        <h2>Clinic Case</h2>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="row col-md-9 col-md-offset-2">
                    {!! Form::open(array('action' => 'LaboratoryController@store', 'method' => 'post', 'class' => 'form contactForm')) !!}
                    {{ csrf_field() }}
                    <div class="col-md-offset-2">
                        {{ Form::hidden('author_id', \Illuminate\Support\Facades\Auth::user()->id) }}
                        <div class="col-md-9 form-group">
                            {{ Form::label('Nº Clinic History', null, ['class' => 'control-label']) }}
                            {{ Form::text('number_clinic_history', null, ['class' => 'form-control']) }}
                            <a id="errors1" class="errors">{{ $errors->first('number_clinic_history') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Ref. Animal', null, ['class' => 'control-label']) }}
                            {{ Form::text('ref_animal', null, ['class' => 'form-control']) }}
                            <a id="errors2" class="errors">{{$errors->first('ref_animal') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Specie', null, ['class' => 'control-label']) }}
                            {{ Form::text('specie', null, ['class' => 'form-control']) }}
                            <a class="errors">{{$errors->first('specie') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Clinic History', null, ['class' => 'control-label']) }}
                            {{ Form::textarea('clinic_history', null, ['class' => 'form-control']) }}
                            <a id="errors3" class="errors">{{$errors->first('clinic_history') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Owner', null, ['class' => 'control-label']) }}
                            {{ Form::text('owner', null, ['class' => 'form-control']) }}
                            <a id="errors4" class="errors">{{$errors->first('owner') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Breed', null, ['class' => 'control-label']) }}
                            {{ Form::text('breed', null, ['class' => 'form-control']) }}
                            <a id="errors5" class="errors">{{$errors->first('breed') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Sex', null, ['class' => 'control-label']) }}
                            {{ Form::select('sex', $data->get('sex'), null, ['placeholder' => 'Pick a sex...'],['class' => 'form-control', 'id' => 'sex']) }}
                            <a id="errors6" class="errors">{{$errors->first('sex') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Age', null, ['class' => 'control-label']) }}
                            {{ Form::text('age', null, ['class' => 'form-control']) }}
                            <a id="errors7" class="errors">{{$errors->first('age') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Localization', null, ['class' => 'control-label']) }}
                            {{ Form::select('localization',  $data->get('localization'), null, ['placeholder' => 'Pick a localization...'],['class' => 'form-control', 'id' => 'localization']) }}
                            <a id="errors8" class="errors">{{$errors->first('localization') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Status', null, ['class' => 'control-label']) }}
                            {{ Form::select('clinic_case_status', $data->get('status'), null, ['placeholder' => 'Pick a status...'],['class' => 'form-control', 'id' => 'clinic_case_status']) }}
                            <a id="errors9" class="errors">{{$errors->first('clinic_case_status') }}</a>
                        </div>

                        <div class="col-md-9"><hr></div>

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
                            {{ Form::textarea('bacterial_isolate', null, ['class' => 'form-control']) }}
                            <a class="errors">{{$errors->first('bacterial_isolate') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Fungi Isolate', null, ['class' => 'control-label']) }}
                            {{ Form::textarea('fungi_isolate', null, ['class' => 'form-control']) }}
                            <a class="errors">{{$errors->first('fungi_isolate') }}</a>
                        </div>
                        <div class="col-md-9 form-group">
                            <div class="panel-body table-responsive">
                                <table id="dataTable" class="row table table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Sensitive</th>
                                        <th>Intermediate</th>
                                        <th>Resistant</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($antibiotics as $antibiotic)
                                        <tr id="{{ $antibiotic }}">
                                            <td>
                                                <div class="readmore">{{ $antibiotic }}</div>
                                            </td>
                                            <td>
                                                <!-- sensitive -->
                                                {{ Form::checkbox($antibiotic.'-1') }}
                                            </td>
                                            <td>
                                                <!-- intermediate -->
                                                {{ Form::checkbox($antibiotic.'-2') }}
                                            </td>
                                            <td>
                                                <!-- ressitant -->
                                                {{ Form::checkbox($antibiotic.'-3') }}
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-9 form-group">
                            {{ Form::label('Comments', null, ['class' => 'control-label']) }}
                            {{ Form::textarea('comment', null, ['class' => 'form-control']) }}
                            <a class="errors">{{$errors->first('comment') }}</a>
                        </div>

                        <div class="col-md-9 submit">
                            <button type="submit" class="btn btn-default">
                                Create
                            </button>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection