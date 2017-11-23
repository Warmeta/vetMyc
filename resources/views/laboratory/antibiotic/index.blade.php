@extends('layouts.layout')

@section('main-content')
    <div class="page-content container-fluid">
        <div class="container">
            <div id="add-btn" class="panel-body table-responsive">
                <div class="col-md-4">
                    @if(Session::has('suc'))
                        <div class="alert alert-success">
                            <strong>Éxito!</strong> {{Session::get('suc')}}.
                        </div>
                    @elseif(Session::has('fail'))
                        <div class="alert alert-warning">
                            <strong>Alerta!</strong> {{Session::get('fail')}}.
                        </div>
                    @endif
                    @if (Voyager::can('add_antibiotic'))
                        <a href="/lab/antibiotic/create" class="btn btn-primary">
                            <div class="btns"><span class="glyphicon glyphicon-plus"></span> Añadir</div>
                        </a>
                    @endif
                    <a href="/lab/clinic-case" class="btn btn-info">
                        <div class="btns"><span class="voyager-paw fa-lg"></span> CasosCLínicos</div>
                    </a>
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

                            @foreach($antibiotics as $antibiotic)
                                <tr>
                                    @foreach($antibiotic as $key => $val)
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
                                        <a title="Delete" class="btn btn-sm btn-danger pull-right delete" data-id="{{ $antibiotic->id }}" id="delete-{{ $antibiotic->id }}" data-route="./antibiotic/delete/" data-token="{{ csrf_token() }}">
                                            <div class="btns"><i class="voyager-trash fa-lg"></i> <span class="hidden-xs hidden-sm">Borrar</span></div>
                                        </a>
                                        <!-- edit -->
                                        <a href="{{ route('antibiotic.edit', $antibiotic->id) }}" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                            <div class="btns"><i class="voyager-edit fa-lg"></i> <span class="hidden-xs hidden-sm">Editar</span></div>
                                        </a>
                                        <!-- view -->
                                        <a href="{{ route('antibiotic.show', $antibiotic->id) }}" title="View" class="btn btn-sm btn-warning pull-right">
                                            <div class="btns"><i class="voyager-eye fa-lg"></i> <span class="hidden-xs hidden-sm">Ver</span></div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            {{ $antibiotics->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
