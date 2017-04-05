@extends('layouts.layout')

@section('main-content')
    <div class="page-content container-fluid">
        <div id="add-btn" class="top-nav-log">
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
        </div>
        <div class="container">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body table-responsive">
                        <table id="dataTable" class="row table table-hover">
                            <thead>
                            <tr>
                                @foreach($rows as $row)
                                    <th>{{ $row }}</th>
                                @endforeach
                                <th class="actions text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clinics as $clinic)
                                <tr>

                                    @foreach($clinic as $key => $val)
                                        @foreach($rows as $row)
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to delete
                        this clinic case ?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('clinicCase.index') }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="Yes, delete this clinic case">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop