@extends('layouts.layout')

@section('main-content')
    <div class="page-content container-fluid">
        <div class="container">
            <div id="add-btn" class="panel-body table-responsive">
                <div class="col-md-4">
                    @include('voyager::alerts')
                    @if (Voyager::can('add_clinic_case'))
                        <a href="/lab/clinic-case/create" class="btn btn-primary">
                            <div class="btns"><span class="glyphicon glyphicon-plus"></span> Add New</div>
                        </a>
                    @endif
                    <a href="/lab/antibiotic" class="btn btn-info">
                        <div class="btns"><span class="voyager-lab fa-lg"></span> Antibiotics</div>
                    </a>
                </div>
                <div class="filter pull-right">
                    {!! Form::model($model, array('action' => ['LaboratoryController@indexC'], 'method' => 'get', 'class' => 'form contactForm', 'id' => 'filter-form')) !!}
                    {{ csrf_field() }}
                    {{ Form::select('filter', $filters, null, array('onchange' => 'this.form.submit()', 'placeholder' => 'Filter...', 'id' => 'filter')) }}
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
                                <th class="actions text-center">Actions</th>
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
                                            <div class="btns"><i class="voyager-trash fa-lg"></i> <span class="hidden-xs hidden-sm">Delete</span></div>
                                        </a>
                                        <!-- edit -->
                                        <a href="{{ route('clinicCase.edit', $clinic->id) }}" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                            <div class="btns"><i class="voyager-edit fa-lg"></i> <span class="hidden-xs hidden-sm">Edit</span></div>
                                        </a>
                                        <!-- view -->
                                        <a href="{{ route('clinicCase.show', $clinic->id) }}" title="View" class="btn btn-sm btn-warning pull-right">
                                            <div class="btns"><i class="voyager-eye fa-lg"></i> <span class="hidden-xs hidden-sm">View</span></div>
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
@stop