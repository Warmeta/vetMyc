@extends('layouts.layout')

@section('main-content')
    <div class="container">
        <div id="add-btn" class="panel-body table-responsive"></div>
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                @if(Session::has('suc'))
                    <div class="alert alert-success">
                        <strong>Éxito!</strong> {{Session::get('suc')}}.
                    </div>
                @elseif(Session::has('fail'))
                    <div class="alert alert-warning">
                        <strong>Alerta!</strong> {{Session::get('fail')}}.
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading"><a style="font-weight: bold; color: grey;">Clinic Case</a></div>
                    <div class="panel-body col-md-8 col-md-offset-2">
                        <h1><a style="font-weight: bold;">Caso Clínico:</a>  {{ $clinic->number_clinic_history }}</h1>

                            <p><a style="font-weight: bold;">Estado del caso: </a>  {{ $clinic->clinic_case_status }}</p>

                            <p><a style="font-weight: bold;">Referencia del animal: </a>  {{ $clinic->ref_animal }}</p>

                            <p><a style="font-weight: bold;"> Especie:</a>  {{ $clinic->specie }} </p>

                            <p><a style="font-weight: bold;"> Raza:  </a> {{ $clinic->breed }} </p>

                            <p><a style="font-weight: bold;"> Sexo: </a>  {{ $clinic->sex }} </p>

                            <p><a style="font-weight: bold;"> Propietario: </a>  {{ $clinic->owner }} </p>

                            <p><a style="font-weight: bold;"> Email: </a>  {{ $clinic->owner_email }} </p>

                            <p><a style="font-weight: bold;"> Edad:  </a> {{ $clinic->age }} </p>

                            <p> <a style="font-weight: bold;">   Historial Clínico:</a>
                                {{ $clinic->clinic_history }} </p>

                            <p>  <a style="font-weight: bold;"> Muestra:</a>
                                {{ $clinic->sample }} </p>

                            <p> <a style="font-weight: bold;"> Localización:</a>
                                {{ $clinic->localization }} </p>

                            <p>  <a style="font-weight: bold;"> Bacterioscopia:</a>
                                {{ $clinic->bacterioscopy }} </p>

                            <p> <a style="font-weight: bold;"> Tricograma:</a>
                                {{ $clinic->trichogram }} </p>

                            <p> <a style="font-weight: bold;"> Cultivo:</a>
                                {{ $clinic->culture }} </p>

                            <p> <a style="font-weight: bold;"> Aislamiento bacteriano:</a>
                                {{ $clinic->bacterial_isolate }} </p>

                            <p>  <a style="font-weight: bold;"> Aislamiento fúngico: </a>
                                {{ $clinic->fungi_isolate }}

                            </p>

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
                            <p><a style="font-weight: bold;">Comentarios:</a>
                                {{ $clinic->comment }}</p>
                        <div style="float: right"><a href="{{route('sendEmail', $clinic->id)}}" class="btn btn-primary" >Enviar Caso Clínico</a></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
