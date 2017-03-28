@extends('layouts.layout')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Clinic Case</div>
                    <div class="panel-body">
                        <h1>Clinic Case: {{ $clinic->number_clinic_history }}</h1>

                        <div class="text-center">
                            <h2>{{ $clinic->breed }}</h2>
                            <p>
                                {{ $clinic->clinic_history }}
                            </p>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection