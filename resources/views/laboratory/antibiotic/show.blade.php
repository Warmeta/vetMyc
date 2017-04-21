@extends('layouts.layout')

@section('main-content')
    <div class="container">
        <div id="add-btn" class="panel-body table-responsive"></div>
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Antibiotic</div>
                    <div class="panel-body">
                        <h1>{{ $antibiotic->antibiotic_name }}</h1>
                        <div class="text-center">
                            <p>
                                {{ $antibiotic->description }}
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
