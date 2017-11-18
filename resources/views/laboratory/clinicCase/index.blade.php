@extends('layouts.layout')

@section('main-content')
    <div class="page-content container-fluid">
        <div class="container">
            <div id="add-btn" class="panel-body table-responsive">
                <div class="col-md-4">
                    @include('voyager::alerts')
                    @if (Voyager::can('add_clinic_case'))
                        <a href="/lab/clinic-case/create" class="btn btn-primary">
                            <div class="btns"><span class="glyphicon glyphicon-plus"></span> Añadir</div>
                        </a>
                    @endif
                    <a href="/lab/antibiotic" class="btn btn-info">
                        <div class="btns"><span class="voyager-lab fa-lg"></span> Antibióticos</div>
                    </a>
                </div>
                <div class="filter pull-right">
                    {!! Form::model($model, array('action' => ['LaboratoryController@indexC'], 'method' => 'get', 'class' => 'form contactForm', 'id' => 'filter-form')) !!}
                    {{ csrf_field() }}
                    <div id="ifLoc" style="display: none;">
                        {{ Form::select('localization', $loc, null, array('onchange' => 'viewInput()', 'placeholder' => 'Elige...', 'id' => 'localization')) }}
                    </div>
                    <div id="ifClinic" style="display: none;">
                        {{ Form::text('number_clinic_history', null, array('placeholder' => 'Nº Caso...', 'id' => 'nclinic')) }}
                    </div>
                    {{ Form::select('filter', $filters, null, array('onchange' => 'viewInput()', 'placeholder' => 'Filtrar por...', 'id' => 'filter')) }}
                    <div id="ifClinicButton" style="display: none;">
                        <button type="submit" class="btn btn-default" id="search">
                            Buscar
                        </button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                @foreach($rows->values() as $row)
                                    <th>{{ $row }}</th>
                                @endforeach
                                <th class="actions text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clinics->items() as $clinic)
                                <tr>
                                    @foreach($clinic->toArray() as $key => $val)
                                        @foreach($rows->keys() as $row)
                                            @if($key == $row)
                                                <td>
                                                    <div class="readmore">{{ strlen( $val ) > 200 ? substr( $val , 0, 200) . ' ...' : $val }}</div>
                                                </td>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td class="no-sort no-click" id="bread-actions">
                                        <!-- delete -->
                                        <a title="Delete" class="btn btn-sm btn-danger pull-right delete" data-id="{{ $clinic->id }}" id="delete-{{ $clinic->id }}" data-route="./clinic-case/delete/" data-token="{{ csrf_token() }}">
                                            <div class="btns"><i class="voyager-trash fa-lg"></i> <span class="hidden-xs hidden-sm">Borrar</span></div>
                                        </a>
                                        <!-- edit -->
                                        <a href="{{ route('clinicCase.edit', $clinic->id) }}" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                            <div class="btns"><i class="voyager-edit fa-lg"></i> <span class="hidden-xs hidden-sm">Editar</span></div>
                                        </a>
                                        <!-- view -->
                                        <a href="{{ route('clinicCase.show', $clinic->id) }}" title="View" class="btn btn-sm btn-warning pull-right">
                                            <div class="btns"><i class="voyager-eye fa-lg"></i> <span class="hidden-xs hidden-sm">Ver</span></div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            {{ $clinics->appends(Request::only($only))->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function viewInput() {
            if (filter.value == "localization") {
                document.getElementById("ifClinic").style.display = "none";
                document.getElementById("ifClinicButton").style.display = "none";
                document.getElementById("ifLoc").style.display = "inline-block";
                if (localization.value != '') {
                    document.getElementById("filter-form").submit();
                }
            }else if(filter.value == "number_clinic_history"){
                document.getElementById("ifLoc").style.display = "none";
                document.getElementById("localization").selectedIndex  = "0";
                document.getElementById("ifClinic").style.display = "inline-block";
                document.getElementById("ifClinicButton").style.display = "inline-block";
            } else {
                document.getElementById("ifLoc").style.display = "none";
                document.getElementById("localization").selectedIndex  = "0";
                document.getElementById("filter-form").submit();
            }
        }
    </script>
@stop
