@extends('layouts.layout')

@section('main-content')
    <div class="container">
        <div id="add-btn" class="panel-body table-responsive"></div>
          <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading "><a style="font-weight: bold; color: grey;">Antibiótico</a></div>
                    <div class="panel-body col-md-8 col-md-offset-2">
                        <div class="text-center"><h1><a style="font-weight: bold;">{{ $antibiotic->antibiotic_name }}</a></h1></div>
                        </br>
                        <div class="text-center">
                            <p>
                                {{ $antibiotic->description }}
                            </p>
                        </div>

                    </br>
                    <div class="panel-heading text-center"><h2 style="font-weight: bold;">Casos Clínicos asociados a <a>{{ $antibiotic->antibiotic_name }}</a></h2></div>
                    </br>
                    <table id="dataTable" class="row table table-hover">
                        <thead>
                        <tr>
                            <th>Nº de caso</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Edad</th>
                            <th>Sensible</th>
                            <th>Intermedio</th>
                            <th>Resistente</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clinicantibiotics as $clinic)
                            @if(($clinic->resistant != null) || ($clinic->intermediate != null) || ($clinic->sensitive != null))
                                <tr>
                                    <td>
                                        <div class="readmore"><a href="{{route('clinicCase.show', $clinic->id)}}">{{ $clinic->number_clinic_history }}</a></div>
                                    </td>
                                    <td>
                                        <div class="readmore"><a>{{ $clinic->specie }}</a></div>
                                    </td>
                                    <td>
                                        <div class="readmore"><a>{{ $clinic->breed }}</a></div>
                                    </td>
                                    <td>
                                        <div class="readmore"><a>{{ $clinic->age }}</a></div>
                                    </td>
                                    @if($clinic->sensitive != null)
                                        <td style="text-align: center;">
                                            <!-- sensitive -->
                                            X
                                        </td>
                                    @else
                                        <td>
                                            <!-- sensitive -->
                                        </td>
                                    @endif
                                    @if($clinic->intermediate != null)
                                        <td style="text-align: center;">
                                            <!-- intermediate -->
                                            X
                                        </td>
                                    @else
                                        <td>
                                            <!-- intermediate -->
                                        </td>
                                    @endif
                                    @if($clinic->resistant != null)
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
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
