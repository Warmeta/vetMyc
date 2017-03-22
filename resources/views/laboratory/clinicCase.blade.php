@extends('layouts.layout')

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Clinic Case</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('clinicCase.post') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('number_clinic_history') ? ' has-error' : '' }}">
                            <label for="number_clinic_history" class="col-md-4 control-label">Nº Clinical History</label>

                            <div class="col-md-6">
                                <input id="number_clinic_history" type="text" class="form-control" name="number_clinic_history" value="{{ old('number_clinic_history') }}" required autofocus>

                                @if ($errors->has('number_clinic_history'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number_clinic_history') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_animal') ? ' has-error' : '' }}">
                            <label for="ref_animal" class="col-md-4 control-label">Ref. Animal</label>

                            <div class="col-md-6">
                                <input id="ref_animal" type="text" class="form-control" name="ref_animal" value="{{ old('ref_animal') }}" required autofocus>

                                @if ($errors->has('ref_animal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_animal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('specie') ? ' has-error' : '' }}">
                            <label for="specie" class="col-md-4 control-label">Specie</label>

                            <div class="col-md-6">
                                <input id="specie" type="text" class="form-control" name="ref_animal" value="{{ old('ref_animal') }}" required autofocus>

                                @if ($errors->has('specie'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('specie') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('clinic_history') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Clinic History</label>

                            <div class="col-md-6">
                                <input id="clinic_history" type="text" class="form-control" name="clinic_history" required>

                                @if ($errors->has('clinic_history'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clinic_history') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('owner') ? ' has-error' : '' }}">
                            <label for="owner" class="col-md-4 control-label">Owner</label>

                            <div class="col-md-6">
                                <input id="owner" type="text" class="form-control" name="owner" required>

                                @if ($errors->has('owner'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('owner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('breed') ? ' has-error' : '' }}">
                            <label for="owner" class="col-md-4 control-label">Breed</label>

                            <div class="col-md-6">
                                <input id="breed" type="text" class="form-control" name="breed" required>

                                @if ($errors->has('breed'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('breed') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                            <label for="sex" class="col-md-4 control-label">Sex</label>

                            <div class="col-md-6">
                                <select id="sex" type="text" class="form-control" name="sex" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    @if ($errors->has('sex'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sex') }}</strong>
                                        </span>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('clinic_case_status') ? ' has-error' : '' }}">
                            <label for="clinic_case_status" class="col-md-4 control-label">Status</label>

                            <div class="col-md-6">
                                <select id="clinic_case_status" type="text" class="form-control" name="clinic_case_status" required>
                                    <option value="inprogress">In progress</option>
                                    <option value="finished">Finished</option>
                                    @if ($errors->has('clinic_case_status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('clinic_case_status') }}</strong>
                                        </span>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sample" class="col-md-4 control-label">Sample</label>
                            <div class="col-md-6">
                                <input id="sample" type="text" class="form-control" name="sample" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bacterioscopy" class="col-md-4 control-label">Bacterioscopy</label>
                            <div class="col-md-6">
                                <input id="bacterioscopy" type="text" class="form-control" name="bacterioscopy" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="trichogram" class="col-md-4 control-label">Trichogram</label>
                            <div class="col-md-6">
                                <input id="trichogram" type="text" class="form-control" name="trichogram" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="culture" class="col-md-4 control-label">Culture</label>

                            <div class="col-md-6">
                                <input id="culture" type="text" class="form-control" name="culture" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bacterial" class="col-md-4 control-label">Bacterial</label>

                            <div class="col-md-6">
                                <input id="bacterial" type="text" class="form-control" name="bacterial" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fungus" class="col-md-4 control-label">Fungus</label>

                            <div class="col-md-6">
                                <input id="fungus" type="text" class="form-control" name="fungus" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment" class="col-md-4 control-label">Comments</label>
                            <div class="col-md-6">
                                <input id="comment" type="text" class="form-control" name="comment" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Crear
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection