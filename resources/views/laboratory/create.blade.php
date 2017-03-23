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

                            {!! Field::text('number_clinic_history', ['label' => 'Nº Clinical History']) !!}

                            {!! Field::text('ref_animal') !!}

                            {!! Field::text('specie') !!}

                            {!! Field::textarea('clinic_history') !!}

                            {!! Field::text('owner') !!}

                            {!! Field::text('breed') !!}

                            {!! Field::select('sex', $data['sex']) !!}

                            {!! Field::text('age') !!}

                            {!! Field::select('localization', $data['localization']) !!}

                            {!! Field::select('status', $data['status']) !!}

                            <div class="col-xs-12"><hr></div>

                            {!! Field::text('sample') !!}

                            {!! Field::text('bacterioscopy') !!}

                            {!! Field::text('trichogram') !!}

                            {!! Field::text('culture') !!}

                            {!! Field::select('bacterial_isolate', $data['sensitive']) !!}

                            {!! Field::select('fungi_isolate', $data['sensitive']) !!}

                            {!! Field::select('antibiogram_sensitive', $data['sensitive']) !!}

                            {!! Field::select('antibiogram_intermediate', $data['intermediate']) !!}

                            {!! Field::select('antibiogram_resistant', $data['resistant']) !!}

                            {!! Field::textarea('comment', ['label' => 'Comments']) !!}

                            <div class="form-group">
                                <div class="col-lg-offset-5 col-md-6">
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