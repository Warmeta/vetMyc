@extends('layouts.layout')

@section('main-content')
    <div class="page-content container-fluid">
        <div id="add-btn" class="top-nav-log">
            <div class="col-md-12">
        @include('voyager::alerts')
        @if (Voyager::can('add_clinic_case'))
            <a href="/lab/clinic-case/create" class="btn btn-success">
                <span class="glyphicon glyphicon-plus"></span> Add New
            </a>
        @endif
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
                                <th class="actions">Actions</th>
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
                                        <a title="Delete" class="btn btn-sm btn-danger pull-right delete" data-id="{{ $clinic->id }}" id="delete-{{ $clinic->id }}" data-token="{{ csrf_token() }}">
                                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Delete</span>
                                        </a>
                                        <!-- edit -->
                                        <a href="{{ route('clinicCase.edit', $clinic->id) }}" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Edit</span>
                                        </a>
                                        <!-- view -->
                                        <a href="{{ route('clinicCase.show', $clinic->id) }}" title="View" class="btn btn-sm btn-warning pull-right">
                                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">View</span>
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

@section('css')
    @if(config('dashboard.data_tables.responsive'))
        <link rel="stylesheet" href="{{ config('voyager.assets_path') }}/lib/css/responsive.dataTables.min.css">
    @endif
@stop
@section('javascript')
    <!-- DataTables -->
    @if(config('dashboard.data_tables.responsive'))
        <script src="{{ config('voyager.assets_path') }}/lib/js/dataTables.responsive.min.js"></script>
    @endif
    <script>
        $(document).ready();

        var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) { // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');
            console.log(form.action);

            $('#delete_modal').modal('show');
        });
    </script>
@stop
