@extends('layouts.layout')

@section('main-content')
    <div class="container">
        <div id="add-btn" class="panel-body table-responsive"></div>
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                @if(Session::has('suc'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{Session::get('suc')}}.
                    </div>
                @elseif(Session::has('fail'))
                    <div class="alert alert-warning">
                        <strong>Warning!</strong> {{Session::get('fail')}}.
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading"><a style="font-weight: bold; color: grey;">Clinic Case</a></div>
                    <div class="panel-body col-md-8 col-md-offset-2">
                        <h1><a style="font-weight: bold;">Clinic Case:</a>  {{ $clinic->number_clinic_history }}</h1>

                            <p><a style="font-weight: bold;">Clinic Case status : </a>  {{ $clinic->clinic_case_status }}</p>

                            <p><a style="font-weight: bold;">Animal Ref : </a>  {{ $clinic->ref_animal }}</p>

                            <p><a style="font-weight: bold;"> Specie:</a>  {{ $clinic->specie }} </p>

                            <p><a style="font-weight: bold;"> Breed:  </a> {{ $clinic->breed }} </p>

                            <p><a style="font-weight: bold;"> Sex: </a>  {{ $clinic->sex }} </p>

                            <p><a style="font-weight: bold;"> Owner: </a>  {{ $clinic->owner }} </p>

                            <p><a style="font-weight: bold;"> Email: </a>  {{ $clinic->owner_email }} </p>

                            <p><a style="font-weight: bold;"> Age:  </a> {{ $clinic->age }} </p>

                            <p> <a style="font-weight: bold;">   Clinic History:</a>
                                {{ $clinic->clinic_history }} </p>

                            <p>  <a style="font-weight: bold;"> Sample:</a>
                                {{ $clinic->sample }} </p>

                            <p> <a style="font-weight: bold;"> Localization:</a>
                                {{ $clinic->localization }} </p>

                            <p>  <a style="font-weight: bold;"> Bacterioscopy:</a>
                                {{ $clinic->bacterioscopy }} </p>

                            <p> <a style="font-weight: bold;"> Trichogram:</a>
                                {{ $clinic->trichogram }} </p>

                            <p> <a style="font-weight: bold;"> Culture:</a>
                                {{ $clinic->culture }} </p>

                            <p> <a style="font-weight: bold;"> Bacterial isolate:</a>
                                {{ $clinic->bacterial_isolate }} </p>

                            <p>  <a style="font-weight: bold;"> Fungi isolate: </a>
                                {{ $clinic->fungi_isolate }}

                            </p>

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
                                @foreach($clinicantibiotics as $antibiotic)
                                    @if(($antibiotic->resistant != null) || ($antibiotic->intermediate != null) || ($antibiotic->sensitive != null))
                                        <tr>
                                            <td>
                                                <div class="readmore">{{ $antibiotic->antibiotic_name }}</div>
                                            </td>
                                            @if($antibiotic->sensitive != null)
                                                <td style="text-align: center;">
                                                    <!-- sensitive -->
                                                    X
                                                </td>
                                            @else
                                                <td>
                                                    <!-- sensitive -->
                                                </td>
                                            @endif
                                            @if($antibiotic->intermediate != null)
                                                <td style="text-align: center;">
                                                    <!-- intermediate -->
                                                    X
                                                </td>
                                            @else
                                                <td>
                                                    <!-- intermediate -->
                                                </td>
                                            @endif
                                            @if($antibiotic->resistant != null)
                                                <td style="text-align: center;">
                                                    <!-- resistant -->
                                                    X
                                                </td>
                                            @else
                                                <td>
                                                    <!-- resistant -->
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach

                                </tbody>
                            </table>
                            <p><a style="font-weight: bold;">Comments:</a>
                                {{ $clinic->comment }}</p>
                        <div style="float: right"><a href="{{route('sendEmail', $clinic->id)}}" class="btn btn-primary" >Send Email</a></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


